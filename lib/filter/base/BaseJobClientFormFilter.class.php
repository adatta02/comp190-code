<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * JobClient filter form base class.
 *
 * @package    projectmanager
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseJobClientFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'client_id' => new sfWidgetFormPropelChoice(array('model' => 'Client', 'add_empty' => true)),
      'job_id'    => new sfWidgetFormPropelChoice(array('model' => 'Job', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'client_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Client', 'column' => 'id')),
      'job_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Job', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('job_client_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JobClient';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'client_id' => 'ForeignKey',
      'job_id'    => 'ForeignKey',
    );
  }
}
