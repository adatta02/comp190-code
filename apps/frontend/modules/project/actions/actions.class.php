<?php

/**
 * project actions.
 *
 * @package    projectmanager
 * @subpackage project
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class projectActions extends sfActions
{
  
	public function executeAutocomplete(sfWebRequest $request){
		$q = $request->getParameter("q");
		$this->renderText(ProjectPeer::getNamesForAutocomplete($q));
		
		return sfView::NONE;
	}
	
	public function executeCreate(sfWebRequest $request){
		$name = $request->getParameter("name");
		
		if(strlen($name) > 1 && strlen($name) < 45){
		  $p = new Project();
		  $p->setName($name);
		  $p->save();
		}else{
			$this->forward404("The project name is to long!");
		}
		
		$this->executeList($request);
		$this->setLayout("list");
	}
	
	public function executeList(sfWebRequest $request){
		$this->page = $request->getParameter("page");
		
		$c = new Criteria();
		$c->addAscendingOrderByColumn(ProjectPeer::NAME);
    $this->pager = new sfPropelPager ( "Project", sfConfig::get("app_items_per_page") );
    $this->pager->setCriteria ( $c );
    $this->pager->setPage ( $this->page );
    $this->pager->init ();
	}
	
  public function executeView(sfWebRequest $request){
  	$this->page = $this->getRequest()->getParameter("page");
    $this->sortedBy = $this->getRequest()->getParameter("sortBy");
    $this->invert = $this->getRequest()->getParameter("invert");
    
  	$this->project = $this->getRoute()->getObject();
  	$c = new Criteria();
  	$c->add(JobPeer::PROJECT_ID, $this->project->getId());
  	
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
      $sortUrls[$key]["true"] = $this->generateUrl("project_view", 
                                           array("slug" => $this->project->getSlug(), 
                                                 "sortBy" => $key,
                                                 "invert" => "true"));
      $sortUrls[$key]["false"] = $this->generateUrl("project_view", 
                                           array("slug" => $this->project->getSlug(), 
                                                 "sortBy" => $key,
                                                 "invert" => "false")); 
    }
    
    $this->sortUrlJson = json_encode($sortUrls);
    
  }
  
}
