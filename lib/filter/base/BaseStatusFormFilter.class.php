<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Status filter form base class.
 *
 * @package    projectmanager
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseStatusFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'state' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'state' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('status_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Status';
  }

  public function getFields()
  {
    return array(
      'id'    => 'Number',
      'state' => 'Text',
    );
  }
}
