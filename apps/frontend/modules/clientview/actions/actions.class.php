<?php

/**
 * clientview actions.
 *
 * @package    projectmanager
 * @subpackage clientview
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class clientviewActions extends sfActions {
	
	
	public function executeShow(sfWebRequest $request) {
		$this->job = $this->getRoute ()->getObject ();
	}

	

	public function executeAddJob(sfWebRequest $request) {
			$jobId = $request->getParameter("id");
			$job = JobPeer::retrieveByPK($jobId);
			$profile = $this->getUser()->getProfile();
			
			$to = "photo@tufts.edu";
			$subject = $profile->getFirstName() . " " 
			         . $profile->getLastName() . " is requestting to be added to job " 
			         . $job->getEvent();
			
			mail($to, $subject, $subject);
			JobPeer::addEmailLogMessage($jobId, "Request to be added", "photo@tufts.edu");
	}

/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request) {
		
		$this->page = $this->getRequest ()->getParameter ( "page" );
    $this->sortedBy = $this->getRequest ()->getParameter ( "sortBy" );
    $this->invert = $this->getRequest ()->getParameter ( "invert" );
		$own = $request->getParameter("own");
		$all = $request->getParameter("all");
		$this->all = $all;
		$this->own = $own;
    
		$profile = $this->getUser()->getProfile();
    
		if(is_null($all))
		  $all = false;
    if(is_null($own))
      $own = false;
		  
		
		$c = new Criteria();
		
	  if($own){
      $crit = new Criteria();
      $crit->add(ClientPeer::USER_ID, $profile->getId());
      $client = ClientPeer::doSelectOne($crit);
      
      if(is_null($client)){
        $this->forward404("Please contact Tufts Photo support.");
      }
      
      $crit = new Criteria();
      $ids = array();
      $crit->add(JobClientPeer::CLIENT_ID, $client->getId());
      $jobs = JobClientPeer::doSelectJoinAll($crit);
        
      foreach($jobs as $ph){
        $ids[] = $ph->getJobId();
      }
      $c->add(JobPeer::ID, $ids, Criteria::IN);
    }else{
    	// $c->add(JobPeer::STATUS_ID, sfConfig::get("job_status_pending"));
    	$c = new Criteria();
      
    	$crit0 = $c->getNewCriterion(JobPeer::STATUS_ID, sfConfig::get("app_job_status_pending"));
			$crit1 = $c->getNewCriterion(JobPeer::STATUS_ID, sfConfig::get("app_job_status_accepted"));
			$crit2 = $c->getNewCriterion(JobPeer::STATUS_ID, sfConfig::get("app_job_status_completed"));
			// Perform OR at level 0 ($crit0 $crit1 $crit2 )
			$crit0->addOr($crit1);
			$crit0->addOr($crit2);
			// Remember to change the peer class here for the correct one in your model
			$c->add($crit0);
    }
    
	  // restrict to only their jobs if they are photogs
    if($profile->getUserType()->getId() 
          == sfConfig::get("app_user_type_photographer")){
        $crit = new Criteria();
        $crit->add(PhotographerPeer::USER_ID, $profile->getId());
        $photo = PhotographerPeer::doSelectOne($crit);
        
        if(is_null($photo)){
          $this->forward404("Please contact Tufts Photo support.");
        }
        
        $crit = new Criteria();
        $crit->add(JobPhotographerPeer::PHOTOGRAPHER_ID, $photo->getId());
        $ids = array();
        $photos = JobPhotographerPeer::doSelectJoinAll($crit);
        
        foreach($photos as $ph){
          $ids[] = $ph->getJobId();
        }
        $c->add(JobPeer::ID, $ids, Criteria::IN);
    }
    
		if (is_null ( $this->sortedBy )) {
			$this->sortedBy = JobPeer::DATE;
		}
		
		if (is_null ( $this->invert ) || $this->invert == "false") {
			$this->invert = false;
			$c->addAscendingOrderByColumn ( $this->sortedBy );
		} else {
			$c->addDescendingOrderByColumn ( $this->sortedBy );
			$this->invert = true;
		}
		
		if (! is_numeric ( $this->page )){
			$this->page = 1;
		}
    
		$this->pager = new sfPropelPager ( "Job", sfConfig::get ( "app_items_per_page" ) );
		$this->pager->setCriteria ( $c );
		$this->pager->setPage ( $this->page );
		$this->pager->setPeerMethod ( "doSelectJoinAll" );
		$this->pager->init ();
		
		$this->results = $this->pager->getResults ();
		sfPropelActAsTaggableBehavior::preloadTags ( $this->results );
	  $sortUrls = array ();
		
	  foreach ( JobPeer::$LIST_VIEW_SORTABLE as $key => $val ) {
	  	$sortUrls [$key] ["true"] = $this->generateUrl ( "client_myjobs_own", array ("own" => $own, "all" => $all, "sortBy" => $key, "invert" => "true" ) );
	  	$sortUrls [$key] ["false"] = $this->generateUrl ( "client_myjobs_own", array ("own" => $own, "all" => $all, "sortBy" => $key, "invert" => "false" ) );
	  }
	  
	  $this->sortUrlJson = json_encode ( $sortUrls );
	  
	}
}
