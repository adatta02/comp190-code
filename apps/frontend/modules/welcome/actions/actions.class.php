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
  	
  	$route = str_replace("@", "", sfContext::getInstance()->getRouting()->getCurrentInternalUri(true));
  	
  	// HACK: theres something wrong when it tries to generate a slugged URL
  	/* try{
  	 $url = sfContext::getInstance()->getRouting()->generate($route);
  	}catch(Exception $ex){ 
  		
  	} */
  	
  	if(strpos($route, "?"))
  	 $url = sfContext::getInstance()->getRouting()->generate($route);
  	else 
  	 $url = sfContext::getInstance()->getRouting()->generate("homepage");
  	
    $this->form = new sfGuardFormSignin();
    $this->getUser()->setReferer($url);
  }
  
  public function executeRedirect(sfWebRequest $request){

  	if($this->getUser()->isAuthenticated()){
      if( $this->getUser()->getProfile() ){
        $credential = $this->getUser()->getProfile()->getUserType()->getType();
        $this->getUser()->addCredential($credential);
      }
    }
  
  }
  
  public function executeRedirectError(sfWebRequest $request){
  	$this->error = $request->getParameter("e");
  }
  
  public function executeLoadPhotoshelterForm(sfWebRequest $request){
    $user = $this->getUser();
    $profile = $user->getProfile();
    $email = $profile->getEmail();
    $firstName = $profile->getFirstName();
    $lastName = $profile->getLastName();
    
    // TODO: Users without email addresses cant access photoshelter...
    
    $password = $request->getParameter("password");
    
    $keyText = file_get_contents(sfConfig::get("sf_root_dir") . "/" . sfConfig::get("app_photoshelter_public_key"));
    $photoShelterPublic = openssl_pkey_get_public($keyText); 
    
    $keyText = file_get_contents(sfConfig::get("sf_root_dir") . "/" . sfConfig::get("app_tufts_private_key"));
    $tuftsPrivateKey = openssl_pkey_get_private($keyText); 
    
    $arr = array();
    $arr["U_EMAIL"] = $email;
    $arr["U_PASSWORD"] = $password;
    $arr["U_FIRST_NAME"] = $firstName;
    $arr["U_LAST_NAME"] = $lastName;
    $arr["RL_E"] = $this->generateUrl("photoshelter_error", array(), true);
    $arr["RL_S"] = "http://pa.photoshelter.com/c/tuftsphoto";
    $arr["ETIME"] = time() + 60;
    
    $queryString = http_build_query($arr);
    
    $res = openssl_sign($queryString, $signature, $tuftsPrivateKey);
    if(!$res){ throw new sfException("Could not sign the payload!", 1); }

    $t = openssl_pkey_get_details($photoShelterPublic);
    $t = (int) ($t['bits'] / 8) - 11;
    $l=strlen($queryString);
    $cryptPayload = '';
    
    for ($i=0; $i<$l; $i+= $t) {
      $block = substr($queryString, $i, $t);
      if (!openssl_public_encrypt($block,$tS, $photoShelterPublic)){
                       throw new sfException('failed encrypt', 1);
      }
      $cryptPayload .= $tS;
    }
    
    if(!$res){ 
      throw new sfException("Could not encrypt the payload!", 1);
    }

    $this->encodedSignature = base64_encode($signature);
    $this->encodedData = base64_encode($cryptPayload);
  }
  
  public function executeLoadPhotoshelter(sfWebRequest $request){
  	$this->setLayout("none");
  }
  
  public function executePhotoshelter(sfWebRequest $request){
  	$this->getUser()->setAuthenticated(false);
  	$this->form = new sfGuardFormSignin();
  	$this->getUser()->setReferer("@load_photoshelter");
  }
    
}
