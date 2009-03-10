<?php
class staticComponents extends sfComponents
{
	public function executeShortcuts()
	{
		$this->states = StatusPeer::doSelect(new Criteria());
	}
	
	public function executePager(){
		
	}
	
	public function executeTopmenu(){
		$this->options = StatusPeer::doSelect(new Criteria());
	}
}
?>