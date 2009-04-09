<?php
class PMActions extends sfActions
{
	
 protected function getPager($c, $urlInfo = null){
    $this->page = $this->getRequest()->getParameter("page");
    $this->sortedBy = $this->getRequest()->getParameter("sortBy");
    $this->invert = $this->getRequest()->getParameter("invert");
    
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
    
    if(!is_numeric($this->page))
      $this->page = 1;
    
    // if this user is only a client 
    // make sure they can only see their jobs
    
    $this->pager = new sfPropelPager ( "Job", sfConfig::get("app_items_per_page") );
    $this->pager->setCriteria ( $c );
    $this->pager->setPage ( $this->page );
    $this->pager->setPeerMethod("doSelectJoinAll");
    $this->pager->init ();
    
    $this->results = $this->pager->getResults();
    sfPropelActAsTaggableBehavior::preloadTags($this->results);
    
    if(!is_null($urlInfo)){
      
    	$sortUrls = array();
	    
      foreach(JobPeer::$LIST_VIEW_SORTABLE as $key => $val){
	      $sortUrls[$key]["true"] = $this->generateUrl($urlInfo["route"], 
	                                                   array($urlInfo["slugOn"] => $urlInfo["slug"], 
	                                                         "sortBy" => $key,
	                                                         "invert" => "true"));
	      $sortUrls[$key]["false"] = $this->generateUrl($urlInfo["route"], 
	                                                    array($urlInfo["slugOn"] => $urlInfo["slug"], 
	                                                          "sortBy" => $key,
	                                                          "invert" => "false")); 
	    }
	    
	    $this->sortUrlJson = json_encode($sortUrls);
    }
    
  }
	
}
?>