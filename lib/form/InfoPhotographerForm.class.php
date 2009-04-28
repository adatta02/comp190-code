<?php

/**
 * Job form.
 *
 * @package    projectmanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class InfoPhotographerForm extends BaseFormPropel {
	public function setup() {
		$this->setWidgets ( array ('name' => new sfWidgetFormInput ( ), 
		                           'email' => new sfWidgetFormInput ( ), 
		                           'phone' => new sfWidgetFormInput ( ), 
		                           'affiliation' => new sfWidgetFormInput ( ), 
		                           'website' => new sfWidgetFormInput ( ), 
		                           'description' => new sfWidgetFormTextarea ( ), 
		                           'billing_info' => new sfWidgetFormTextarea ( ), 
		                           'photographer_id' => new sfWidgetFormInputHidden ( ),
		                           'reset_password' => new sfWidgetFormInputCheckbox(),
		                           'password' => new sfWidgetFormInputPassword() ));
		
		$this->setValidators ( array ('name' => new sfValidatorString ( array ('max_length' => 45, 'required' => true ) ), 
		                              'email' => new sfValidatorString ( array ('max_length' => 64, 'required' => true ) ), 
		                              'phone' => new sfValidatorString ( array ('max_length' => 45, 'required' => false ) ), 
		                              'affiliation' => new sfValidatorString ( array ('max_length' => 64, 'required' => false ) ), 
		                              'website' => new sfValidatorString ( array ('max_length' => 64, 'required' => false ) ), 
		                              'description' => new sfValidatorString ( array ('max_length' => 65000, 'required' => false ) ), 
		                              'billing_info' => new sfValidatorString ( array ('max_length' => 65000, 'required' => false ) ),
		                              'password' => new sfValidatorString( array ('max_length' => 64, 'required' => false ) ),
		                              'reset_password' => new sfValidatorBoolean(array('required' => false)),
		                              'photographer_id' => new sfValidatorNumber ( array ('required' => false ))));
		
		$this->widgetSchema->setNameFormat ( 'photographer[%s]' );
		$this->errorSchema = new sfValidatorErrorSchema ( $this->validatorSchema );
		
		if ($this->getObject ()) {
			$this->widgetSchema ['photographer_id']->setDefault ( $this->getObject ()->getId () );
		}
		
		parent::setup ();
	}
	
	/**
	 * Serialize the form into the database.
	 **/
	
	public function save($con = null) {
		
		if (!is_null($this->getValue ( "photographer_id" ))) {
			$p = $this->getObject ();
		} else {
			$sfUser = new sfGuardUser();
			$sfUser->setUsername($this->getValue ( "email" ));
			$sfUser->setPassword( $this->getValue ( "password" ) );
			$sfUser->save();
			
			list($firstName, $lastName) = explode(" " , $this->getValue ( "name" ));
			$sfProfile = new sfGuardUserProfile();
			$sfProfile->setUserTypeId(sfConfig::get("app_user_type_photographer"));
			$sfProfile->setUserId($sfUser->getId());
			$sfProfile->setEmail($this->getValue ( "email" ));
			$sfProfile->setFirstName($firstName);
			$sfProfile->setLastName($lastName);
			$sfProfile->save();
			
			$p = new Photographer ( );
			$p->setUserId($sfProfile->getId());
		}
		
		$p->setName ( $this->getValue ( "name" ) );
		$p->setEmail ( $this->getValue ( "email" ) );
		$p->setPhone ( $this->getValue ( "phone" ) );
		$p->setAffiliation ( $this->getValue ( "affiliation" ) );
		$p->setWebsite ( $this->getValue ( "website" ) );
		$p->setDescription ( $this->getValue ( "description" ) );
		$p->setBillingAddress ( $this->getValue ( "billing_info" ) );
		$p->save ();
		
		if( $this->getValue ( "reset_password" ) ){
			$user = $p->getsfGuardUserProfile()->getsfGuardUser();
			$user->setPassword( $this->getValue ( "password" ) );
			$user->save();
		}
	}
	
	public function getModelName() {
		return 'Photographer';
	}

}
