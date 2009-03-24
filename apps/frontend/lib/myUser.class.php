<?php

class myUser extends sfGuardSecurityUser
{
	/** 
	 * Returns a boolean dependent on if the logged in user is an admin or client.
	 * @return unknown
	 */
	public function isAdminOrClient(){
		$type = $this->getProfile()->getUserTypeId();
		
		return ($type == sfConfig::get("app_user_type_admin") ||
		        $type == sfConfig::get("app_user_type_client") ); 
	}
	
	
}
