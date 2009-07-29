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

  public function executeBuilding(sfWebRequest $request)
  {
  	$q = $request->getParameter("q");
  	$this->renderText( json_encode(CampusBuildingPeer::retrieveForAutocomplete($q)) );
  	return sfView::NONE;
  }
  
  public function executeAdvanced(sfWebRequest $request)
  {
  	$this->form = new AdvancedSearchForm();
  }
	
	public function executeAdvancedRender(sfWebRequest $request) {
		$this->form = new AdvancedSearchForm ( );
		
		if (! $request->isMethod ( "POST" )) {
			$this->forward ( "Not Supported!" );
		}
		$this->form->bind ( $request->getParameter ( $this->form->getName () ), $request->getFiles ( $this->form->getName () ) );
		
		$page = $request->getParameter ( $this->form->getName () . "[page]" );
		
		$arr = array();
		$arr["jobStatus"] = $request->getParameter ( $this->form->getName () . "[status_id]" );
		$arr["dueDateStart"] = $this->getFormattedDate($request->getParameter ( $this->form->getName () . "[due_date_start]" ));
		$arr["dueDateEnd"] = $this->getFormattedDate($request->getParameter ( $this->form->getName () . "[due_date_end]" ));
		$arr["shootDateStart"] = $this->getFormattedDate($request->getParameter ( $this->form->getName () . "[shoot_date_start]" ));
		$arr["shootDateEnd"] = $this->getFormattedDate($request->getParameter ( $this->form->getName () . "[shoot_date_end]" ));
		$arr["clientId"] = $request->getParameter ( $this->form->getName () . "[client_id]" );
		$arr["photographerId"] = $request->getParameter ( $this->form->getName () . "[photo_id]" );
		$arr["sortOn"] = $request->getParameter ( $this->form->getName () . "[sort]" );
		$arr["sortDirection"] = $request->getParameter ( $this->form->getName () . "[sort_direction]" );
		
		$c = $this->createAdvancedSearchCriteria($arr);
		
	  $this->pager = new sfPropelPager ( "Job", sfConfig::get("app_items_per_page") );
    $this->pager->setCriteria ( $c );
    $this->pager->setPage ( $page );
    $this->pager->setPeerMethod("doSelectJoinAll");
    $this->pager->init ();
    
    $this->results = $this->pager->getResults();
    sfPropelActAsTaggableBehavior::preloadTags($this->results);
	}
  
}
