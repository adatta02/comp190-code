<?php

class JobNotes extends BaseJobNotes
{

	public function save(PropelPDO $con = null)
  {
  	$this->setUserId( 1 );
  	parent::save( $con );
  }
	
	public function getUserName(){
		$userProfile = $this->getsfGuardUserProfile();
		if($userProfile){
		 return $userProfile->getSfGuardUser()->getUsername();
		}else{
			return "";
		}
	}
}
