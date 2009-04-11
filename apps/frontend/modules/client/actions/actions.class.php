<?php

/**
 * client actions.
 *
 * @package    projectmanager
 * @subpackage client
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class clientActions extends PMActions
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
  
  public function executeViewJobs(sfWebRequest $request){
    $this->client = $this->getRoute()->getObject();
    $ids = JobClientPeer::getJobsByClientId($this->client->getId());
    
    $c = new Criteria();
    $c->add(JobPeer::ID, $ids, Criteria::IN);
    $this->getPager($c, array("route" => "client_view_jobs", "slugOn" => "slug", "slug" => $this->client->getSlug()));
    
  }
  
  public function executeList(sfWebRequest $request){
    $this->page = $request->getParameter("page");
    $this->q = $request->getParameter("q");
    
    if(is_null($this->page)){
     $this->page = 1;
    }
    
    $c = new Criteria();
    $c->addAscendingOrderByColumn(ClientPeer::NAME);
    
    if(is_null($this->q)){
      $this->q = "";
    }else{
      $c = ClientPeer::getCriteriaForAutocomplete($this->q);
    }
    
    $this->pager = new sfPropelPager ( "Client", sfConfig::get("app_items_per_page") );
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
          
         $this->client = $this->getRoute()->getObject();  
         $this->InfoForm = new InfoClientForm($this->client);
                                
        }


	public function executeEdit(sfWebRequest $request){

          $client = ClientPeer::retrieveByPK($request->getParameter("client_id"));
          $updating = $request->getParameter("form");

      switch($updating){
        case "info":
         $form = new InfoClientForm($client);
         $this->bindAndValidateForm($form ,$request);
         $this->renderPartial("Info", array("client" => $client, 
                              "InfoForm" => $form));
         break;
        default: break;
      }
      
      return sfView::NONE;
        }


}
