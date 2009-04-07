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
  
  public function executeList(sfWebRequest $request){
  	$this->page = $request->getParameter("page");
  	$this->q = $request->getParameter("q");
  	
  	if(is_null($this->page)){
  	 $this->page = 1;
  	}
  	
  	$c = new Criteria();
  	$c->addAscendingOrderByColumn(PhotographerPeer::NAME);
  	
    if(is_null($this->q)){
    	$this->q = "";
    }else{
    	$c = PhotographerPeer::getCriteriaForAutocomplete($this->q);
    }
  	
    $this->pager = new sfPropelPager ( "Photographer", sfConfig::get("app_items_per_page") );
    $this->pager->setCriteria ( $c );
    $this->pager->setPage ( $this->page );
    $this->pager->init ();
    
    if($request->isXmlHttpRequest()){
    	$this->renderPartial("renderList", array("pager" => $this->pager, "q" => $this->q));
    	return sfView::NONE;
    }
    
  }
}
