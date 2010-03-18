<?php

/**
 * Job form.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class JobForm extends BaseJobForm
{
  public function configure()
  {
    
  	$unsetMe = array("id", "status_id", "estimate",
  	                 "grand_id", "other", "idr");

  	// unset the fields we dont want to display
  	foreach($unsetMe as $key){
  	 unset($this->widgetSchema[$key]);
     unset($this->validatorSchema[$key]);		
  	}
  	

  	$this->widgetSchema['now'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['now']->setDefault(time());
  	
  	$this->widgetSchema->setLabel('event','Event Name');
  	$this->widgetSchema->setLabel('publication_id','Publication');
  	$this->widgetSchema->setLabel('project_id','Project');
	$this->widgetSchema->setLabel('dept_id','Department Id');
	$this->widgetSchema->setLabel('acct_num','Account Num');


  	
  	$this->widgetSchema['start_time'] = new sfWidgetjQueryTimepickr();
  	$this->widgetSchema['end_time'] = new sfWidgetjQueryTimepickr();
  	$this->widgetSchema['due_date'] = new sfWidgetFormJQueryDate();
  	$this->widgetSchema['state'] = new sfWidgetFormSelectUSState();
  	$this->widgetSchema['state']->setDefault("MA");
  	$this->widgetSchema['notes'] = new sfWidgetFormTextarea();


  	$this->validatorSchema['now'] = new sfValidatorDate();
  	$this->validatorSchema['event']->setOption('required', true); 
  	$this->validatorSchema['street']->setOption('required', true);
  	$this->validatorSchema['city']->setOption('required', true);
  	$this->validatorSchema['state']->setOption('required', true);
  	$this->validatorSchema['zip']->setOption('required', true);
  	$this->validatorSchema['contact_name']->setOption('required', true);
  	$this->validatorSchema['contact_email'] = new sfValidatorEmail(array('required' => true));
  	$this->validatorSchema['contact_phone']->setOption('required', true);
  	$this->validatorSchema['contact_phone']->setOption('min_length', 10);
  	
  	$this->validatorSchema['state'] = new sfValidatorChoice(
  	                                   array('choices' => sfWidgetFormSelectUSState::getStateAbbreviations()
  	                                  ));
    // make sure the dates are OK
    $this->validatorSchema->setPostValidator ( 
      new sfValidatorCallback(array(
          'callback'  => array($this, "checkJobTimes",
      ))
    ));
    
  }
  
  public function checkJobTimes( $validator, $values ){
    
    if( strtotime($values["end_time"]) 
         && strtotime($values["start_time"]) > strtotime($values["end_time"]) ){
      throw new sfValidatorError($validator, 'The start time must be before the end time.');
    }
    
    return $values;
  }
  
  /**
   * Serialize the form into the database.
   *
   */
  public function save($con = null){
  	$j = new Job();
  	$j->setEvent($this->getValue("event"));
  	$j->setStartTime($this->getValue("start_time"));
  	$j->setEndTime($this->getValue("end_time"));
	$j->setNotes($this->getValue("notes"));
	$j->setDate($this->getValue("date"));
  	$j->setDueDate($this->getValue("due_date"));
	$j->setAcctNum($this->getValue("acct_num"));
	$j->setDeptId($this->getValue("dept_id"));
  	$j->setPublicationId($this->getValue("publication_id"));
  	$j->setStreet($this->getValue("street"));
  	$j->setCity($this->getValue("city"));
  	$j->setState($this->getValue("state"));
  	$j->setZip($this->getValue("zip"));
  	$j->setContactName($this->getValue("contact_name"));
  	$j->setContactPhone($this->getValue("contact_phone"));
  	$j->setContactEmail($this->getValue("contact_email"));
  	$j->setStatusId(sfConfig::get("app_job_status_pending", 1));
  	$j->setProjectId($this->getValue("project_id"));
  	$j->save();
  }
  
}
