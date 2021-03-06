<?php

/**
 * Job form.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class InfoClientForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'   => new sfWidgetFormInput(),
      'department'  => new sfWidgetFormInput(),
      'address'  => new sfWidgetFormInput(),
      'email'  => new sfWidgetFormInput(),
      'phone'  => new sfWidgetFormInput(),
      'client_id' => new sfWidgetFormInputHidden()
      ));

    $this->setValidators(array(
      'name'   => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'department'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'phone'   => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'client_id' => new sfValidatorNumber(array('required' => true))
    ));

    $this->widgetSchema->setNameFormat('client[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    if($this->getObject()){
    	$this->widgetSchema['client_id']->setDefault($this->getObject()->getId());
    }
    
    parent::setup();
  }
  
  /**
   * Serialize the form into the database.
   *
   */
  public function save($con = null){
  	
  	if($this->getObject()){
  	 $c = $this->getObject();
  	}else{
  		$c = new Client();
  	}
  	
  	$c->setName($this->getValue("name"));
  	$c->setDepartment($this->getValue("department"));
  	$c->setAddress($this->getValue("address"));
  	$c->setEmail($this->getValue("email"));
  	$c->setPhone($this->getValue("phone"));
  	$c->save();
  }
  
  public function getModelName()
  {
    return 'Client';
  }
  
}
