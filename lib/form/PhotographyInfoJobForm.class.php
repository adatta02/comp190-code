<?php

/**
 * Job form.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class PhotographyInfoJobForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'photo_type' => new sfWidgetFormPropelChoice(array('model' => 'PhotoType', 'add_empty' => true)), 
      'ques1' => new sfWidgetFormTextarea(),
      'ques2' => new sfWidgetFormTextarea(),
      'ques3' => new sfWidgetFormTextarea()
      ));

    $this->setValidators(array(
      'photo_type' => new sfValidatorPropelChoice ( array ('model' => 'PhotoType', 'column' => 'id', 'required' => false ) ),  
      'ques1' => new sfValidatorString ( array ('required' => false ) ),
      'ques2' => new sfValidatorString ( array ('required' => false ) ),
      'ques3' => new sfValidatorString ( array ('required' => false ) )
    ));

	$this->widgetSchema->setLabel ( 'ques1', 'Please list specific photos you need, including, for group photos, number of groups and subjects in each.' );
		$this->widgetSchema->setLabel ( 'ques2', 'Please provide specific instructions for the photographer.' );
		$this->widgetSchema->setLabel ( 'ques3', 'Please describe in detail the event or story being photographed.' );


    $this->widgetSchema->setNameFormat('job[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $explode = explode("^", $this->getObject()->getOther());
    if(count($explode) == 3){
    $this->widgetSchema['ques1']->setDefault($explode[0]); 
    $this->widgetSchema['ques2']->setDefault($explode[1]); 
    $this->widgetSchema['ques3']->setDefault($explode[2]); 
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
  	
  	$j->setPhotoType ( $this->getValue ( "photo_type" ) );	
	$j->setOther ( $this->getValue ( "ques1" ) . "^" . $this->getValue ( "ques2" ) . "^" . $this->getValue( "ques3" ) );		
	$j->save();
  }
  
  public function getModelName()
  {
    return 'Job';
  }
  
}
