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
    if($this->getUser()->isAuthenticated()){
    	$this->forward("welcome", "redirect");
    }
  }
  
  public function executeRedirect(sfWebRequest $request){
  	
  	// check if the logged in user is an admin/client
  	// if they are an admin forward them to the admin panel
  	// if their email address is attached to a job ask if they want to view details of that job
  	// otherwise present the choice of photoshelter or request a job
    
  	if( $this->getUser()->getProfile() ){
      $credential = $this->getUser()->getProfile()->getUserType()->getType();
      $this->getUser()->addCredential($credential);
     }
     
  }
  
  public function executePhotoshelter(sfWebRequest $request){
  	$user = $this->getUser();
  	$profile = $user->getProfile();
  	
  	$keyText = file_get_contents(sfConfig::get("sf_root_dir") . "/" . sfConfig::get("app_photoshelter_public_key"));
  	$photoShelterPublic = openssl_pkey_get_public($keyText); 
    
  	$keyText = file_get_contents(sfConfig::get("sf_root_dir") . "/" . sfConfig::get("app_tufts_private_key"));
    $tuftsPrivateKey = openssl_pkey_get_private($keyText); 
  	
    $arr = array();
  	$arr["U_EMAIL"] = $profile->getEmail();
  	$arr["U_PASSWORD"] = "somepass";
  	$arr["U_FIRST_NAME"] = "Ashish";
  	$arr["U_LAST_NAME"] = "Datta";
  	$arr["RL_E"] = "http://www.google.com/";
  	$arr["RL_S"] = "http://www.setfive.com/";
  	$arr["ETIME"] = "60";
  	
  	$queryString = http_build_query($arr);
  	
  	$res = openssl_sign($queryString, $signature, $tuftsPrivateKey);
  	if(!$res){ throw new sfException("Could not sign the payload!", 1); }

  	$res = openssl_public_encrypt($queryString, $crypt, $photoShelterPublic);

    if(!$res){ 
      throw new sfException("Could not encrypt the payload!", 1);
    }

    $this->encodedSignature = base64_encode($signature);
    $this->encodedData = base64_encode($crypt);
    
    var_dump($this->encodedData);
    die();
  }
    
}
