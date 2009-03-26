<?php
class staticComponents extends sfComponents
{
	public function executeShortcuts()
	{
		$this->states = StatusPeer::doSelect(new Criteria());
		$this->sortBy = array(  JobPeer::ID => "Job Id",
		                        JobPeer::DATE => "Date", 
		                        JobPeer::EVENT => "Event Name", 
		                     );
	}
	
	public function executePager(){
		
	}
	
  public function executePropelPager(){
    
  }
	
	public function executeTopmenu(){
				
		$options = StatusPeer::doSelect(new Criteria());
		$this->options = array();
		
		foreach($options as $i){
			
			if($i == $this->moveToSkip)
			 continue;
			
			$this->options[$i->getId()] = $i->getState();
		}
		
	}
}
?>