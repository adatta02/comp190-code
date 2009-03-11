<?php

/**
 * LogMessageType form base class.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseLogMessageTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'   => new sfWidgetFormInputHidden(),
      'type' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'   => new sfValidatorPropelChoice(array('model' => 'LogMessageType', 'column' => 'id', 'required' => false)),
      'type' => new sfValidatorString(array('max_length' => 64, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('log_message_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LogMessageType';
  }


}
