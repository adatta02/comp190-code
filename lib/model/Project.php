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
}

$columns_map = array(  'from'   => ProjectPeer::NAME,
                       'to'     => ProjectPeer::SLUG);
 
sfPropelBehavior::add('Project', 
                      array('sfPropelActAsSluggableBehavior' => 
                        array('columns' => $columns_map, 
                              'separator' => '_', 'permanent' => true)));