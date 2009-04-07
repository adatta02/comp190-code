<?php

class Project extends BaseProject
{
  public function __toString(){
    return $this->getName();
  }
  
  public function getNumberOfJobs(){
  	$c = new Criteria();
  	$c->add(JobPeer::PROJECT_ID, $this->getId());
  	return JobPeer::doCount($c);
  }
  
  public function save(PropelPDO $con = null)
  {
    $logEntry = new Log();
    $logEntry->setWhen(time());
    $logEntry->setPropelClass("Project");
    $logEntry->setSfGuardUserProfileId(sfContext::getInstance()->getUser()->getUserId());
    
    // this is a new job
    if($this->isNew()){
      $logEntry->setMessage("Project created.");
      $logEntry->setLogMessageTypeId(sfConfig::get("app_log_type_create"));
    }else{
      $logEntry->setMessage("Project updated.");
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
   $logEntry->setPropelClass ( "Project" );
   $logEntry->setSfGuardUserProfileId ( sfContext::getInstance ()->getUser ()->getUserId () );
   $logEntry->setMessage ( "Project deleted." );
   $logEntry->setLogMessageTypeId ( sfConfig::get ( "app_log_type_delete" ) );
   $logEntry->setPropelId ( $this->getId () );
   $logEntry->save ();
   
   parent::delete($con);
  }
  
}

$columns_map = array(  'from'   => ProjectPeer::NAME,
                       'to'     => ProjectPeer::SLUG);
 
sfPropelBehavior::add('Project', 
                      array('sfPropelActAsSluggableBehavior' => 
                        array('columns' => $columns_map, 
                              'separator' => '_', 'permanent' => true)));