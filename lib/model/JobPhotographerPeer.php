<?php

class JobPhotographerPeer extends BaseJobPhotographerPeer
{
	private static $photographerJobIdCache = array();
	
	public static function getJobsByPhotographerId($photogId){
	  $c = new Criteria();
    $c->add(JobPhotographerPeer::PHOTOGRAPHER_ID, $photogId);
    $obj = JobPhotographerPeer::doSelect($c);
    
    $ids = array();
    foreach($obj as $i){
      $ids[] = $i->getJobId();  
    }
    
    return $ids;
	}
	
 public static function isOwner($jobId, $userId){
    
    $c = new Criteria();
    $c->add(PhotographerPeer::USER_ID, $userId);
    $photog = PhotographerPeer::doSelectOne($c);
    
    if(is_null($photog)){
      return false;
    }
    $cid = $photog->getId();
    
    if(!array_key_exists($cid, self::$photographerJobIdCache)){
      self::$photographerJobIdCache[$cid] = array();
      self::$photographerJobIdCache[$cid] = self::getJobsByPhotographerId($cid);
    }
    
    return in_array($jobId, self::$photographerJobIdCache[$cid]);
  }
	
}
