<?php

/**
 * Handles validating against the Tufts LDAP.
 *
 */
class LDAPAuth extends sfGuardSecurityUser{
	
	// TODO: Fix this - its just not working
  public static function checkLDAPPassword($username, $password){

  	return true;
  	// try and validate the user
  	// if the password is null length then reject
  	if(strlen(trim($password)) == 0){
  		self::removeUser($username);
  		return false;
  	}
  	
  	// lets try the ldap
  	$res = ldap_connect("ldap://ldap.tufts.edu/", 389);
  	if(!$res){
  		throw new sfException("Could not connect to the LDAP server!", 0);
  	}
  	
    $ldapbind = ldap_bind($res, "dc=tufts,dc=edu,scope sub,filter(uid=" . $username . ")", $password);
    
    // verify binding
    if ($ldapbind) {
        echo "LDAP bind successful...";
    } else {
        echo "LDAP bind failed...";
    }
  	$result = ldap_unbind($res);
  	
  	// if they aren't valid make sure to delete them out of the DB
  	die("0xDEADBEEF");
  }
  
  private static function removeUser($username){
  	$c = new Criteria();
  	$c->add(sfGuardUserPeer::USERNAME, $username);
  	sfGuardUserPeer::doDelete($c);
  }
  
}

?>
