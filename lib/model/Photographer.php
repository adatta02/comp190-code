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
  
  public function getNumberOfJobs(){
  	$c = new Criteria();
  	$c->add(JobPhotographerPeer::PHOTOGRAPHER_ID, $this->getId());
  	return JobPhotographerPeer::doCount($c);
  }
  
}

$columns_map = array(  'from'   => PhotographerPeer::EMAIL,
                       'to'     => PhotographerPeer::SLUG);
sfPropelBehavior::add('Photographer', 
                      array('sfPropelActAsSluggableBehavior' => 
                        array('columns' => $columns_map, 
                              'separator' => '_', 'permanent' => true)));
