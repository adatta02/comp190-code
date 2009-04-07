<?php

class Delivery extends BaseDelivery
{
	
  public function save(PropelPDO $con = null)
  {
    $logEntry = new Log();
    $logEntry->setWhen(time());
    $logEntry->setPropelClass("Delivery");
    $logEntry->setSfGuardUserProfileId(sfContext::getInstance()->getUser()->getUserId());
    
    // this is a new job
    if($this->isNew()){
      $logEntry->setMessage("Delivery created.");
      $logEntry->setLogMessageTypeId(sfConfig::get("app_log_type_create"));
    }else{
      $logEntry->setMessage("Delivery updated.");
      $logEntry->setLogMessageTypeId(sfConfig::get("app_log_type_update"));
    }
    
    parent::save($con);
    $logEntry->setPropelId($this->getId());
    $logEntry->save();
  }
	
}
