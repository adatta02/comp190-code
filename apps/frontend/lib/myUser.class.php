<?php

class myUser extends sfGuardSecurityUser
{
	/** 
	 * Returns a boolean dependent on if the logged in user is an admin or client.
	 * TODO: Write the method.
	 * @return unknown
	 */
	public function isAdminOrClient(){
		return true;
	}
}
