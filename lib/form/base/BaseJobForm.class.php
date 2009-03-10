<?php

/**
 * Job form base class.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseJobForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'project_id'     => new sfWidgetFormPropelChoice(array('model' => 'Project', 'add_empty' => true)),
      'publication_id' => new sfWidgetFormPropelChoice(array('model' => 'Publication', 'add_empty' => true)),
      'status_id'      => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => true)),
      'event'          => new sfWidgetFormInput(),
      'date'           => new sfWidgetFormDate(),
      'start_time'     => new sfWidgetFormDateTime(),
      'end_time'       => new sfWidgetFormDateTime(),
      'due_date'       => new sfWidgetFormDateTime(),
      'created_at'     => new sfWidgetFormDateTime(),
      'street'         => new sfWidgetFormInput(),
      'city'           => new sfWidgetFormInput(),
      'state'          => new sfWidgetFormInput(),
      'zip'            => new sfWidgetFormInput(),
      'contact_name'   => new sfWidgetFormInput(),
      'contact_email'  => new sfWidgetFormInput(),
      'contact_phone'  => new sfWidgetFormInput(),
      'notes'          => new sfWidgetFormTextarea(),
      'estimate'       => new sfWidgetFormInput(),
      'photo_type'     => new sfWidgetFormInput(),
      'acct_num'       => new sfWidgetFormInput(),
      'dept_id'        => new sfWidgetFormInput(),
      'grant_id'       => new sfWidgetFormInput(),
      'other'          => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'Job', 'column' => 'id', 'required' => false)),
      'project_id'     => new sfValidatorPropelChoice(array('model' => 'Project', 'column' => 'id', 'required' => false)),
      'publication_id' => new sfValidatorPropelChoice(array('model' => 'Publication', 'column' => 'id', 'required' => false)),
      'status_id'      => new sfValidatorPropelChoice(array('model' => 'Status', 'column' => 'id', 'required' => false)),
      'event'          => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'date'           => new sfValidatorDate(array('required' => false)),
      'start_time'     => new sfValidatorDateTime(array('required' => false)),
      'end_time'       => new sfValidatorDateTime(array('required' => false)),
      'due_date'       => new sfValidatorDateTime(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'street'         => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'city'           => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'state'          => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'zip'            => new sfValidatorInteger(array('required' => false)),
      'contact_name'   => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'contact_email'  => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'contact_phone'  => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'notes'          => new sfValidatorString(array('required' => false)),
      'estimate'       => new sfValidatorInteger(array('required' => false)),
      'photo_type'     => new sfValidatorInteger(array('required' => false)),
      'acct_num'       => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'dept_id'        => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'grant_id'       => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'other'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('job[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Job';
  }


}
