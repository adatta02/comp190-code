<?php

/**
 * log actions.
 *
 * @package    projectmanager
 * @subpackage log
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class logActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeView(sfWebRequest $request)
  {
   $c = new Criteria();
   $c->addDescendingOrderByColumn(LogPeer::WHEN);
   
   $this->pager = new sfPropelPager ( "Log", sfConfig::get("app_items_per_page") );
   $this->pager->setCriteria ( $c );
   $this->pager->setPage ( $this->page );
   $this->pager->setPeerMethod("doSelectJoinAll");
   $this->pager->init ();
  }
}
