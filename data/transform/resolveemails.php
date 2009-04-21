<?php

error_reporting(E_ALL);
include_once "../../config/ProjectConfiguration.class.php";

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', true);
$sfContext = sfContext::createInstance($configuration);
$sfContext->dispatch();

$res = ldap_connect ( "ldaps://ldap.tufts.edu/", 636 );
$anon = ldap_bind($res);

if(!$anon){
  echo ldap_error($res) . "\n";
  exit();
}

$users = sfGuardUserPeer::doSelect(new Criteria());
foreach($users as $u){
	
	if(strpos($u->getUserName(), "@tufts.edu") !== false){

		$c = new Criteria();
		$c->add(sfGuardUserProfilePeer::USER_ID, $u->getId());
		$profile = sfGuardUserProfilePeer::doSelectOne($c);
		
    $result = ldap_search ( $res, "dc=tufts,dc=edu", "mail=" . $u->getUserName() );
    $info = ldap_get_entries ( $res, $result );
		if($info["count"]){
			echo $info[0]["uid"][0] . "\n";
			$profile->setEmail(trim($u->getUserName()));
			$profile->save();
			$u->setUserName(trim($info[0]["uid"][0]));
			$u->save();
		}else{
			echo $u->getUserName() . " not found! \n";
			$profile->setEmail("");
			$profile->save();
		}
	}
	
}
?>
