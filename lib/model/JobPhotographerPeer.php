<?php

class JobPhotographerPeer extends BaseJobPhotographerPeer
{
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
}
