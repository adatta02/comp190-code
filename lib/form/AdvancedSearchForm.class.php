<?php


class AdvancedSearchForm extends sfForm {
	
	public function setup() {
		
	
		$this->setWidgets ( array (
		'due_date_start' => new sfWidgetFormJQueryDate ( ), 
		'due_date_end' => new sfWidgetFormJQueryDate ( ), 
		'shoot_date_start' => new sfWidgetFormJQueryDate ( ),
		'shoot_date_end' => new sfWidgetFormJQueryDate ( ),
		'status_id' => new sfWidgetFormPropelChoice ( array ('model' => 'Status', 'add_empty' => true ) ),
		'has_photo' => new sfWidgetFormInput(),
		'has_client' => new sfWidgetFormInput(),
		'photo_id' => new sfWidgetFormInputHidden(),
		'client_id' => new sfWidgetFormInputHidden(),
		'page' => new sfWidgetFormInputHidden(),
		'sort' => new sfWidgetFormChoice(array("choices" => JobPeer::$LIST_VIEW_SORTABLE)),
		'sort_direction' => new sfWidgetFormInputHidden(),
	  ));
		
		$this->widgetSchema["due_date_start"]->setLabel ( '', '' );
		$this->widgetSchema->setLabel ( 'due_date_end', '' );
		$this->widgetSchema->setLabel ( 'shoot_date_start', '' );
		$this->widgetSchema->setLabel ( 'shoot_date_start', '' );
    $this->widgetSchema->setLabel ( 'status_id', 'Job Status' );
    $this->widgetSchema->setLabel ( 'has_photo', 'With Photographer' );
    $this->widgetSchema->setLabel ( 'has_client', 'With Client' );
    
		$this->setValidators ( array (
			'due_date_start' => new sfValidatorDateTime ( array ('required' => false ) ), 
			'due_date_end' => new sfValidatorDateTime ( array ('required' => false ) ), 
			'shoot_date_start' => new sfValidatorDateTime ( array ('required' => false ) ), 
			'shoot_date_end' => new sfValidatorDateTime ( array ('required' => false ) ),
		  'status_id' => new sfValidatorPropelChoice ( array ('model' => 'Status', 'column' => 'id', 'required' => false ) ),
		  'has_photo' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
		  'has_client' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
		  'photo_id' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
		  'client_id' => new sfValidatorString(array('max_length' => 128, 'required' => false)),
		  'page' => new sfValidatorNumber(array("required" => false)),
		  'sort' => new sfValidatorChoice(array("choices" => array_keys(JobPeer::$LIST_VIEW_SORTABLE))),
		  'sort_direction' => new sfValidatorPass(array("required" => false)),
	  ));
		
	  $this->setDefault("page", 1);
	  $this->setDefault("sort_direction", 0);
	  
		$this->widgetSchema->setNameFormat ( 'advancedsearch[%s]' );
		$this->errorSchema = new sfValidatorErrorSchema ( $this->validatorSchema );
		parent::setup ();
	}

}


