<?php

/**
 * welcome actions.
 *
 * @package    projectmanager
 * @subpackage welcome
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class welcomeActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new sfGuardFormSignin();
  }
  
  public function executeRedirect(sfWebRequest $request){
  	
  	// check if the logged in user is an admin/client
  	// if they are an admin forward them to the admin panel
  	// if their email address is attached to a job ask if they want to view details of that job
  	// otherwise present the choice of photoshelter or request a job
  	
  }
}
