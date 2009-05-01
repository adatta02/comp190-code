<?php

/**
 * JobClient form base class.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseJobClientForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'client_id' => new sfWidgetFormPropelChoice(array('model' => 'Client', 'add_empty' => true)),
      'job_id'    => new sfWidgetFormPropelChoice(array('model' => 'Job', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'JobClient', 'column' => 'id', 'required' => false)),
      'client_id' => new sfValidatorPropelChoice(array('model' => 'Client', 'column' => 'id', 'required' => false)),
      'job_id'    => new sfValidatorPropelChoice(array('model' => 'Job', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('job_client[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JobClient';
  }


}
