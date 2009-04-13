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
    if( $this->getUser()->getProfile() ){
     $credential = $this->getUser()->getProfile()->getUserType()->getType();
     
     switch($credential){
     	case sfConfig::get("app_user_type_admin"):
     		$this->getUser()->addCredential("admin");
     		break;
      case sfConfig::get("app_user_type_photographer"):
        $this->getUser()->addCredential("photographer");
        break;
      case sfConfig::get("app_user_type_client"):
        $this->getUser()->addCredential("client");
        break;
     	default:
     	case sfConfig::get("app_user_type_user"):
     		$this->getUser()->addCredential("user");
     		break;
     }
    }
    
  }
}
