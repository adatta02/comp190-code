<?php

/**
 * publication actions.
 *
 * @package    projectmanager
 * @subpackage publication
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class publicationActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->page = $request->getParameter("page");
    
    $c = new Criteria();
    $c->addAscendingOrderByColumn(PublicationPeer::NAME);
    $this->pager = new sfPropelPager ( "Publication", sfConfig::get("app_items_per_page") );
    $this->pager->setCriteria ( $c );
    $this->pager->setPage ( $this->page );
    $this->pager->init ();
  }
  
  public function executeDelete(sfWebRequest $request)
  {
  	$id = $request->getParameter("id");
  	
  	$pub = PublicationPeer::retrieveByPk( $id );
  	$pub->delete();
  	
    $c = new Criteria();
    $c->addAscendingOrderByColumn(PublicationPeer::NAME);
    $pager = new sfPropelPager ( "Publication", sfConfig::get("app_items_per_page") );
    $pager->setCriteria ( $c );
    $pager->setPage ( 1 );
    $pager->init ();
    
    $this->renderPartial( "renderList", array("pager" => $pager) );
    return sfView::NONE;
  }
   
  public function executeAdd(sfWebRequest $request)
  {
  	$pubName = $request->getParameter("name");
  	$pubId = $request->getParameter("id", null);
  	
  	if(!is_null($pubId)){
  		$pub = PublicationPeer::retrieveByPk( $pubId );
  	}else{
  		$pub = new Publication();
  	}
  	
  	$pub->setName( $pubName );
  	$pub->save();
  	
    $c = new Criteria();
    $c->addAscendingOrderByColumn(PublicationPeer::NAME);
    $pager = new sfPropelPager ( "Publication", sfConfig::get("app_items_per_page") );
    $pager->setCriteria ( $c );
    $pager->setPage ( 1 );
    $pager->init ();
    
    $this->renderPartial( "renderList", array("pager" => $pager) );
    return sfView::NONE;
  }
  
}
