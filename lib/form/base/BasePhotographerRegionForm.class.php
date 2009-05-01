<?php

/**
 * PhotographerRegion form base class.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasePhotographerRegionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'photographer_id' => new sfWidgetFormPropelChoice(array('model' => 'Photographer', 'add_empty' => true)),
      'address'         => new sfWidgetFormTextarea(),
      'latitude'        => new sfWidgetFormInput(),
      'longitude'       => new sfWidgetFormInput(),
      'x'               => new sfWidgetFormInput(),
      'y'               => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'PhotographerRegion', 'column' => 'id', 'required' => false)),
      'photographer_id' => new sfValidatorPropelChoice(array('model' => 'Photographer', 'column' => 'id', 'required' => false)),
      'address'         => new sfValidatorString(array('required' => false)),
      'latitude'        => new sfValidatorString(array('max_length' => 16, 'required' => false)),
      'longitude'       => new sfValidatorString(array('max_length' => 16, 'required' => false)),
      'x'               => new sfValidatorString(array('max_length' => 16, 'required' => false)),
      'y'               => new sfValidatorString(array('max_length' => 16, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('photographer_region[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PhotographerRegion';
  }


}
