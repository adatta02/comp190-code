<?php

/**
 * Photographer form base class.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasePhotographerForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'user_id'         => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUserProfile', 'add_empty' => true)),
      'name'            => new sfWidgetFormInput(),
      'phone'           => new sfWidgetFormInput(),
      'email'           => new sfWidgetFormInput(),
      'affiliation'     => new sfWidgetFormInput(),
      'website'         => new sfWidgetFormInput(),
      'description'     => new sfWidgetFormTextarea(),
      'billing_address' => new sfWidgetFormTextarea(),
      'slug'            => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'Photographer', 'column' => 'id', 'required' => false)),
      'user_id'         => new sfValidatorPropelChoice(array('model' => 'sfGuardUserProfile', 'column' => 'id', 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'phone'           => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'email'           => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'affiliation'     => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'website'         => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'description'     => new sfValidatorString(array('required' => false)),
      'billing_address' => new sfValidatorString(array('required' => false)),
      'slug'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('photographer[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Photographer';
  }


}
