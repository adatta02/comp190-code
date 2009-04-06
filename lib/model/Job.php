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
	
 public function getPhotographers(){
    $c = new Criteria();
    $c->add(JobPhotographerPeer::JOB_ID, $this->getId());
    
    $photographerIds = array();
    $jc = JobPhotographerPeer::doSelect($c);
    
    foreach($jc as $i){
      $photographerIds[] = $i->getPhotographerId();
    }
    
    $c = new Criteria();
    $c->add(PhotographerPeer::ID, $photographerIds, Criteria::IN);
    
    return PhotographerPeer::doSelect($c);
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
		
		return true;
	}
  
	public function removePhotographer($photographer){
	 $c = new Criteria();
   $c->add(JobPhotographerPeer::JOB_ID, $this->getId());
   $c->add(JobPhotographerPeer::PHOTOGRAPHER_ID, $photographer->getId());
   JobPhotographerPeer::doDelete($c);
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
    
    return true;
	}
	
	public function removeClient($client){
	 $c = new Criteria();
	 $c->add(JobClientPeer::CLIENT_ID, $client->getId());
   $c->add(JobClientPeer::JOB_ID, $this->getId());
   JobClientPeer::doDelete($c);
	}
	
}

$columns_map = array(  'from'   => JobPeer::EVENT,
                       'to'     => JobPeer::SLUG);
 
sfPropelBehavior::add('Job', 
                      array('sfPropelActAsSluggableBehavior' => 
                        array('columns' => $columns_map, 
                                'separator' => '_', 'permanent' => true)));
sfPropelBehavior::add('Job', array('sfPropelActAsTaggableBehavior'));