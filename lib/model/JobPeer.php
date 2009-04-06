<?php

class JobPeer extends BaseJobPeer
{
	public static $LIST_VIEW_SORTABLE = array( JobPeer::ID => "Job Id", 
                                           JobPeer::DATE => "Date", 
                                           JobPeer::EVENT => "Event Name" );
  
  public static function setJobProjectIds($jobs, $projectId){  
   $c1 = new Criteria();
   $c2 = new Criteria();
   $c1->add(JobPeer::ID, $jobs, Criteria::IN);
   $c2->add(JobPeer::PROJECT_ID, $projectId);
   BasePeer::doUpdate($c1, $c2, Propel::getConnection());
  }
  
  public static function setJobStateIds($jobs, $stateId){
    $c1 = new Criteria();
    $c2 = new Criteria();
    $c1->add(JobPeer::ID, $jobs, Criteria::IN);
    $c2->add(JobPeer::STATUS_ID, $stateId);
    BasePeer::doUpdate($c1, $c2, Propel::getConnection());
  }
}
