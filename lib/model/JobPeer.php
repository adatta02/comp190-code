<?php

sfContext::getInstance()->getConfiguration()->loadHelpers('Url');

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
   $project = ProjectPeer::retrieveByPK($projectId);
   
   foreach($jobs as $id){
	   $logEntry = new Log ( );
	   $logEntry->setWhen ( time () );
	   $logEntry->setPropelClass ( "Job" );
	   $logEntry->setSfGuardUserProfileId ( sfContext::getInstance ()->getUser ()->getUserId () );
	   $logEntry->setMessage ( "Moved job to project" . $project->getName() );
	   $logEntry->setLogMessageTypeId ( sfConfig::get ( "app_log_type_move_to_project" ) );
	   $logEntry->setPropelId ( $id );
	   $logEntry->save ();
   }
   
  }
  
  public static function setJobStateIds($jobs, $stateId){
    $c1 = new Criteria();
    $c2 = new Criteria();
    $c1->add(JobPeer::ID, $jobs, Criteria::IN);
    $c2->add(JobPeer::STATUS_ID, $stateId);
    BasePeer::doUpdate($c1, $c2, Propel::getConnection());
    $state = StatusPeer::retrieveByPK($stateId);
    
    foreach($jobs as $id){
     $logEntry = new Log ( );
     $logEntry->setWhen ( time () );
     $logEntry->setPropelClass ( "Job" );
     $logEntry->setSfGuardUserProfileId ( sfContext::getInstance ()->getUser ()->getUserId () );
     $logEntry->setMessage ( "Changed job state to " . $state->getState() );
     $logEntry->setLogMessageTypeId ( sfConfig::get ( "app_log_type_change_status" ) );
     $logEntry->setPropelId ( $id );
     $logEntry->save ();
    }
  }
    
	public static function executeSearch($q){
		$c = new Criteria();
		$c->add(JobPeer::EVENT, "%" . $q . "%", Criteria::LIKE);
    return $c;
	}
	
	public static function getJobsForAutocomplete($q){
		$c = new Criteria();
    $c->add(JobPeer::EVENT, $q . "%", Criteria::LIKE);
		$c->addDescendingOrderByColumn(JobPeer::EVENT);
		$c->setLimit(10);
		
		$jobs = JobPeer::doSelect($c);
		$arr = array();
		foreach($jobs as $j){
			$arr[] = array("name" => $j->getEvent(), 
			               "url" => url_for('job_show', array("slug" => $j->getSlug())));
		}
		
		return $arr;
	}
}
