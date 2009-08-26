<?php

class Job extends BaseJob
{
	
  public function getNumberRevisions(){
		$c = new Criteria();
		$c->add(JobNotesPeer::JOB_ID, $this->getId());
		return JobNotesPeer::doCount($c);
	}
	
	public function setNotes($v)
  {
  	$v = strip_tags($v);
  	$v = nl2br($v);
  	parent::setNotes($v);
  }
	
	public function getPrettyShootDate(){
		return $this->getDate("F j, o") . " " 
		        . $this->getStartTime("g:i A") 
		        . " to " . $this->getEndTime("g:i A");
	}
	
	public function getPrettyAddress(){
		return $this->getStreet() . "\n" 
		       . $this->getCity() . "\n" 
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
	
 public function getPhotographers(){
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
   
		parent::delete($con);
		
		$logEntry = new Log ( );
		$logEntry->setWhen ( time () );
    $logEntry->setPropelClass ( "Job" );
    $logEntry->setSfGuardUserProfileId ( sfContext::getInstance ()->getUser ()->getUserId () );
    $logEntry->setMessage ( "Job deleted." );
    $logEntry->setLogMessageTypeId ( sfConfig::get ( "app_log_type_delete" ) );
    $logEntry->setPropelId ( $this->getId () );
    $logEntry->save ();
   
    sfGCalendar::deleteEventById( $this->getGCalId() );
    
    if( !is_null($this->getGCalIdCustom()) ){
    	sfGCalendar::deleteEventById( $this->getGCalIdCustom() );
    }
    
	}
	
	public function getStartTimestamp(){
		$datetime = $this->getDate("Y-m-d") . " " . $this->getStartTime();
		return strtotime($datetime);
	}
	
  public function getEndTimestamp(){
    $datetime = $this->getDate("Y-m-d") . " " . $this->getEndTime();
    return strtotime($datetime);
  }
	
  public function createCalendarArray(){
  	
  	$prettyLoc = str_replace ( "<br/>", "\n", $this->getPrettyAddress () );
    if(strlen($prettyLoc) == 0){ $prettyLoc = "UNKNOWN"; }
    
    $jobUrl = "https://jobs.tuftsphoto.com/job/show/" . $this->getSlug();
    
  	$arr = array ();
  	
  	$tags = $this->getTags ();
  	$slugs = array();
  	foreach($tags as $key => $val){ $slugs[] = $key; }
  	$slugs = implode(", ", $slugs);
  	
    $arr ["title"] = $this->getId() . " - " . $this->getEvent () . " : " . $slugs;
    $arr ["location"] = $prettyLoc;
    $arr ["content"] = $this->getEvent () . "\n\n" . "<a href='" . $jobUrl . "'>View Job</a>";
    
    $arr ["startTime"] = $this->getStartTimestamp ();
    $arr ["endTime"] = $this->getEndTimestamp();
    
    if( $arr["endTime"] == $arr["startTime"] 
          || $arr["endTime"] < $arr["startTime"]){  
    	$arr ["startTime"] = $this->getDate("Y-m-d");
    	$arr ["endTime"] = $this->getDate("Y-m-d");
    }else{
    	$arr ["startTime"] = sfGCalendar::timestampToRFC3339 ( $arr ["startTime"] );
      $arr ["endTime"] = sfGCalendar::timestampToRFC3339 ( $arr ["endTime"] );
    }
    
    return $arr;
  }
  
	public function save(PropelPDO $con = null)
  {
  	
	 $subject = 'Your job has been created';
	 $message = 'Dear ' .$this->getContactName(). '

		 Your job has been created as Job #'.$this->getId().'. It is currently Pending. 
		 Thank you

		  Regards,
		   Tufts Photo Team';
	 
	 $isNew = $this->isNew();
  	
  	// see if we need to do revision control on the notes
  	$updateNotes = in_array(JobPeer::NOTES, $this->modifiedColumns) && (strlen($this->getNotes() > 1));
  	
  	if(is_null($con)){
  	 $con = Propel::getConnection(JobPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
  	}
  	
  	$con->beginTransaction();
    try {
      $ret = parent::save($con);
      $con->commit();
    }catch (Exception $e) {
      $con->rollBack();
      throw $e;
    }
    
    $arr = $this->createCalendarArray();
		
		$uid = sfContext::getInstance()->getUser()->getUserId();
    if(is_null($uid)){ $uid = 1; }
		
		if ($isNew) {
      $logEntry = new Log();
      $logEntry->setWhen(time());
      $logEntry->setPropelClass("Job");
      $logEntry->setSfGuardUserProfileId($uid);
      $logEntry->setMessage("Job created.");
      $logEntry->setLogMessageTypeId(sfConfig::get("app_log_type_create"));
      $logEntry->setPropelId($this->getId());
      $logEntry->save();
      
      if( !is_null($this->getDate()) ){
        $event = sfGCalendar::createJobEvent ( $arr );
        $this->setGCalId ( $event->id );
			  $this->save();
      }
      
		} else {
			
			if( !is_null($this->getDate()) ){
				if( is_null($this->getGCalId()) ){
	        $event = sfGCalendar::createJobEvent ( $arr );
	        $this->setGCalId ( $event->id );
	        $this->save();
				}else{
					sfGCalendar::updateJobEventById ( $this->getGCalId (), $arr );
				}
				
				if( !is_null($this->getGCalIdCustom()) ){
					$arr["calUrl"] = $this->getGCalIdCustomUrl();
				  sfGCalendar::updateJobEventById ( $this->getGCalIdCustom (), $arr );	
				}
				
			}
			
		}
      
    if($updateNotes){
    	$c = new Criteria();
    	$c->add(JobNotesPeer::JOB_ID, $this->getId());
    	$c->addDescendingOrderByColumn(JobNotesPeer::ID);
    	$old = JobNotesPeer::doSelectOne($c);
    	$rev = (!is_null($old) ? ($old->getRevision() + 1) : 1);
    	    	
    	$jn = new JobNotes();
    	$jn->setJobId($this->getId());
    	$jn->setNotes($this->getNotes());
    	$jn->setRevision($rev);
    	$jn->setUserId(sfContext::getInstance()->getUser()->getUserId());
    	$jn->save();
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
