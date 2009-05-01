<?php
 
class jobComponents extends sfComponents
{
	public function executeAttachments(){
		$job = $this->job;
		
		$this->attachForm = new JobAttachmentFormCustom();
		$c = new Criteria();
		$c->add(JobAttachmentPeer::JOB_ID, $job->getId());
		$this->attachments = JobAttachmentPeer::doSelectJoinAll($c);
	}
}
?>