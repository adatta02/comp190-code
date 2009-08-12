<?php

/**
 * JobAttachment form base class.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseJobAttachmentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'job_id'             => new sfWidgetFormPropelChoice(array('model' => 'Job', 'add_empty' => true)),
      'user_id'            => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUserProfile', 'add_empty' => true, 'key_method' => 'getUserId')),
      'file_name'          => new sfWidgetFormInput(),
      'original_file_name' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorPropelChoice(array('model' => 'JobAttachment', 'column' => 'id', 'required' => false)),
      'job_id'             => new sfValidatorPropelChoice(array('model' => 'Job', 'column' => 'id', 'required' => false)),
      'user_id'            => new sfValidatorPropelChoice(array('model' => 'sfGuardUserProfile', 'column' => 'user_id', 'required' => false)),
      'file_name'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'original_file_name' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('job_attachment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JobAttachment';
  }


}
