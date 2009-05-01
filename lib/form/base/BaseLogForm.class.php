<?php

/**
 * Log form base class.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseLogForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'message'                  => new sfWidgetFormInput(),
      'when'                     => new sfWidgetFormDateTime(),
      'propel_id'                => new sfWidgetFormInput(),
      'propel_class'             => new sfWidgetFormInput(),
      'sf_guard_user_profile_id' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUserProfile', 'add_empty' => true, 'key_method' => 'getUserId')),
      'log_message_type_id'      => new sfWidgetFormPropelChoice(array('model' => 'LogMessageType', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorPropelChoice(array('model' => 'Log', 'column' => 'id', 'required' => false)),
      'message'                  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'when'                     => new sfValidatorDateTime(array('required' => false)),
      'propel_id'                => new sfValidatorInteger(array('required' => false)),
      'propel_class'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'sf_guard_user_profile_id' => new sfValidatorPropelChoice(array('model' => 'sfGuardUserProfile', 'column' => 'user_id', 'required' => false)),
      'log_message_type_id'      => new sfValidatorPropelChoice(array('model' => 'LogMessageType', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Log';
  }


}
