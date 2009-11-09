<?php

/**
 * Job form.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class BasicInfoJobForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'publication_id' => new sfWidgetFormPropelChoice(array('model' => 'Publication', 'add_empty' => true)),
      'status_id'      => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => false)),
      'event'          => new sfWidgetFormInput(),
      'date'           => new sfWidgetFormJQueryDate(),
      'start_time'     => new sfWidgetjQueryTimepickr(),
      'end_time'       => new sfWidgetjQueryTimepickr(),
      'due_date'       => new sfWidgetFormJQueryDate(),
      'contact_name'   => new sfWidgetFormInput(),
      'contact_email'  => new sfWidgetFormInput(),
      'contact_phone'  => new sfWidgetFormInput(),
      'job_id' => new sfWidgetFormInputHidden()
      ));

    $this->setValidators(array(
      'publication_id' => new sfValidatorPropelChoice(array('model' => 'Publication', 'column' => 'id', 'required' => false)),
      'status_id'      => new sfValidatorPropelChoice(array('model' => 'Status', 'column' => 'id', 'required' => true)),
      'event'          => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'date'           => new sfValidatorDate(array('required' => false)),
      'start_time'     => new sfValidatorDateTime(array('required' => false)),
      'end_time'       => new sfValidatorDateTime(array('required' => false)),
      'due_date'       => new sfValidatorDateTime(array('required' => false)),
      'contact_name'   => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'contact_email'  => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'contact_phone'  => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'job_id' => new sfValidatorNumber(array('required' => true))
    ));

    $this->widgetSchema->setNameFormat('job[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    if($this->getObject()){
    	$this->widgetSchema['job_id']->setDefault($this->getObject()->getId());
    }
    
    parent::setup();
  }
  
  /**
   * Serialize the form into the database.
   *
   */
  public function save($con = null){
  	
  	if($this->getObject()){
  	 $j = $this->getObject();
  	}else{
  		$j = new Job();
  	}
  	
  	$j->setPublicationId($this->getValue("publication_id"));
  	$j->setStatusId($this->getValue("status_id"));
  	$j->setEvent($this->getValue("event"));
  	$j->setDate($this->getValue("date"));
  	$j->setStartTime($this->getValue("start_time"));
  	$j->setEndTime($this->getValue("end_time"));
  	$j->setDueDate($this->getValue("due_date"));
	  $j->setContactName($this->getValue("contact_name"));
    $j->setContactPhone($this->getValue("contact_phone"));
    $j->setContactEmail($this->getValue("contact_email"));
  	$j->setAcctNum($this->getValue("acct_num"));
	  $j->save();
	  
    $logEntry = new Log ( );
    $logEntry->setWhen ( time () );
    $logEntry->setPropelClass ( "Job" );
    $logEntry->setSfGuardUserProfileId ( sfContext::getInstance ()->getUser ()->getUserId () );
    $logEntry->setMessage ( "Basic info updated." );
    $logEntry->setLogMessageTypeId ( sfConfig::get ( "app_log_type_update" ) );
    $logEntry->setPropelId ( $j->getId () );
    $logEntry->save ();
	  
  }
  
  public function getModelName()
  {
    return 'Job';
  }
  
}
