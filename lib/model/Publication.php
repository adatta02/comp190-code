<?php

class Publication extends BasePublication
{
	public function __toString(){
		return $this->getName();
	}
	
  public function save(PropelPDO $con = null)
  {
  	/*
    $logEntry = new Log();
    $logEntry->setWhen(time());
    $logEntry->setPropelClass("Publication");
    $logEntry->setSfGuardUserProfileId(sfContext::getInstance()->getUser()->getUserId());
    
    // this is a new job
    if($this->isNew()){
      $logEntry->setMessage("Publication created.");
      $logEntry->setLogMessageTypeId(sfConfig::get("app_log_type_create"));
    }else{
      $logEntry->setMessage("Publication updated.");
      $logEntry->setLogMessageTypeId(sfConfig::get("app_log_type_update"));
    }
    
    parent::save($con);
    $logEntry->setPropelId($this->getId());
    $logEntry->save();
    */
  	parent::save( $con );
  }
	
}
