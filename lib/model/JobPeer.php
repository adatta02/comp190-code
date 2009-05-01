<?php

class JobPeer extends BaseJobPeer
{
	public static $LIST_VIEW_SORTABLE = array( JobPeer::ID => "Job Id", 
                                           JobPeer::DATE => "Date", 
                                           JobPeer::EVENT => "Event Name",
                                           JobPeer::STATUS_ID => "Status" );
  
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
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
		
    $c = new Criteria();
    $crit0 = $c->getNewCriterion(JobPeer::EVENT, $q . '%', Criteria::LIKE);
    $crit1 = $c->getNewCriterion(JobPeer::ID, $q . '%', Criteria::LIKE);
    // Perform OR at level 0 ($crit0 $crit1 )
    $crit0->addOr($crit1);
    // Remember to change the peer class here for the correct one in your model
    $c->add($crit0);
		$c->addDescendingOrderByColumn(JobPeer::EVENT);
		$c->setLimit(10);
		
		$jobs = JobPeer::doSelect($c);
		$arr = array();
		foreach($jobs as $j){
			$arr[] = array("name" => $j->getId() . " - " . $j->getEvent(), 
			               "url" => url_for('job_show', array("slug" => $j->getSlug())));
		}
		
		return $arr;
	}
	
	public static function addEmailLogMessage($jobId, $emailType, $toUser){
		$logEntry = new Log();
    $logEntry->setWhen(time());
    $logEntry->setPropelClass("Job");
    $logEntry->setSfGuardUserProfileId(sfContext::getInstance()->getUser()->getUserId());
    $logEntry->setMessage($emailType . " sent to user " . $toUser);
    $logEntry->setLogMessageTypeId(sfConfig::get("app_log_type_email"));
    $logEntry->setPropelId($jobId);
    $logEntry->save();
	}
	
}
