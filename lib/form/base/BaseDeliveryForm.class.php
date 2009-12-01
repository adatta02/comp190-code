<?php

/**
 * Delivery form base class.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseDeliveryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'pub_name'     => new sfWidgetFormInput(),
      'pub_type'     => new sfWidgetFormInput(),
      'other'        => new sfWidgetFormInput(),
      'color'        => new sfWidgetFormInput(),
      'format'       => new sfWidgetFormInput(),
      'size'         => new sfWidgetFormInput(),
      'method'       => new sfWidgetFormInput(),
      'instructions' => new sfWidgetFormTextarea(),
      'job_id'       => new sfWidgetFormPropelChoice(array('model' => 'Job', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'Delivery', 'column' => 'id', 'required' => false)),
      'pub_name'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'pub_type'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'other'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'color'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'format'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'size'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'method'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'instructions' => new sfValidatorString(array('required' => false)),
      'job_id'       => new sfValidatorPropelChoice(array('model' => 'Job', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('delivery[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Delivery';
  }


}
