<?php

/**
 * Job form.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class InfoPhotographerForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'   => new sfWidgetFormInput(),
      'email'  => new sfWidgetFormInput(),
      'phone'  => new sfWidgetFormInput(),
      'affiliation' => new sfWidgetFormInput(),
      'website'  => new sfWidgetFormInput(),
      'description'  => new sfWidgetFormTextarea(),
      'photographer_id' => new sfWidgetFormInputHidden()
      ));

    $this->setValidators(array(
      'name'   => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'email'   => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'phone'   => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'affiliation'   => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'website'   => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'description'   => new sfValidatorString(array('max_length' => 65000, 'required' => false)),
      'photographer_id' => new sfValidatorNumber(array('required' => true))
    ));

    $this->widgetSchema->setNameFormat('photographer[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    if($this->getObject()){
    	$this->widgetSchema['photographer_id']->setDefault($this->getObject()->getId());
    }
    
    parent::setup();
  }
  
  /**
   * Serialize the form into the database.
   *
   */
  public function save($con = null){
  	
  	if($this->getObject()){
  	 $p = $this->getObject();
  	}else{
  		$p = new Photographer();
  	}
  	
  	$p->setName($this->getValue("name"));
    	$p->setEmail($this->getValue("email"));
  	$p->setPhone($this->getValue("phone"));
	$p->setAffiliation($this->getValue("affiliation"));
	$p->setWebsite($this->getValue("website"));
	$p->setDescription($this->getValue("description"));

	$p->save();
  }
  
  public function getModelName()
  {
    return 'Photographer';
  }
  
}
