<?php

/**
 * search actions.
 *
 * @package    projectmanager
 * @subpackage search
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class searchActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeJob(sfWebRequest $request)
  {
    $this->searchBox = $request->getParameter("search-box");
  	$ids = JobPeer::executeSearch($this->searchBox);
    
    $this->page = $this->getRequest()->getParameter("page");
    $this->sortedBy = $this->getRequest()->getParameter("sortBy");
    $this->invert = $this->getRequest()->getParameter("invert");
    
    $c = new Criteria();
    $c->add(JobPeer::ID, $ids, Criteria::IN);
    
    if(is_null($this->invert) 
        || $this->invert == "false"){
      $this->invert = false;
    }
    
    if(is_null($this->sortedBy)){
      $this->sortedBy = JobPeer::DATE;
    }
    
    if(!is_numeric($this->page)){
      $this->page = 1;
    }
    
    if($this->invert){
      $c->addDescendingOrderByColumn($this->sortedBy);
    }else{
      $c->addAscendingOrderByColumn($this->sortedBy);
    }

    $this->pager = new sfPropelPager ( "Job", sfConfig::get("app_items_per_page") );
    $this->pager->setCriteria ( $c );
    $this->pager->setPage ( $this->page );
    $this->pager->init ();
    
    $sortUrls = array();
    
    foreach(JobPeer::$LIST_VIEW_SORTABLE as $key => $val){
      $sortUrls[$key]["true"] = $this->generateUrl("job_search", 
                                           array("search-box" => $this->searchBox, 
                                                 "sortBy" => $key,
                                                 "invert" => "true"));
      $sortUrls[$key]["false"] = $this->generateUrl("job_search", 
                                           array("search-box" => $this->searchBox, 
                                                 "sortBy" => $key,
                                                 "invert" => "false")); 
    }
    
    $this->sortUrlJson = json_encode($sortUrls);
  }
}
