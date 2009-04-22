<?php

/**
 * JobPhotographer form base class.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseJobPhotographerForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'photographer_id' => new sfWidgetFormPropelChoice(array('model' => 'Photographer', 'add_empty' => true)),
      'job_id'          => new sfWidgetFormPropelChoice(array('model' => 'Job', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'JobPhotographer', 'column' => 'id', 'required' => false)),
      'photographer_id' => new sfValidatorPropelChoice(array('model' => 'Photographer', 'column' => 'id', 'required' => false)),
      'job_id'          => new sfValidatorPropelChoice(array('model' => 'Job', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('job_photographer[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JobPhotographer';
  }


}
