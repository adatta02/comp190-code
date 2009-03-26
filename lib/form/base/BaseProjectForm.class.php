<?php

/**
 * Project form base class.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseProjectForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'name'      => new sfWidgetFormInput(),
      'status_id' => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => true)),
      'slug'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'Project', 'column' => 'id', 'required' => false)),
      'name'      => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'status_id' => new sfValidatorPropelChoice(array('model' => 'Status', 'column' => 'id', 'required' => false)),
      'slug'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('project[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Project';
  }


}
