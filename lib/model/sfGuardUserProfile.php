<?php

class sfGuardUserProfile extends BasesfGuardUserProfile
{
	public function getUserName(){
		return $this->getSfGuardUser()->getUsername();
	}
}
