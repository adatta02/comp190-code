<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * JobAttachment filter form base class.
 *
 * @package    projectmanager
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseJobAttachmentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'job_id'             => new sfWidgetFormPropelChoice(array('model' => 'Job', 'add_empty' => true)),
      'user_id'            => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUserProfile', 'add_empty' => true, 'key_method' => 'getUserId')),
      'file_name'          => new sfWidgetFormFilterInput(),
      'original_file_name' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'job_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Job', 'column' => 'id')),
      'user_id'            => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUserProfile', 'column' => 'user_id')),
      'file_name'          => new sfValidatorPass(array('required' => false)),
      'original_file_name' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('job_attachment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JobAttachment';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'job_id'             => 'ForeignKey',
      'user_id'            => 'ForeignKey',
      'file_name'          => 'Text',
      'original_file_name' => 'Text',
    );
  }
}
