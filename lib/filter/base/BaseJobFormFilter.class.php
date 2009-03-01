<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Job filter form base class.
 *
 * @package    projectmanager
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseJobFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'project_id'     => new sfWidgetFormPropelChoice(array('model' => 'Project', 'add_empty' => true)),
      'publication_id' => new sfWidgetFormPropelChoice(array('model' => 'Publication', 'add_empty' => true)),
      'status_id'      => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => true)),
      'event'          => new sfWidgetFormFilterInput(),
      'date'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'start_time'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'end_time'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'due_date'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'street'         => new sfWidgetFormFilterInput(),
      'city'           => new sfWidgetFormFilterInput(),
      'state'          => new sfWidgetFormFilterInput(),
      'zip'            => new sfWidgetFormFilterInput(),
      'contact_name'   => new sfWidgetFormFilterInput(),
      'contact_email'  => new sfWidgetFormFilterInput(),
      'contact_phone'  => new sfWidgetFormFilterInput(),
      'notes'          => new sfWidgetFormFilterInput(),
      'estimate'       => new sfWidgetFormFilterInput(),
      'photo_type'     => new sfWidgetFormFilterInput(),
      'acct_num'       => new sfWidgetFormFilterInput(),
      'dept_id'        => new sfWidgetFormFilterInput(),
      'grant_id'       => new sfWidgetFormFilterInput(),
      'other'          => new sfWidgetFormFilterInput(),
      'idr'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'project_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Project', 'column' => 'id')),
      'publication_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Publication', 'column' => 'id')),
      'status_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Status', 'column' => 'id')),
      'event'          => new sfValidatorPass(array('required' => false)),
      'date'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'start_time'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'end_time'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'due_date'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'street'         => new sfValidatorPass(array('required' => false)),
      'city'           => new sfValidatorPass(array('required' => false)),
      'state'          => new sfValidatorPass(array('required' => false)),
      'zip'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'contact_name'   => new sfValidatorPass(array('required' => false)),
      'contact_email'  => new sfValidatorPass(array('required' => false)),
      'contact_phone'  => new sfValidatorPass(array('required' => false)),
      'notes'          => new sfValidatorPass(array('required' => false)),
      'estimate'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'photo_type'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'acct_num'       => new sfValidatorPass(array('required' => false)),
      'dept_id'        => new sfValidatorPass(array('required' => false)),
      'grant_id'       => new sfValidatorPass(array('required' => false)),
      'other'          => new sfValidatorPass(array('required' => false)),
      'idr'            => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('job_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Job';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'project_id'     => 'ForeignKey',
      'publication_id' => 'ForeignKey',
      'status_id'      => 'ForeignKey',
      'event'          => 'Text',
      'date'           => 'Date',
      'start_time'     => 'Date',
      'end_time'       => 'Date',
      'due_date'       => 'Date',
      'street'         => 'Text',
      'city'           => 'Text',
      'state'          => 'Text',
      'zip'            => 'Number',
      'contact_name'   => 'Text',
      'contact_email'  => 'Text',
      'contact_phone'  => 'Text',
      'notes'          => 'Text',
      'estimate'       => 'Number',
      'photo_type'     => 'Number',
      'acct_num'       => 'Text',
      'dept_id'        => 'Text',
      'grant_id'       => 'Text',
      'other'          => 'Text',
      'idr'            => 'Text',
    );
  }
}
