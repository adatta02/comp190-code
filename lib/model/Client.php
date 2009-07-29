<?php

class Client extends BaseClient
{
	
	public function __toString(){
		return $this->getName();
	}
	
  public function save(PropelPDO $con = null)
  {
    $logEntry = new Log();
    $logEntry->setWhen(time());
    $logEntry->setPropelClass("Client");
    $logEntry->setSfGuardUserProfileId(sfContext::getInstance()->getUser()->getUserId());
    
    // this is a new job
    if($this->isNew()){
      $logEntry->setMessage("Client created.");
      $logEntry->setLogMessageTypeId(sfConfig::get("app_log_type_create"));
    }else{
      $logEntry->setMessage("Client updated.");
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
   $logEntry->setPropelClass ( "Client" );
   $logEntry->setSfGuardUserProfileId ( sfContext::getInstance ()->getUser ()->getUserId () );
   $logEntry->setMessage ( "Client deleted." );
   $logEntry->setLogMessageTypeId ( sfConfig::get ( "app_log_type_delete" ) );
   $logEntry->setPropelId ( $this->getId () );
   $logEntry->save ();
   
   parent::delete($con);
  }
  
  public function getNumberOfJobs(){
  	$c = new Criteria();
  	$c->add(JobClientPeer::CLIENT_ID, $this->getId());
  	return JobClientPeer::doCount($c);
  }
  
}

$columns_map = array(  'from'   => ClientPeer::EMAIL,
                       'to'     => ClientPeer::SLUG);
sfPropelBehavior::add('Client', array('sfPropelActAsSluggableBehavior' => 
                        	array('columns' => $columns_map, 
                              	      'separator' => '_', 'permanent' => true)));
