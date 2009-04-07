<?php

/**
 * client actions.
 *
 * @package    projectmanager
 * @subpackage client
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class clientActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeAutocomplete(sfWebRequest $request)
  {
    $this->renderText(json_encode(ClientPeer::getArrayForAutocomplete($request->getParameter("q"))));
    return sfView::NONE;
  }
  
public function executeViewJobs(sfWebRequest $request){
    $this->page = $this->getRequest()->getParameter("page");
    $this->sortedBy = $this->getRequest()->getParameter("sortBy");
    $this->invert = $this->getRequest()->getParameter("invert");
    
    $this->client = $this->getRoute()->getObject();
    $ids = JobClientPeer::getJobsByClientId($this->client->getId());
    
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
      $sortUrls[$key]["true"] = $this->generateUrl("client_view_jobs", 
                                           array("slug" => $this->client->getSlug(), 
                                                 "sortBy" => $key,
                                                 "invert" => "true"));
      $sortUrls[$key]["false"] = $this->generateUrl("photographer_view_jobs", 
                                           array("slug" => $this->client->getSlug(), 
                                                 "sortBy" => $key,
                                                 "invert" => "false")); 
    }
    
    $this->sortUrlJson = json_encode($sortUrls);
  }
  
  public function executeList(sfWebRequest $request){
    $this->page = $request->getParameter("page");
    $this->q = $request->getParameter("q");
    
    if(is_null($this->page)){
     $this->page = 1;
    }
    
    $c = new Criteria();
    $c->addAscendingOrderByColumn(ClientPeer::NAME);
    
    if(is_null($this->q)){
      $this->q = "";
    }else{
      $c = ClientPeer::getCriteriaForAutocomplete($this->q);
    }
    
    $this->pager = new sfPropelPager ( "Client", sfConfig::get("app_items_per_page") );
    $this->pager->setCriteria ( $c );
    $this->pager->setPage ( $this->page );
    $this->pager->init ();
    
    if($request->isXmlHttpRequest()){
      $this->renderPartial("renderList", array("pager" => $this->pager, "q" => $this->q));
      return sfView::NONE;
    }
  }
}
