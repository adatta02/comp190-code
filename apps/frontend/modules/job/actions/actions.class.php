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
  
	private function reloadByTag($tagId){
		
		$c = new Criteria();
		$this->routeObject = TagPeer::retrieveByPK($tagId);
		
		$ids = TaggingPeer::getJobIdsByTag($this->routeObject);
    $c->add(JobPeer::ID, $ids, Criteria::IN);
    
    $this->route = "job_listby_tag";
    $this->propelType = "tag";
    $this->renderStatus = true;
    $this->viewingCaption = " taggings for " . $this->routeObject->__toString();
    
    return $c;
	}
	
	private function reloadByState($stateId){
	  $c = new Criteria();
		$c->add(JobPeer::STATUS_ID, $stateId);
		
	  $this->routeObject = StatusPeer::retrieveByPK($stateId);
	  $this->route = "job_list_by";
	  $this->propelType = "state";
	  $this->renderStatus = false;
	  $this->viewingCaption = $this->routeObject->__toString();
	  
	  return $c;
	}
	
	private function reloadByProject($projectId){
	  
		$c = new Criteria();
		$c->add(JobPeer::PROJECT_ID, $projectId);
   
	  $this->routeObject = ProjectPeer::retrieveByPK($projectId);
    $this->route = "project_view";
    $this->propelType = "project";
    $this->renderStatus = true;
    $this->viewingCaption = " project " . $this->routeObject->__toString();
    
    return $c;
	}
	
	private function reloadBySearch($searchQuery){
	 
		$c = new Criteria();
		$ids = JobPeer::executeSearch($searchQuery);
    $c->add(JobPeer::ID, $ids, Criteria::IN);
    
    $this->routeObject = $searchQuery;
    $this->route = "job_search";
    $this->propelType = "search-box";
    $this->renderStatus = true;
    $this->viewingCaption = " results for " . $this->routeObject->__toString();
    
    return $c;
	}
	
	private function createPager($stateId = null){
		$this->page = $this->getRequest()->getParameter("page");
    $this->sortedBy = $this->getRequest()->getParameter("sortBy");
		$this->invert = $this->getRequest()->getParameter("invert");
    
		if(is_null($stateId)){
		  $obj = json_decode($this->getRequest()->getParameter("obj"), true);
		  $reloadFunction = $obj["reloadFunction"];
		  $reloadParam = $obj["reloadParam"];
		  
		  if(!method_exists($this, $reloadFunction)){
		  	$this->forward404("Fatal Application Error!");
		  }
		  
		}else{
			$reloadFunction = "reloadByState";
			$reloadParam = $stateId;
		}
		
		$c = $this->$reloadFunction($reloadParam);
		
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
	
	public function executeAddPhotographer(sfWebRequest $request){
		$obj = json_decode($request->getParameter("obj"), true);
		$job = JobPeer::retrieveByPK($obj["viewingJobId"]);
		$photographer = PhotographerPeer::retrieveByPK($obj["photographerId"]);
		
		if(!is_null($job) && !is_null($photographer)){
			$res = $job->addPhotographer($photographer);
		}
		
    $this->renderPartial("photographerList", array("job" => $job));
    return sfView::NONE;
	}
	
  public function executeRemovePhotographer(sfWebRequest $request){
    $obj = json_decode($request->getParameter("obj"), true);
    $job = JobPeer::retrieveByPK($obj["viewingJobId"]);
    $photographer = PhotographerPeer::retrieveByPK($obj["photographerId"]);
    
    if(!is_null($job) && !is_null($photographer)){
    	$job->removePhotographer($photographer);
    }
    
    $this->renderPartial("photographerList", array("job" => $job));
    return sfView::NONE;
  }
	
	public function executeAddClient(sfWebRequest $request){
		$obj = json_decode($request->getParameter("obj"), true);
		$client = ClientPeer::retrieveByPK($obj["clientId"]);
		$job = JobPeer::retrieveByPK($obj["viewingJobId"]);
		
		if(!is_null($client) && !is_null($job)){
			$res = $job->addClient($client);
		}
		
		$this->renderPartial("clientList", array("job" => $job));
		return sfView::NONE;
	}
	
 public function executeRemoveClient(sfWebRequest $request){
    $obj = json_decode($request->getParameter("obj"), true);
    $client = ClientPeer::retrieveByPK($obj["clientId"]);
    $job = JobPeer::retrieveByPK($obj["viewingJobId"]);
    
    if(!is_null($client) && !is_null($job)){
    	$job->removeClient($client);
    }
    
    $this->renderPartial("clientList", array("job" => $job));
    return sfView::NONE;
  }
	
	public function executeAddProject(sfWebRequest $request){
    $obj = json_decode($request->getParameter("obj"), true);
    $jobs = $obj["jobs"];
    
    $addProjectId = $obj["addProjectId"];
    $projectName = $obj["projectName"];
    $createNew = $obj["createNew"];
    $removeFromProject = $obj["removeFromProject"];
    
    if(!$removeFromProject){
	    
    	if($createNew){
	    	$project = new Project();
	    	$project->setName($projectName);
	    	$project->save();
	    }else{
	    	$project = ProjectPeer::retrieveByPK($addProjectId);
	    }
	    
	    $projectId = $project->getId();
	    
    }else{
    	$projectId = null;
    }
    
    if($removeFromProject 
        || !is_null($projectId)){
      JobPeer::setJobProjectIds($jobs, $projectId);
    }
    
		$this->createPager();
    $this->setTemplate("reload");
	}
	
  public function executeMove(sfWebRequest $request){
    
    $obj = json_decode($request->getParameter("obj"), true);
  	$jobs = $obj["jobs"];
    $toState = $obj["state"];
    
    if($toState < 1)
      return;
    
    JobPeer::setJobStateIds($jobs, $toState);
    
    $this->createPager();
    $this->setTemplate("reload");
  }
	
  public function executeRemoveTag(sfWebRequest $request){
    $obj = json_decode($request->getParameter("obj"), true);
    
    $jobId = $obj["jobId"];
    $tagVal = $obj["tagVal"];
    
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
    $addTagId = $obj["addTagId"];
    
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
  	
  	$this->form = new RequestJobForm();
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
      $this->redirect("@job_list");
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
