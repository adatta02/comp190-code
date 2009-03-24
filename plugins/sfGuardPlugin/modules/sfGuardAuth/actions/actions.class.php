<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/../lib/BasesfGuardAuthActions.class.php');

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 9999 2008-06-29 21:24:44Z fabien $
 */
class sfGuardAuthActions extends BasesfGuardAuthActions
{
	/**
	 * This is a symfony workaround. As soon as someone logs in check if they are in the DB.
	 * If they aren't just insert them so they can authenticate.
	 *
	 * @param sfWebRequest $request
	 */
	public function executeSignin($request)
  {
  	if($request->isMethod("post")){
	  	$form = new sfGuardFormSignin();
	  	$username = $request->getParameter($form->getName() . "[username]");
	  	
	  	$c = new Criteria();
	  	$c->add(sfGuardUserPeer::USERNAME, $username);
	  	$res = sfGuardUserPeer::doCount($c);
	  	
	  	// if they dont exist in the db then stick them in so LDAP works
	  	if($res == 0){
	  	  $u = new sfGuardUser();
	  	  $u->setUsername($username);
	  	  $u->save();
	  	}
  	}
  	
  	parent::executeSignin($request);
  	
  	$credential = $this->getUser()->getProfile()->getUserType()->getType();
  	$this->getUser()->addCredential($credential);
  }
}
