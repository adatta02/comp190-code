<?php

class Job extends BaseJob
{
	public function getPrettyShootDate(){
		return $this->getDate("F n, o") . " " 
		        . $this->getStartTime("g:i A") 
		        . " to " . $this->getEndTime("g:i A");
	}
	
	public function getPrettyAddress(){
		return $this->getStreet() . "<br/>" 
		       . $this->getCity() . "<br/>" 
		       . $this->getState() . ", " . $this->getZip();
	}
	
	public function getClients(){
		$c = new Criteria();
		$c->add(JobClientPeer::JOB_ID, $this->getId());
		
		$clientIds = array();
		$jc = JobClientPeer::doSelect($c);
		
		foreach($jc as $i){
			$clientIds[] = $i->getClientId();
		}
		
		$c = new Criteria();
		$c->add(ClientPeer::ID, $clientIds, Criteria::IN);
		
		return ClientPeer::doSelect($c);
	}
	
 public function getPhotographer(){
    $c = new Criteria();
    $c->add(JobPhotographerPeer::JOB_ID, $this->getId());
    
    $photographerIds = array();
    $jc = JobPhotographerPeer::doSelectJoinPhotographer($c);
    $names = array();
    
    foreach($jc as $j){
    	$names[] = $j->getPhotographer();
    }
    
    return $names;
  }
	
	public function addPhotographer($photographer) {
		
		$c = new Criteria();
		$c->add(JobPhotographerPeer::JOB_ID, $this->getId());
		$c->add(JobPhotographerPeer::PHOTOGRAPHER_ID, $photographer->getId());
		
		if(JobPhotographerPeer::doCount($c) > 0)
		  return false;
		
		$jp = new JobPhotographer ( );
		$jp->setPhotographerId ( $photographer->getId () );
		$jp->setJobId ( $this->getId () );
		$jp->save ();
		
	  $logEntry = new Log();
    $logEntry->setWhen(time());
    $logEntry->setPropelClass("Job");
    $logEntry->setSfGuardUserProfileId(sfContext::getInstance()->getUser()->getUserId());
    $logEntry->setMessage($photographer->getName() . " added to job.");
    $logEntry->setLogMessageTypeId(sfConfig::get("app_log_type_add_photographer"));
    $logEntry->setPropelId($this->getId());
    $logEntry->save();
		
		return true;
	}
  
	public function removePhotographer($photographer){
	 $c = new Criteria();
   $c->add(JobPhotographerPeer::JOB_ID, $this->getId());
   $c->add(JobPhotographerPeer::PHOTOGRAPHER_ID, $photographer->getId());
   JobPhotographerPeer::doDelete($c);
   
   $logEntry = new Log ( );
	 $logEntry->setWhen ( time () );
	 $logEntry->setPropelClass ( "Job" );
	 $logEntry->setSfGuardUserProfileId ( sfContext::getInstance ()->getUser ()->getUserId () );
	 $logEntry->setMessage ( $photographer->getName () . " removed from job." );
	 $logEntry->setLogMessageTypeId ( sfConfig::get ( "app_log_type_remove_photographer" ) );
	 $logEntry->setPropelId ( $this->getId () );
	 $logEntry->save ();
	}
	
	public function addClient($client){
		$c = new Criteria();
		$c->add(JobClientPeer::JOB_ID, $this->getId());
		$c->add(JobClientPeer::CLIENT_ID, $client->getId());
		
		if(JobClientPeer::doCount($c) > 0)
		  return false;
		
		$jc = new JobClient();
		$jc->setClientId($client->getId());
    $jc->setJobId($this->getId());
    $jc->save();
    
    $logEntry = new Log ( );
    $logEntry->setWhen ( time () );
    $logEntry->setPropelClass ( "Job" );
    $logEntry->setSfGuardUserProfileId ( sfContext::getInstance ()->getUser ()->getUserId () );
    $logEntry->setMessage ( $client->getName () . " added to job." );
    $logEntry->setLogMessageTypeId ( sfConfig::get ( "app_log_type_add_client" ) );
    $logEntry->setPropelId ( $this->getId () );
    $logEntry->save ();
    
    return true;
	}
	
	public function removeClient($client){
	 $c = new Criteria();
	 $c->add(JobClientPeer::CLIENT_ID, $client->getId());
   $c->add(JobClientPeer::JOB_ID, $this->getId());
   JobClientPeer::doDelete($c);
   
   $logEntry = new Log ( );
   $logEntry->setWhen ( time () );
   $logEntry->setPropelClass ( "Job" );
   $logEntry->setSfGuardUserProfileId ( sfContext::getInstance ()->getUser ()->getUserId () );
   $logEntry->setMessage ( $client->getName () . " removed from job." );
   $logEntry->setLogMessageTypeId ( sfConfig::get ( "app_log_type_remove_client" ) );
   $logEntry->setPropelId ( $this->getId () );
   $logEntry->save ();
   
	}
	
	public function delete(PropelPDO $con = null)
	{
   $logEntry = new Log ( );
   $logEntry->setWhen ( time () );
   $logEntry->setPropelClass ( "Job" );
   $logEntry->setSfGuardUserProfileId ( sfContext::getInstance ()->getUser ()->getUserId () );
   $logEntry->setMessage ( "Job deleted." );
   $logEntry->setLogMessageTypeId ( sfConfig::get ( "app_log_type_delete" ) );
   $logEntry->setPropelId ( $this->getId () );
   $logEntry->save ();
   
   parent::delete($con);
	}
	
	public function save(PropelPDO $con = null)
  {
  	$logEntry = new Log();
  	$logEntry->setWhen(time());
    $logEntry->setPropelClass("Job");
    $logEntry->setSfGuardUserProfileId(sfContext::getInstance()->getUser()->getUserId());
    
  	// this is a new job
  	if($this->isNew()){
  		$logEntry->setMessage("Job created.");
  		$logEntry->setLogMessageTypeId(sfConfig::get("app_log_type_create"));
  	}else{
      $logEntry->setMessage("Job updated.");
      $logEntry->setLogMessageTypeId(sfConfig::get("app_log_type_update"));
  	}
  	
  	$logEntry->setPropelId($this->getId());
  	
  	if(is_null($con)){
  	 $con = Propel::getConnection(JobPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
  	}
  	
  	$con->beginTransaction();
    try {
      $ret = parent::save($con);
      $logEntry->save();
      $con->commit();
      return $ret;
    }catch (Exception $e) {
      $con->rollBack();
      throw $e;
    }
    
  }
  
}

$columns_map = array(  'from'   => JobPeer::EVENT,
                       'to'     => JobPeer::SLUG);
 
sfPropelBehavior::add('Job', 
                      array('sfPropelActAsSluggableBehavior' => 
                        array('columns' => $columns_map, 
                                'separator' => '_', 'permanent' => true)));
sfPropelBehavior::add('Job', array('sfPropelActAsTaggableBehavior'));