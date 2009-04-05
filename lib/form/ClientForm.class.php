<?php

/**
 * Client form.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class ClientForm extends BaseClientForm
{
  public function configure()
  {

	$this->widgetSchema->setLabel('name','Name');
	$this->widgetSchema->setLabel('department','Department');
	$this->widgetSchema->setLabel('address','Address');
	$this->widgetSchema->setLabel('email','Email');
	$this->widgetSchema->setLabel('phone','Phone');

  }

public function save($con = null){
        $c = new Client();
        $c->setName($this->getValue("name"));
	$c->setDepartment($this->getValue("department"));
	$c->setAddress($this->getValue("address"));
	$c->setEmail($this->getValue("email"));
	$c->setPhone($this->getValue("phone"));
        $c->save();
  }

}
