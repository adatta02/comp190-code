<?php

class JobNotes extends BaseJobNotes
{
	public function getUserName(){
		$userProfile = $this->getsfGuardUserProfile();
		if($userProfile){
		 return $userProfile->getSfGuardUser()->getUsername();
		}else{
			return "";
		}
	}
}
