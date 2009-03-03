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
  	$unsetMe = array("id", "project_id", "status_id", "date", "notes", "estimate",
  	                 "acct_num", "grand_id", "other", "idr");

  	// unset the fields we dont want to display
  	foreach($unsetMe as $key){
  	 unset($this->widgetSchema[$key]);
     unset($this->validatorSchema[$key]);		
  	}
  	
  	$this->widgetSchema->setLabel('event','Event Name');
  	$this->widgetSchema->setLabel('publication_id','Publication');
  	
  	$this->widgetSchema['start_time'] = new sfWidgetFormJQueryDate();
  	$this->widgetSchema['end_time'] = new sfWidgetFormJQueryDate();
  	$this->widgetSchema['due_date'] = new sfWidgetFormJQueryDate();
  	
  	$this->validatorSchema['event']->setOption('required', true); 
  	$this->validatorSchema['street']->setOption('required', true);
  	$this->validatorSchema['city']->setOption('required', true);
  	$this->validatorSchema['state']->setOption('required', true);
  	$this->validatorSchema['zip']->setOption('required', true);
  	$this->validatorSchema['contact_name']->setOption('required', true);
  	$this->validatorSchema['contact_email']->setOption('required', true);
  	$this->validatorSchema['contact_phone']->setOption('required', true);
  	
  }
  
  /**
   * Serialize the form into the database.
   *
   */
  public function save($con = null){
  	
  }
  
}
