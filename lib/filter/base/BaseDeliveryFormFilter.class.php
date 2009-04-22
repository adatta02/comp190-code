<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Delivery filter form base class.
 *
 * @package    projectmanager
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
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
      'size'         => new sfWidgetFormFilterInput(),
      'method'       => new sfWidgetFormFilterInput(),
      'instructions' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'pub_name'     => new sfValidatorPass(array('required' => false)),
      'pub_type'     => new sfValidatorPass(array('required' => false)),
      'other'        => new sfValidatorPass(array('required' => false)),
      'color'        => new sfValidatorPass(array('required' => false)),
      'size'         => new sfValidatorPass(array('required' => false)),
      'method'       => new sfValidatorPass(array('required' => false)),
      'instructions' => new sfValidatorPass(array('required' => false)),
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
      'size'         => 'Text',
      'method'       => 'Text',
      'instructions' => 'Text',
    );
  }
}
