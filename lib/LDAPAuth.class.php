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
  public static function checkLDAPPassword($username, $password){

  	// try and validate the user
  	// if the password is null length then reject
  	if(strlen(trim($password)) == 0){
  		self::removeUser($username);
  		return false;
  	}
  	
  	// lets try the ldap
  	$res = ldap_connect ( sfConfig::get("app_ldap_server"), 636 );
  	if(!$res){
  		throw new sfException("Could not connect to the LDAP server!", 0);
  	}
  	
    $result = ldap_search ( $res, "dc=tufts,dc=edu", "uid=" . $username );
    $info = ldap_get_entries ( $res, $result );
    
    // we matched more than one or 0? reject
    if($info["count"] !== 1){
    	self::removeUser($username);
    	ldap_unbind($res);
    	return false;
    }
		
    $result = ldap_bind ( $res, $info [0]["dn"], $password );
    ldap_unbind($res);
    
		if ($result) {
			return true;
		} else {
			self::removeUser($username);
			ldap_unbind($res);
			return false;
		}
    
  }
  
  private static function removeUser($username){
  	$c = new Criteria();
  	$c->add(sfGuardUserPeer::USERNAME, $username);
  	sfGuardUserPeer::doDelete($c);
  }
  
}

?>
