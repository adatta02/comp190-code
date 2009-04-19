<?php

/**
 * search actions.
 *
 * @package    projectmanager
 * @subpackage search
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class searchActions extends PMActions 
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeJob(sfWebRequest $request)
  {
    $this->searchBox = $request->getParameter("search-box");
    $c = JobPeer::executeSearch($this->searchBox);
    
    $this->getPager($c, array("route" => "job_search", 
                              "slugOn" => "search-box", 
                              "slug" => $this->searchBox));
  }

  public function executeAdvanced(sfWebRequest $request)
  {
  	$this->form = new AdvancedSearchForm();
  }
	
  private function getFormattedDate($widget){
    
  	if(strlen($widget["month"]) && strlen($widget["year"]) && strlen($widget["day"]))
     return $widget["year"] . "-" . $widget["month"] . "-" . $widget["day"];
  	
  	if(strlen($widget["month"]) && strlen($widget["year"]))
     return $widget["year"] . "-" . $widget["month"];
     
  	 return null;
  }
  
	public function executeAdvancedRender(sfWebRequest $request) {
		$this->form = new AdvancedSearchForm ( );
		
		if (! $request->isMethod ( "POST" )) {
			$this->forward ( "Not Supported!" );
		}
		$this->form->bind ( $request->getParameter ( $this->form->getName () ), $request->getFiles ( $this->form->getName () ) );
		
		$page = $request->getParameter ( $this->form->getName () . "[page]" );
		$jobStatus = $request->getParameter ( $this->form->getName () . "[status_id]" );
		$dueDateStart = $this->getFormattedDate($request->getParameter ( $this->form->getName () . "[due_date_start]" ));
		$dueDateEnd = $this->getFormattedDate($request->getParameter ( $this->form->getName () . "[due_date_end]" ));
		$shootDateStart = $this->getFormattedDate($request->getParameter ( $this->form->getName () . "[shoot_date_start]" ));
		$shootDateEnd = $this->getFormattedDate($request->getParameter ( $this->form->getName () . "[shoot_date_end]" ));
		$clientId = $request->getParameter ( $this->form->getName () . "[client_id]" );
		$photographerId = $request->getParameter ( $this->form->getName () . "[photo_id]" );
		$sortOn = $request->getParameter ( $this->form->getName () . "[sort]" );
		$sortDirection = $request->getParameter ( $this->form->getName () . "[sort_direction]" );
		
		$c = new Criteria ( );
		
		if(strlen($jobStatus))
		  $c->add( JobPeer::STATUS_ID, $jobStatus );
		
		if (! is_null ( $dueDateStart ))
			$c->add ( JobPeer::DUE_DATE, $dueDateStart, Criteria::GREATER_EQUAL );
		
		if (! is_null ( $dueDateEnd ))
			$c->addAnd ( JobPeer::DUE_DATE, $dueDateEnd, Criteria::LESS_EQUAL );
		
		if (! is_null ( $shootDateStart ))
			$c->add ( JobPeer::DATE, $shootDateStart, Criteria::GREATER_EQUAL );
		
		if (! is_null ( $shootDateEnd ))
			$c->addAnd ( JobPeer::DATE, $shootDateEnd, Criteria::LESS_EQUAL );

		if(strlen($clientId)){
			$cc = new Criteria();
			$cc->add(JobClientPeer::CLIENT_ID, $clientId);
			$clients = JobClientPeer::doSelectJoinAll($cc);
			$jobIds = array();
			
			foreach($clients as $client){
				$jobIds[] = $client->getJob()->getId();
			}
			
			$c->add(JobPeer::ID, $jobIds, Criteria::IN);
		}
		
		if(strlen($photographerId)){
      $cc = new Criteria();
      $cc->add(JobPhotographerPeer::PHOTOGRAPHER_ID, $photographerId);
      $photogs = JobPhotographerPeer::doSelectJoinAll($cc);
      $jobIds = array();
      
      foreach($photogs as $ph){
        $jobIds[] = $ph->getJob()->getId();
      }
      
      $c->addAnd(JobPeer::ID, $jobIds, Criteria::IN);
		}
		
		if($sortDirection == 1){
			$c->addDescendingOrderByColumn($sortOn);
		}else{
			$c->addAscendingOrderByColumn($sortOn);
		}
		
	  $this->pager = new sfPropelPager ( "Job", sfConfig::get("app_items_per_page") );
    $this->pager->setCriteria ( $c );
    $this->pager->setPage ( $page );
    $this->pager->setPeerMethod("doSelectJoinAll");
    $this->pager->init ();
    
    $this->results = $this->pager->getResults();
    sfPropelActAsTaggableBehavior::preloadTags($this->results);
	}
  
}
