<?php

/**
 * Status form base class.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseStatusForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'    => new sfWidgetFormInputHidden(),
      'state' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'    => new sfValidatorPropelChoice(array('model' => 'Status', 'column' => 'id', 'required' => false)),
      'state' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('status[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Status';
  }


}
