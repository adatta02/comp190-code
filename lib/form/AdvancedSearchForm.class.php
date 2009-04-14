<?php


class AdvancedSearchForm extends sfForm {
	
	public function setup() {
		
		$this->setWidgets ( array (
		'due_date_start' => new sfWidgetFormJQueryDate ( ), 
		'due_date_end' => new sfWidgetFormJQueryDate ( ), 
		'shoot_date_start' => new sfWidgetFormJQueryDate ( ),
		'shoot_date_end' => new sfWidgetFormJQueryDate ( ),
		'status_id' => new sfWidgetFormPropelChoice ( array ('model' => 'Status', 'add_empty' => true ) ),
		'has_photo' => new sfWidgetFormSelectRadio(array( 'choices' => array("Yes", "No", "Either"))),
		'has_client' => new sfWidgetFormSelectRadio(array( 'choices' => array("Yes", "No", "Either"))),
	  ));
		
		$this->widgetSchema->setLabel ( 'due_date_start', '' );
		$this->widgetSchema->setLabel ( 'due_date_end', '' );
		$this->widgetSchema->setLabel ( 'shoot_date_start', '' );
		$this->widgetSchema->setLabel ( 'shoot_date_start', '' );
    $this->widgetSchema->setLabel ( 'status_id', 'Job Status' );
    $this->widgetSchema->setLabel ( 'has_photo', 'Has Photographer?' );
    $this->widgetSchema->setLabel ( 'has_client', 'Has Client?' );
    
		$this->setValidators ( array (
			'due_date_start' => new sfValidatorDateTime ( array ('required' => false ) ), 
			'due_date_end' => new sfValidatorDateTime ( array ('required' => false ) ), 
			'shoot_date_start' => new sfValidatorDateTime ( array ('required' => false ) ), 
			'shoot_date_end' => new sfValidatorDateTime ( array ('required' => false ) ),
		  'status_id' => new sfValidatorPropelChoice ( array ('model' => 'Status', 'column' => 'id', 'required' => false ) ),
		  'has_photo' => new sfValidatorChoice(array( 'choices' => array("Yes", "No", "Either"))),
		  'has_client' => new sfValidatorChoice ( array( 'choices' => array("Yes", "No", "Either")) ),
	  ));
		
		$this->widgetSchema->setNameFormat ( 'advancedsearch[%s]' );
		$this->errorSchema = new sfValidatorErrorSchema ( $this->validatorSchema );
		parent::setup ();
	}

}


