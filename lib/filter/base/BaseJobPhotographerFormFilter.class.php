<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * JobPhotographer filter form base class.
 *
 * @package    projectmanager
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseJobPhotographerFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'photographer_id' => new sfWidgetFormPropelChoice(array('model' => 'Photographer', 'add_empty' => true)),
      'job_id'          => new sfWidgetFormPropelChoice(array('model' => 'Job', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'photographer_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Photographer', 'column' => 'id')),
      'job_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Job', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('job_photographer_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JobPhotographer';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'photographer_id' => 'ForeignKey',
      'job_id'          => 'ForeignKey',
    );
  }
}
