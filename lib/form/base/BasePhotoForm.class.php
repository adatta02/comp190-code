<?php

/**
 * Photo form base class.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasePhotoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'     => new sfWidgetFormInputHidden(),
      'job_id' => new sfWidgetFormPropelChoice(array('model' => 'Job', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'     => new sfValidatorPropelChoice(array('model' => 'Photo', 'column' => 'id', 'required' => false)),
      'job_id' => new sfValidatorPropelChoice(array('model' => 'Job', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('photo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Photo';
  }


}
