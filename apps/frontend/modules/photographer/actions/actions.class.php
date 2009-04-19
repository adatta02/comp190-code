<?php

/**
 * photographer actions.
 *
 * @package    projectmanager
 * @subpackage photographer
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class photographerActions extends PMActions
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
  
  public function executeViewJobs(sfWebRequest $request){
    $this->photographer = $this->getRoute()->getObject();
    $ids = JobPhotographerPeer::getJobsByPhotographerId($this->photographer->getId());
    $c = new Criteria();
    $c->add(JobPeer::ID, $ids, Criteria::IN);
    
    $this->getPager($c, array("route" => "photographer_view_jobs", 
                          "slugOn" => "slug", 
                          "slug" => $this->photographer->getSlug()));
  }
  
  public function executeDelete(sfWebRequest $request){
  	$photographer = $this->getRoute()->getObject();
  	PhotographerPeer::deletePhotographer($photographer);
  	$this->forward("photographer", "list");
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

  private function bindAndValidateForm($form, $request){
         $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
         if ($form->isValid()) {
           $form->save();
     return true;
   }
}

  public function executeShow(sfWebRequest $request){
         $this->photographer = $this->getRoute()->getObject();
         $this->InfoForm = new InfoPhotographerForm($this->photographer);

  }


   public function executeEdit(sfWebRequest $request){

          $photographer = PhotographerPeer::retrieveByPK($request->getParameter("photographer_id"));
          $updating = $request->getParameter("form");

      switch($updating){
        case "info":
         $form = new InfoPhotographerForm($photographer);
         $this->bindAndValidateForm($form ,$request);
         $this->renderPartial("Info", array("photographer" => $photographer,
                              "InfoForm" => $form));
         break;
        default: break;
      }

      return sfView::NONE;
   }






}
