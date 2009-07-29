<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Delivery filter form base class.
 *
 * @package    projectmanager
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseDeliveryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'pub_name'     => new sfWidgetFormFilterInput(),
      'pub_type'     => new sfWidgetFormFilterInput(),
      'other'        => new sfWidgetFormFilterInput(),
      'color'        => new sfWidgetFormFilterInput(),
      'format'       => new sfWidgetFormFilterInput(),
      'size'         => new sfWidgetFormFilterInput(),
      'method'       => new sfWidgetFormFilterInput(),
      'instructions' => new sfWidgetFormFilterInput(),
      'job_id'       => new sfWidgetFormPropelChoice(array('model' => 'Job', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'pub_name'     => new sfValidatorPass(array('required' => false)),
      'pub_type'     => new sfValidatorPass(array('required' => false)),
      'other'        => new sfValidatorPass(array('required' => false)),
      'color'        => new sfValidatorPass(array('required' => false)),
      'format'       => new sfValidatorPass(array('required' => false)),
      'size'         => new sfValidatorPass(array('required' => false)),
      'method'       => new sfValidatorPass(array('required' => false)),
      'instructions' => new sfValidatorPass(array('required' => false)),
      'job_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Job', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('delivery_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Delivery';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'pub_name'     => 'Text',
      'pub_type'     => 'Text',
      'other'        => 'Text',
      'color'        => 'Text',
      'format'       => 'Text',
      'size'         => 'Text',
      'method'       => 'Text',
      'instructions' => 'Text',
      'job_id'       => 'ForeignKey',
    );
  }
}
