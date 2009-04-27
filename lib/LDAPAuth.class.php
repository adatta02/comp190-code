<?php

/**
 * Handles validating against the Tufts LDAP.
 *
 */
class LDAPAuth extends sfGuardSecurityUser{
	
	/**
	 * Authenticates users against an LDAP directory.
	 * Called by a sfGuard hook.
	 *
	 * @param unknown_type $username
	 * @param unknown_type $password
	 * @return unknown
	 */
  public static function checkLDAPPassword($username, $password, $sfGuard){

  	// try and validate the user
  	// if the password is null length then reject
  	if(strlen(trim($password)) == 0){
  		self::removeUser($username);
  		return false;
  	}
  	
  	// lets try the ldap
  	$res = ldap_connect ( sfConfig::get("app_ldap_server"), 636 );
  	$anon = ldap_bind($res);
  	// I'm not sure how this is going to behave if the LDAP is actually MIA
  	if(!$res || !$anon){
  		// throw new sfException("Could not connect to the LDAP server!", 0);
  		return $sfGuard->checkPasswordByGuard($password);
  	}
  	
    $result = ldap_search ( $res, "dc=tufts,dc=edu", "uid=" . $username );
    $info = ldap_get_entries ( $res, $result );
    
    // we matched more than one or 0?
    if(!$info || $info["count"] !== 1){
    	self::removeUser($username);
    	return $sfGuard->checkPasswordByGuard($password);
    }
		
    $email = ""; $phone = ""; $lastName = ""; $firstName = "";
    if(array_key_exists("mail", $info[0]) && $info[0]["mail"]["count"]){
    	$email = $info[0]["mail"][0];
    }
    if(array_key_exists("telephonenumber", $info[0]) && $info[0]["telephonenumber"]["count"]){
      $phone = $info[0]["telephonenumber"][0];
    }
    if(array_key_exists("tuftsedulegalname", $info[0]) && $info[0]["tuftsedulegalname"]["count"]){
      list($lastName, $firstName) = explode(",", $info[0]["tuftsedulegalname"][0]);
    }
    
    $result = @ldap_bind ( $res, $info [0]["dn"], $password );
        
    if($res)
      ldap_unbind($res);
      
		if ($result) {
      $c = new Criteria();
      $c->add(sfGuardUserPeer::USERNAME, $username);
			$sfUser = sfGuardUserPeer::doSelectOne($c);
      
			$sfprofile = $sfGuard->getProfile();
			$sfprofile->setUserId($sfUser->getId());
			$sfprofile->setUserTypeId(sfConfig::get("app_user_type_user"));
			$sfprofile->setEmail($email);
			$sfprofile->setFirstName($firstName);
			$sfprofile->setLastName($lastName);
			$sfprofile->save();
			
			return true;
		} else {
			self::removeUser($username);
			return $sfGuard->checkPasswordByGuard($password);
		}
    
  }
  
  private static function removeUser($username){
  	$c = new Criteria();
  	$c->add(sfGuardUserPeer::USERNAME, $username);
  	$c->add(sfGuardUserPeer::PASSWORD, NULL);
  	
  	sfGuardUserPeer::doDelete($c);
  }
  
}

?>
