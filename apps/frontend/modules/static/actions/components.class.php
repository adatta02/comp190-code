<?php
class staticComponents extends sfComponents
{
	public function executeShortcuts()
	{
		$this->states = StatusPeer::doSelect(new Criteria());
		$this->sortBy = JobPeer::$LIST_VIEW_SORTABLE;
	}
	
 public function executeUserShortcuts()
  {
    $this->states = StatusPeer::doSelect(new Criteria());
    $this->sortBy = JobPeer::$LIST_VIEW_SORTABLE;
    $this->showStates = array("Pending", "Completed", "Accepted");
  }
	
	public function executePager(){
		
	}
	
  public function executePropelPager(){
    
  }
	
	public function executeTopmenu(){
				
		$options = StatusPeer::doSelect(new Criteria());
		$this->options = array("-1" => "");
		
		foreach($options as $i){
			
			if($i == $this->moveToSkip)
			 continue;
			
			$this->options[$i->getId()] = $i->getState();
		}
		
	}
}
?>