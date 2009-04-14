<?php

/**
 * Job form base class.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
*/

class RequestJobForm extends sfForm {
	public function setup() {
		$this->setWidgets ( array (
		 'id' => new sfWidgetFormInputHidden ( ), 
		'project_id' => new sfWidgetFormPropelChoice ( array ('model' => 'Project', 'add_empty' => true ) ), 
		'publication_id' => new sfWidgetFormPropelChoice ( array ('model' => 'Publication', 'add_empty' => true ) ),
		'status_id' => new sfWidgetFormPropelChoice ( array ('model' => 'Status', 'add_empty' => true ) ), 
		'event' => new sfWidgetFormInput ( ), 
		'date' => new sfWidgetFormJQueryDate ( ), 
		'start_time' => new sfWidgetjQueryTimepickr ( array ( ), array ("size" => 7 ) ), 
		'end_time' => new sfWidgetjQueryTimepickr ( array ( ), array ("size" => 7 ) ), 
		'due_date' => new sfWidgetFormJQueryDate ( ), 
		'created_at' => new sfWidgetFormDateTime ( ), 
		'street' => new sfWidgetFormInput ( ), 
		'city' => new sfWidgetFormInput ( ), 
		'state' => new sfWidgetFormSelectUSState ( ), 
		'zip' => new sfWidgetFormInput ( ), 
		'contact_name' => new sfWidgetFormInput ( ), 
		'contact_email' => new sfWidgetFormInput ( ), 
		'contact_phone' => new sfWidgetFormInput ( ), 
		//'notes' => new sfWidgetFormTextarea ( ), 
		'estimate' => new sfWidgetFormInput ( ), 
		'photo_type' => new sfWidgetFormPropelChoice(array('model' => 'PhotoType', 'add_empty' => true)), 
		'acct_num' => new sfWidgetFormInput ( ), 
		'dept_id' => new sfWidgetFormInput ( ), 
		'grant_id' => new sfWidgetFormInput ( ), 
		'other' => new sfWidgetFormInput ( ), 
		'ques1' => new sfWidgetFormTextarea(),
		'ques2' => new sfWidgetFormTextarea(),
		'ques3' => new sfWidgetFormTextarea(),
		'slug' => new sfWidgetFormInput ( ), 
		'user_id' => new sfWidgetFormPropelChoice ( array ('model' => 'sfGuardUserProfile', 'add_empty' => true ) ), 
		'name' => new sfWidgetFormInput ( ), 
		'department' => new sfWidgetFormInput ( ), 
		'address' => new sfWidgetFormInput ( ), 
		'email' => new sfWidgetFormInput ( ), 
		'phone' => new sfWidgetFormInput ( ),
		'clientId' => new sfWidgetFormInputHidden()
	) );
		
		$this->widgetSchema->setLabel ( 'event', 'Event Name' );
		$this->widgetSchema->setLabel ( 'publication_id', 'Publication' );
		$this->widgetSchema->setLabel ( 'project_id', 'Project' );
		$this->widgetSchema->setLabel ( 'dept_id', 'Department Id' );
		$this->widgetSchema->setLabel ( 'acct_num', 'Account Num' );
		$this->widgetSchema->setLabel ( 'ques1', 'Please list specific photos you need, including, for group photos, number of groups and subjects in each.' );
		$this->widgetSchema->setLabel ( 'ques2', 'Please provide specific instructions for the photographer.' );
		$this->widgetSchema->setLabel ( 'ques3', 'Please describe in detail the event or story being photographed.' );
		$this->widgetSchema->setLabel ( 'estimate', 'Shoot Fee' );		

		$this->widgetSchema ['state']->setDefault ( "MA" );
		
		$this->widgetSchema ['now'] = new sfWidgetFormInputHidden ( );
		$this->widgetSchema ['now']->setDefault ( time () );
		$this->widgetSchema['clientId']->setDefault("-1");
		
		$this->setValidators ( array (
			'id' => new sfValidatorPropelChoice ( array ('model' => 'Job', 'column' => 'id', 'required' => false ) ),
		 	'project_id' => new sfValidatorPropelChoice ( array ('model' => 'Project', 'column' => 'id', 'required' => false ) ), 
			'publication_id' => new sfValidatorPropelChoice ( array ('model' => 'Publication', 'column' => 'id', 'required' => false ) ), 
			'status_id' => new sfValidatorPropelChoice ( array ('model' => 'Status', 'column' => 'id', 'required' => false ) ), 
			'event' => new sfValidatorString ( array ('max_length' => 64, 'required' => false ) ), 
			'date' => new sfValidatorDate ( array ('required' => false ) ), 
			'start_time' => new sfValidatorDateTime ( array ('required' => false ) ), 
			'end_time' => new sfValidatorDateTime ( array ('required' => false ) ), 
			'due_date' => new sfValidatorDateTime ( array ('required' => false ) ), 
			'created_at' => new sfValidatorDateTime ( array ('required' => false ) ), 
			'street' => new sfValidatorString ( array ('max_length' => 64, 'required' => false ) ), 
			'city' => new sfValidatorString ( array ('max_length' => 64, 'required' => false ) ), 
			'state' => new sfValidatorString ( array ('max_length' => 64, 'required' => false ) ), 
			'zip' => new sfValidatorInteger ( array ('required' => false ) ), 
			'contact_name' => new sfValidatorString ( array ('max_length' => 45, 'required' => false ) ), 
			'contact_email' => new sfValidatorEmail ( array ('required' => true ) ), 
			'contact_phone' => new sfValidatorString ( array ('max_length' => 45, 'required' => false ) ), 
			//'notes' => new sfValidatorString ( array ('required' => false ) ), 
			'estimate' => new sfValidatorInteger ( array ('required' => false ) ), 
			'photo_type' => new sfValidatorPropelChoice ( array ('model' => 'PhotoType', 'column' => 'id', 'required' => false ) ),  
			'acct_num' => new sfValidatorString ( array ('max_length' => 32, 'required' => false ) ), 
			'dept_id' => new sfValidatorString ( array ('max_length' => 32, 'required' => false ) ), 
			'grant_id' => new sfValidatorString ( array ('max_length' => 32, 'required' => false ) ), 
			'other' => new sfValidatorString ( array ('max_length' => 255, 'required' => false ) ), 
			'ques1' => new sfValidatorString ( array ('required' => false ) ),
			'ques2' => new sfValidatorString ( array ('required' => false ) ),
			'ques3' => new sfValidatorString ( array ('required' => false ) ),
			'slug' => new sfValidatorString ( array ('max_length' => 255, 'required' => false ) ), 
			'user_id' => new sfValidatorPropelChoice ( array ('model' => 'sfGuardUserProfile', 'column' => 'id', 'required' => false ) ), 
			'name' => new sfValidatorString ( array ('max_length' => 45, 'required' => false ) ), 
			'department' => new sfValidatorString ( array ('max_length' => 255, 'required' => false ) ), 
			'address' => new sfValidatorString ( array ('max_length' => 255, 'required' => false ) ), 
			'email' => new sfValidatorEmail ( array ('required' => false ) ), 
			'phone' => new sfValidatorString ( array ('max_length' => 32, 'required' => false ) ),
		  'clientId' => new sfValidatorNumber( array('required' => false) )
	) );
		
		$this->validatorSchema ['now'] = new sfValidatorDate ( );
		$this->validatorSchema ['event']->setOption ( 'required', true );
		$this->validatorSchema ['street']->setOption ( 'required', true );
		$this->validatorSchema ['city']->setOption ( 'required', true );
		$this->validatorSchema ['state']->setOption ( 'required', true );
		$this->validatorSchema ['zip']->setOption ( 'required', true );
		$this->validatorSchema ['contact_name']->setOption ( 'required', true );
		$this->validatorSchema ['contact_phone']->setOption ( 'required', true );
		$this->validatorSchema ['contact_phone']->setOption ( 'min_length', 10 );
		
		$this->validatorSchema ['state'] = new sfValidatorChoice ( array ('choices' => sfWidgetFormSelectUSState::getStateAbbreviations () ) );
		
		$this->widgetSchema->setNameFormat ( 'requestjob[%s]' );
		
		$this->errorSchema = new sfValidatorErrorSchema ( $this->validatorSchema );
		
		$this->validatorSchema->setPostValidator ( new sfValidatorAnd ( array (new sfValidatorSchemaCompare ( 'start_time', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'end_time', array ('throw_global_error' => true ), array ('invalid' => 'The start date ("%left_field%") must be before the end date! ("%right_field%")' ) ), 
		  new sfValidatorSchemaCompare ( 'date', sfValidatorSchemaCompare::GREATER_THAN, 'now', array ('throw_global_error' => true ), array ('invalid' => 'The start date ("%left_field%") must be in the future today!' ) ) ) ) );


		parent::setup ();
	}
	
	public function save($con = null) {
		$j = new Job ( );
		$j->setEvent ( $this->getValue ( "event" ) );
		$j->setStartTime ( $this->getValue ( "start_time" ) );
		$j->setEndTime ( $this->getValue ( "end_time" ) );
		//$j->setNotes ( $this->getValue ( "notes" ) );
		$j->setDate ( $this->getValue ( "date" ) );
		$j->setDueDate ( $this->getValue ( "due_date" ) );
		$j->setAcctNum ( $this->getValue ( "acct_num" ) );
		$j->setDeptId ( $this->getValue ( "dept_id" ) );
		$j->setPublicationId ( $this->getValue ( "publication_id" ) );
		$j->setStreet ( $this->getValue ( "street" ) );
		$j->setCity ( $this->getValue ( "city" ) );
		$j->setState ( $this->getValue ( "state" ) );
		$j->setZip ( $this->getValue ( "zip" ) );
		$j->setPhotoType ( $this->getValue ( "photo_type" ) );
		$j->setOther ( $this->getValue ( "other" ));
		$j->setQues1 ( $this->getValue ( "ques1" ));
		$j->setQues2 ( $this->getValue ( "ques2" ));
		$j->setQues3 ( $this->getValue ( "ques3" ));
		$j->setContactName ( $this->getValue ( "contact_name" ) );
		$j->setContactPhone ( $this->getValue ( "contact_phone" ) );
		$j->setContactEmail ( $this->getValue ( "contact_email" ) );
		$j->setStatusId ( sfConfig::get ( "app_job_status_pending", 1 ) );
		$j->setProjectId ( $this->getValue ( "project_id" ) );
		$j->save ();
	
		$user = sfContext::getInstance()->getUser();
		if($this->getValue("clientId") > 0 &&
		    ($user->hasCredential("client") || $user->hasCredential("admin"))){
			$client = ClientPeer::retrieveByPK($this->getValue("clientId"));
			$j->addClient($client);
		}
		
	}

}


