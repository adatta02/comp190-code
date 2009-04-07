<?php

class Photographer extends BasePhotographer
{
  public function save(PropelPDO $con = null)
  {
    $logEntry = new Log();
    $logEntry->setWhen(time());
    $logEntry->setPropelClass("Photographer");
    $logEntry->setSfGuardUserProfileId(sfContext::getInstance()->getUser()->getUserId());
    
    // this is a new job
    if($this->isNew()){
      $logEntry->setMessage("Photographer created.");
      $logEntry->setLogMessageTypeId(sfConfig::get("app_log_type_create"));
    }else{
      $logEntry->setMessage("Photographer updated.");
      $logEntry->setLogMessageTypeId(sfConfig::get("app_log_type_update"));
    }
    
    parent::save($con);
    $logEntry->setPropelId($this->getId());
    $logEntry->save();
  }
  
  public function delete(PropelPDO $con = null)
  {
   $logEntry = new Log ( );
   $logEntry->setWhen ( time () );
   $logEntry->setPropelClass ( "Photographer" );
   $logEntry->setSfGuardUserProfileId ( sfContext::getInstance ()->getUser ()->getUserId () );
   $logEntry->setMessage ( "Photographer deleted." );
   $logEntry->setLogMessageTypeId ( sfConfig::get ( "app_log_type_delete" ) );
   $logEntry->setPropelId ( $this->getId () );
   $logEntry->save ();
   
   parent::delete($con);
  }
  
}
