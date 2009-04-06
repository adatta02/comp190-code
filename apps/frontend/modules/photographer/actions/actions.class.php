<?php

/**
 * photographer actions.
 *
 * @package    projectmanager
 * @subpackage photographer
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class photographerActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeAutocomplete(sfWebRequest $request)
  {
    $this->renderText(json_encode(PhotographerPeer::getArrayForAutocomplete($request->getParameter("q"))));
    return sfView::NONE;
  }
}
