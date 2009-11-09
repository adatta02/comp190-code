<?php

/**
 * photographer actions.
 *
 * @package    projectmanager
 * @subpackage photographer
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class photographerActions extends PMActions {
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeAutocomplete(sfWebRequest $request) {
		$this->renderText ( json_encode ( PhotographerPeer::getArrayForAutocomplete ( $request->getParameter ( "q" ) ) ) );
		return sfView::NONE;
	}
	
	public function executeViewJobs(sfWebRequest $request) {
		$this->photographer = $this->getRoute ()->getObject ();
		$ids = JobPhotographerPeer::getJobsByPhotographerId ( $this->photographer->getId () );
		$c = new Criteria ( );
		$c->add ( JobPeer::ID, $ids, Criteria::IN );
		
		$this->getPager ( $c, array ("route" => "photographer_view_jobs", "slugOn" => "slug", "slug" => $this->photographer->getSlug () ) );
	}
	
	public function executeDelete(sfWebRequest $request) {
		$photographer = $this->getRoute ()->getObject ();
		PhotographerPeer::deletePhotographer ( $photographer );
		$this->forward ( "photographer", "list" );
	}
	
	public function executeList(sfWebRequest $request) {
		$this->page = $request->getParameter ( "page" );
		$this->q = $request->getParameter ( "q" );
		
		if (is_null ( $this->page )) {
			$this->page = 1;
		}
		
		$c = new Criteria ( );
		$c->addAscendingOrderByColumn ( PhotographerPeer::NAME );
		
		if (is_null ( $this->q )) {
			$this->q = "";
		} else {
			$c = PhotographerPeer::getCriteriaForAutocomplete ( $this->q );
		}
		
		$this->pager = new sfPropelPager ( "Photographer", sfConfig::get ( "app_items_per_page" ) );
		$this->pager->setCriteria ( $c );
		$this->pager->setPage ( $this->page );
		$this->pager->init ();
		
		if ($request->isXmlHttpRequest ()) {
			$this->renderPartial ( "renderList", array ("pager" => $this->pager, "q" => $this->q ) );
			return sfView::NONE;
		}
	
	}
	
	private function bindAndValidateForm($form, $request) {
		$form->bind ( $request->getParameter ( $form->getName () ), 
		                $request->getFiles ( $form->getName () ) );
		if ($form->isValid ()) {
			$form->save ();
			return true;
		}else{
			return false;
		}
	}
	
	public function executeShow(sfWebRequest $request) {
		$this->photographer = $this->getRoute ()->getObject ();
		$this->InfoForm = new InfoPhotographerForm ( $this->photographer );
	}
	
	public function executeSearchLocation(sfWebRequest $request) {
		
		if($request->isXmlHttpRequest()){
			$lat = $request->getParameter("lat");
			$lng = $request->getParameter("lng");
			
	    $sql = "SELECT *, 
	        (
	        asin(
	          POW(sin((RADIANS(latitude)-RADIANS({$lat}))/2),2) + 
	          ( cos(RADIANS(latitude)) * cos(RADIANS({$lat})) * POW(sin( (RADIANS(longitude) - RADIANS({$lng})) / 2 ),2) )
	        )
	        * 2 * 6367000) AS haversineDistance
	        FROM photographer_region WHERE 1
	        ORDER BY haversineDistance ASC LIMIT 25";
	
	    $connection = Propel::getConnection();
	    $statement = $connection->prepare($sql);
	    $statement->execute();
	    
	    $objects = array();
	    while( $resultset = $statement->fetch(PDO::FETCH_OBJ) ){
	    	$p = PhotographerPeer::retrieveByPK($resultset->photographer_id);
	    	
	    	$arr = array();
	    	$arr["latitude"] = $resultset->latitude;
	    	$arr["longitude"] = $resultset->longitude;
	    	$arr["address"] = $resultset->address;
	    	$arr["photographer_name"] = $p->getName();
	      $arr["distance"] = $resultset->haversineDistance;
	      $arr["link"] = sfContext::getInstance()->getRouting()->generate("photographer_view", array("slug" => $p->getSlug()));
	      
	    	$objects[] = $arr;
	    }
	    
	    $this->renderText( json_encode($objects) );
			return sfView::NONE;
		}
	}
	
	public function executeRemoveLocation(sfWebRequest $request) {
		$regionId = $request->getParameter("id");
		$photog = $request->getParameter("photogId");
		$photographer = PhotographerPeer::retrieveByPK($photog);
		$region = PhotographerRegionPeer::retrieveByPK($regionId);
		
		$region->delete();
    $this->renderPartial("regionList", array("photographer" => $photographer));
    return sfView::NONE;
	}
	
	public function executeAddLocation(sfWebRequest $request) {
		
		$lat = $request->getParameter("lat");
		$lng = $request->getParameter("lng");
		$photog = $request->getParameter("photogId");
		$address = $request->getParameter("address");
		$photographer = PhotographerPeer::retrieveByPK($photog);
		
		$pr = new PhotographerRegion();
		$pr->setLatitude($lat);
		$pr->setLongitude($lng);
		$pr->setPhotographerId($photog);
		$pr->setAddress($address);
		$pr->save();
		
		$this->renderPartial("regionList", array("photographer" => $photographer));
		return sfView::NONE;
	}
	
	public function executeCreate(sfWebRequest $request) {
	 $this->InfoForm = new InfoPhotographerForm ( );
	 $this->InfoForm->setDefault("reset_password", true);
	 
	 if($request->isMethod("POST")){
	   $this->res = $this->bindAndValidateForm ( $this->InfoForm, $request );
	   $this->isCreate = true;
	 }else{
	 	$this->isCreate = false;
	 }
	 
	}
	
	public function executeEdit(sfWebRequest $request) {
		
		$photographer = PhotographerPeer::retrieveByPK ( $request->getParameter ( "photographer_id" ) );
		$updating = $request->getParameter ( "form" );
		
		switch ($updating) {
			case "info" :
				$form = new InfoPhotographerForm ( $photographer );
				$this->bindAndValidateForm ( $form, $request );
				$this->renderPartial ( "Info", array ("photographer" => $photographer, "InfoForm" => $form ) );
				break;
			default :
				break;
		}
		
		return sfView::NONE;
	}

}
