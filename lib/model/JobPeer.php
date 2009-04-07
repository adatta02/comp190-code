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
  
  // these two functions are from the Symfony Jobeet tutorial
  static public function getLuceneIndex() {
    ProjectConfiguration::registerZend ();
		
    if (file_exists ( $index = self::getLuceneIndexFile () )) {
			return Zend_Search_Lucene::open ( $index );
		} else {
			return Zend_Search_Lucene::create ( $index );
		}
	}
	
	static private function getLuceneIndexFile() {
		return sfConfig::get ( 'sf_data_dir' ) . '/job.' . sfConfig::get ( 'sf_environment' ) . '.index';
	}
  
	public static function doDeleteAll($con = null)
	{
	  if (file_exists($index = self::getLuceneIndexFile()))
	  {
	    sfToolkit::clearDirectory($index);
	    rmdir($index);
	  }
	 
	  return parent::doDeleteAll($con);
	}
  
	public static function executeSearch($q){
    $hits = self::getLuceneIndex()->find($q);
    
    $pks = array();
    foreach ($hits as $hit)
    {
      $pks[] = $hit->pk;
    }
		
    return $pks;
	}
}
