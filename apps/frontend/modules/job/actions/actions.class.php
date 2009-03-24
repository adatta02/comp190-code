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
  
	/**
	 * The default landing for project manager.
	 * Lists all the active jobs.
	 *
	 * @param sfWebRequest $request
	 */
	public function executeList(sfWebRequest $request){
		
		$this->page = $request->getParameter("page");
		
		if(!method_exists($this->getRoute(), "getObject")){
			$c = new Criteria();
			$c->add(StatusPeer::ID, sfConfig::get("app_project_list_default_view", 1));
			$showType = StatusPeer::doSelectOne($c);
		}else{
			$showType = $this->getRoute()->getObject();
		}
		
		$this->showing = $showType->getState();
		
		$c = new Criteria();
		$c->add(JobPeer::STATUS_ID, $showType->getId());
		$c->addAscendingOrderByColumn(JobPeer::DATE);
		
		// if this user is only a client 
		// make sure they can only see their jobs
		
		$this->pager = new sfPropelPager ( "Job", 20 );
    $this->pager->setCriteria ( $c );
    $this->pager->setPage ( $this->page );
    $this->pager->init ();
		
    $this->routeObject = $showType;
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
