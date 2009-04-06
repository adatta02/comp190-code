<?php

/**
 * client actions.
 *
 * @package    projectmanager
 * @subpackage client
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class clientActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeAutocomplete(sfWebRequest $request)
  {
    $this->renderText(json_encode(ClientPeer::getArrayForAutocomplete($request->getParameter("q"))));
    return sfView::NONE;
  }
}
