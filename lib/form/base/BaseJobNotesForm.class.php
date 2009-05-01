<?php

/**
 * JobNotes form base class.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseJobNotesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'job_id'     => new sfWidgetFormInput(),
      'revision'   => new sfWidgetFormInput(),
      'created_at' => new sfWidgetFormDateTime(),
      'notes'      => new sfWidgetFormTextarea(),
      'user_id'    => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUserProfile', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'JobNotes', 'column' => 'id', 'required' => false)),
      'job_id'     => new sfValidatorInteger(array('required' => false)),
      'revision'   => new sfValidatorInteger(array('required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'notes'      => new sfValidatorString(array('required' => false)),
      'user_id'    => new sfValidatorPropelChoice(array('model' => 'sfGuardUserProfile', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('job_notes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JobNotes';
  }


}
