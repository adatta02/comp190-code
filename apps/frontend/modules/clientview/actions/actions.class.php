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
			// send the email to tufts photo and such
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
		$this->own = $own;
    $profile = $this->getUser()->getProfile();
    
		if (! method_exists ( $this->getRoute (), "getObject" )) {
			$c = new Criteria ( );
			$c->add ( StatusPeer::ID, sfConfig::get ( "app_project_list_default_view", 1 ) );
			$showType = StatusPeer::doSelectOne ( $c );
		} else {
			$showType = $this->getRoute ()->getObject ();
		}
	  $this->showType = $showType;
	  		
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
    	$c->add(JobPeer::STATUS_ID, $showType->getId());
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
    
		$this->pager = new sfPropelPager ( "Job", sfConfig::get ( "app_items_per_page" ) );
		$this->pager->setCriteria ( $c );
		$this->pager->setPage ( $this->page );
		$this->pager->setPeerMethod ( "doSelectJoinAll" );
		$this->pager->init ();
		
		$this->results = $this->pager->getResults ();
		sfPropelActAsTaggableBehavior::preloadTags ( $this->results );
	  $sortUrls = array ();
		
	  foreach ( JobPeer::$LIST_VIEW_SORTABLE as $key => $val ) {
	  	$sortUrls [$key] ["true"] = $this->generateUrl ( "client_myjobs", array ("state" => $showType->getState(), "sortBy" => $key, "invert" => "true" ) );
	  	$sortUrls [$key] ["false"] = $this->generateUrl ( "client_myjobs", array ("state" => $showType->getState(), "sortBy" => $key, "invert" => "false" ) );
	  }
	  
	  $this->sortUrlJson = json_encode ( $sortUrls );
	  
	}
}
