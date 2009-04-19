<?php

/**
 * Job form.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class ShootInfoJobForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'street'          => new sfWidgetFormInput(),
      'city'          => new sfWidgetFormInput(),
      'state'          => new sfWidgetFormSelectUSState(),
      'zip'          => new sfWidgetFormInput()
      ));

    $this->setValidators(array(
      'street'          => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'city'          => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'state'          => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'zip'          => new sfValidatorString(array('max_length' => 64, 'required' => false))
    ));

    $this->widgetSchema["state"]->setDefault($this->getObject()->getState());
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
  	
  	$j->setState($this->getValue("state"));
  	$j->setCity($this->getValue("city"));
  	$j->setZip($this->getValue("zip"));
  	$j->setStreet($this->getValue("street"));
	  $j->save();
	  
    $logEntry = new Log ( );
    $logEntry->setWhen ( time () );
    $logEntry->setPropelClass ( "Job" );
    $logEntry->setSfGuardUserProfileId ( sfContext::getInstance ()->getUser ()->getUserId () );
    $logEntry->setMessage ( "Shoot info updated." );
    $logEntry->setLogMessageTypeId ( sfConfig::get ( "app_log_type_update" ) );
    $logEntry->setPropelId ( $j->getId () );
    $logEntry->save ();
	  
  }
  
  public function getModelName()
  {
    return 'Job';
  }
  
}
