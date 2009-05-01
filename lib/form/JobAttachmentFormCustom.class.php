<?php

class JobAttachmentFormCustom extends sfForm {
  
	private $jobId;
	
	public function setup() {
		
		 $options = array(
      'required' => false,
       'mime_types' => 'upload_files',
       'path' => sfConfig::get('sf_upload_dir'), 
       'mime_categories' => array(
          'upload_files' => array(
            'image/jpeg',
            'image/pjpeg',
            'image/png',
            'image/x-png',
            'image/gif',
		        'application/msword',
		        'application/pdf'
     )));
		
		for($i=0; $i < 5; $i++){
      $this->widgetSchema["file_" . $i] = new sfWidgetFormInputFile();
      $this->validatorSchema["file_" . $i] = new sfValidatorFile($options);
		}
		
		$this->widgetSchema->setNameFormat ( 'jobattach[%s]' );
		
    parent::setup ();
  }
  
  public function setJobId($jid){
  	$this->jobId = $jid;
  }
  
  public function save($con = null) {
  	
  	$jobId = $this->jobId;
  	
  	if(is_null($jobId)){
  		throw new sfException("Job ID is null! Set it with setJobId()", 1);
  	}
  	
  	for($i=0; $i < 5; $i++){
  		$file = $this->getValue("file_" . $i);
  		
  		if(!is_null($file)){
  			$shaName = sha1($file->getOriginalName() . time());
  			$extension = $file->getExtension( $file->getOriginalExtension() );
  			$filePath = sfConfig::get('sf_upload_dir') . "/" . $shaName . "." . $extension;
  			$file->save($filePath);
  			
  			$ja = new JobAttachment();
  			$ja->setJobId($jobId);
  			$ja->setUserId( sfContext::getInstance()->getUser()->getProfile()->getId() );
  			$ja->setFileName($shaName . "." . $extension);
  			$ja->setOriginalFileName($file->getOriginalName());
  			$ja->save();
  			
  			chmod($filePath, 0644);
  		}
  	}
  	
  }
  
}

?>