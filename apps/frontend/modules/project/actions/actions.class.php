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
  
	/**
	 * Executes the create action. 
	 * Displays a form to the user or deals with the save.
	 *
	 * @param sfWebRequest $request
	 */
  public function executeCreate(sfWebRequest $request){
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
  	
  }
  
}
