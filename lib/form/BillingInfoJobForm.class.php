<?php

/**
 * Job form.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class BillingInfoJobForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'estimate'          => new sfWidgetFormInput(),
      'processing'	=> new sfWidgetFormInput()
      ));

    $this->setValidators(array(
      'estimate'          => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'processing'          => new sfValidatorString(array('max_length' => 64, 'required' => false))
    ));

    $this->widgetSchema->setLabel ( 'estimate', 'Shoot Fee' );
    $this->widgetSchema->setLabel ( 'processing', 'Processing Fee' );
    $this->widgetSchema->setNameFormat('job[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
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
  	
  	$j->setEstimate ( $this->getValue ( "estimate" ) );
	  $j->setProcessing ( $this->getValue ( "processing" ) );
	  $j->save();
  }
  
  public function getModelName()
  {
    return 'Job';
  }
  
}
