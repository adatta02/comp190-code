<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Log filter form base class.
 *
 * @package    projectmanager
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseLogFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'message'                  => new sfWidgetFormFilterInput(),
      'when'                     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'propel_id'                => new sfWidgetFormFilterInput(),
      'propel_class'             => new sfWidgetFormFilterInput(),
      'sf_guard_user_profile_id' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUserProfile', 'add_empty' => true, 'key_method' => 'getUserId')),
      'log_message_type_id'      => new sfWidgetFormPropelChoice(array('model' => 'LogMessageType', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'message'                  => new sfValidatorPass(array('required' => false)),
      'when'                     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'propel_id'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'propel_class'             => new sfValidatorPass(array('required' => false)),
      'sf_guard_user_profile_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUserProfile', 'column' => 'user_id')),
      'log_message_type_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'LogMessageType', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('log_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Log';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'message'                  => 'Text',
      'when'                     => 'Date',
      'propel_id'                => 'Number',
      'propel_class'             => 'Text',
      'sf_guard_user_profile_id' => 'ForeignKey',
      'log_message_type_id'      => 'ForeignKey',
    );
  }
}
