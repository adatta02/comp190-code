<?php

/**
 * project actions.
 *
 * @package    projectmanager
 * @subpackage project
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class jobActions extends sfActions
{
  
	private function createPager($stateId = null){
		$this->page = $this->getRequest()->getParameter("page");
    $this->sortedBy = $this->getRequest()->getParameter("sortBy");
		$this->invert = $this->getRequest()->getParameter("invert");
    
		if(is_null($stateId)){
		  $obj = json_decode($this->getRequest()->getParameter("obj"), true);
      $stateId = $obj["render"];
      $tagId = $obj["tagId"];
      $projectId = $obj["projectId"];
		}
		
		$c = new Criteria();
	  
		if($stateId > 0){
      $c->add(JobPeer::STATUS_ID, $stateId);
      $this->routeObject = StatusPeer::retrieveByPK($stateId);
      $this->route = "job_list_by";
      $this->propelType = "state";
      $this->renderStatus = false;
		} else if($tagId > 0){ 
			$this->routeObject = TagPeer::retrieveByPK($tagId);
			$ids = TaggingPeer::getJobIdsByTag($this->routeObject);
      $c->add(JobPeer::ID, $ids, Criteria::IN);
      
      $this->route = "job_listby_tag";
      $this->propelType = "tag";
      $this->renderStatus = true;
    } else if($projectId > 0){
    	$c->add(JobPeer::PROJECT_ID, $projectId);
    	$this->routeObject = ProjectPeer::retrieveByPK($projectId);
      $this->route = "project_view";
      $this->propelType = "project";
      $this->renderStatus = true;
    }else{
    	$this->forward404("Something went wrong...");
    }
		
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
    $this->pager->init ();
	}
	
	public function executeShow(sfWebRequest $request){
		$this->job = $this->getRoute()->getObject();
	}
	
  public function executeMove(sfWebRequest $request){
    
    $obj = json_decode($request->getParameter("obj"), true);
  	$jobs = $obj["jobs"];
    $toState = $obj["state"];
    $viewState = $obj["render"];
    
    if($toState < 1)
      return;
    
    $c1 = new Criteria();
    $c2 = new Criteria();
    $c1->add(JobPeer::ID, $jobs, Criteria::IN);
    $c2->add(JobPeer::STATUS_ID, $toState);
    BasePeer::doUpdate($c1, $c2, Propel::getConnection());
    
    $this->createPager();
    $this->setTemplate("reload");
  }
	
  public function executeRemoveTag(sfWebRequest $request){
    $obj = json_decode($request->getParameter("obj"), true);
    
    $jobId = $obj["jobId"];
    $tagVal = $obj["tagVal"];
    $viewState = $obj["render"];
    
    $job = JobPeer::retrieveByPK($jobId);
    if(!is_null($job)){
    	$job->removeTag($tagVal);
    	$job->save();
    }
    
    $this->createPager();
    $this->setTemplate("reload");
  }
  
  public function executeAddTag(sfWebRequest $request){
  	$obj = json_decode($request->getParameter("obj"), true);
    
  	$jobs = $obj["jobs"];
    $tags = $obj["tags"];
    $viewState = $obj["render"];
    
    $c = new Criteria();
    $c->add(JobPeer::ID, $jobs, Criteria::IN);
    $jobs = JobPeer::doSelect($c);
    
    foreach($jobs as $j){
    	$j->addTag($tags);
    	$j->save();
    }
    
    $this->createPager();
    $this->setTemplate("reload");
  }
  
	/**
	 * The default landing for project manager.
	 * Lists all the active jobs.
	 *
	 * @param sfWebRequest $request
	 */
	public function executeList(sfWebRequest $request){
		
		if(!method_exists($this->getRoute(), "getObject")){
			$c = new Criteria();
			$c->add(StatusPeer::ID, sfConfig::get("app_project_list_default_view", 1));
			$showType = StatusPeer::doSelectOne($c);
		}else{
			$showType = $this->getRoute()->getObject();
		}
		
		$this->routeObject = $showType;
		$this->createPager($showType->getId());
		
		$sortUrls = array();
		
		foreach(JobPeer::$LIST_VIEW_SORTABLE as $key => $val){
		  $sortUrls[$key]["true"] = $this->generateUrl("job_list_by", 
                                           array("state" => $this->routeObject, 
                                                 "sortBy" => $key,
                                                 "invert" => "true"));
      $sortUrls[$key]["false"] = $this->generateUrl("job_list_by", 
                                           array("state" => $this->routeObject, 
                                                 "sortBy" => $key,
                                                 "invert" => "false"));	
		}
		
		$this->sortUrlJson = json_encode($sortUrls);
	}
	
	/**
	 * Executes the create action. 
	 * Displays a form to the user or deals with the save.
	 *
	 * @param sfWebRequest $request
	 */
  public function executeCreate(sfWebRequest $request){
  	
  	// if this user is a admin or client show a layout otherwise dont
  	if(!$this->getUser()->isAdminOrClient())
  	 $this->setLayout("nomenu");
  	
  	$this->form = new JobForm();
  	if($request->isMethod("POST")){
      $this->processForm($request, $this->form);
  	}
  	
  }
  
  /**
   * Deals with processing and saving the form.
   *
   * @param sfWebRequest $request
   * @param sfForm $form
   */
  private function processForm(sfWebRequest $request, sfForm $form){
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $form->save();
      $this->redirect($this->generateUrl('project_success'));
    }
  }
  
  /**
   * Present the user with a confirmation page. 
   * Send an email maybe?
   *
   * @param sfWebRequest $request
   */
  public function executeSuccess(sfWebRequest $request){
  	// if this user is a admin or client show a layout otherwise dont
  	if(!$this->getUser()->isAdminOrClient())
  	 $this->setLayout("nomenu");
  }
  
}
