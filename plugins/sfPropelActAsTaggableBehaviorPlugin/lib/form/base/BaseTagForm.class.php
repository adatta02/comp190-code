<?php

/**
 * Tag form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseTagForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormInput(),
      'is_triple'        => new sfWidgetFormInputCheckbox(),
      'triple_namespace' => new sfWidgetFormInput(),
      'triple_key'       => new sfWidgetFormInput(),
      'triple_value'     => new sfWidgetFormInput(),
      'slug'             => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'Tag', 'column' => 'id', 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'is_triple'        => new sfValidatorBoolean(array('required' => false)),
      'triple_namespace' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'triple_key'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'triple_value'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'slug'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Tag', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tag';
  }


}
