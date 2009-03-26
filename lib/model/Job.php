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
}

$columns_map = array(  'from'   => JobPeer::EVENT,
                       'to'     => JobPeer::SLUG);
 
sfPropelBehavior::add('Job', 
                      array('sfPropelActAsSluggableBehavior' => 
                        array('columns' => $columns_map, 
                                'separator' => '_', 'permanent' => true)));