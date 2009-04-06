<?php

/**
 * tag actions.
 *
 * @package    projectmanager
 * @subpackage tag
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class tagActions extends sfActions
{
	
  public function executeList(sfWebRequest $request)
  {
  	$this->page = $this->getRequest()->getParameter("page");
    $this->sortedBy = $this->getRequest()->getParameter("sortBy");
    $this->invert = $this->getRequest()->getParameter("invert");
  	
    $this->tag = $this->getRoute()->getObject();
    $ids = TaggingPeer::getJobIdsByTag($this->tag);
    
    $c = new Criteria();
    $c->add(JobPeer::ID, $ids, Criteria::IN);
    
    if(is_null($this->sortedBy)){
      $this->sortedBy = JobPeer::DATE;
    }
    if(is_null($this->invert) || $this->invert == "false"){
      $this->invert = false;
      $c->addAscendingOrderByColumn($this->sortedBy);
    }else{
    	$c->addDescendingOrderByColumn($this->sortedBy);
    	$this->invert = true;
    }
    
    if(!is_numeric($this->page)){
      $this->page = 1;
    }

    $this->pager = new sfPropelPager ( "Job", sfConfig::get("app_items_per_page") );
    $this->pager->setCriteria ( $c );
    $this->pager->setPage ( $this->page );
    $this->pager->init ();
    
    $sortUrls = array();
    
    foreach(JobPeer::$LIST_VIEW_SORTABLE as $key => $val){
      $sortUrls[$key]["true"] = $this->generateUrl("job_listby_tag", 
                                           array("name" => $this->tag->getName(), 
                                                 "sortBy" => $key,
                                                 "invert" => "true"));
      $sortUrls[$key]["false"] = $this->generateUrl("job_listby_tag", 
                                           array("name" => $this->tag->getName(), 
                                                 "sortBy" => $key,
                                                 "invert" => "false")); 
    }
    
    $this->sortUrlJson = json_encode($sortUrls);
  }

  public function executeAutocomplete(sfWebRequest $request){
    $this->renderText(json_encode(TaggingPeer::getNamesForAutocomplete($request->getParameter("q"))));
    return sfView::NONE;
  }
  
}
