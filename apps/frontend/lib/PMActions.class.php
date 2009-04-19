<?php
class PMActions extends sfActions {
	
	protected function getFormattedDate($widget) {
		
		if (strlen ( $widget ["month"] ) && strlen ( $widget ["year"] ) && strlen ( $widget ["day"] ))
			return $widget ["year"] . "-" . $widget ["month"] . "-" . $widget ["day"];
		
		if (strlen ( $widget ["month"] ) && strlen ( $widget ["year"] ))
			return $widget ["year"] . "-" . $widget ["month"];
		
		return null;
	}
	
	protected function createAdvancedSearchCriteria($arr) {
		$c = new Criteria ( );
		
		if (strlen ( $arr ['jobStatus'] ))
			$c->add ( JobPeer::STATUS_ID, $arr ["jobStatus"] );
		
		if (! is_null ( $arr ["dueDateStart"] ))
			$c->add ( JobPeer::DUE_DATE, $arr ["dueDateStart"], Criteria::GREATER_EQUAL );
		
		if (! is_null ( $arr ["dueDateEnd"] ))
			$c->addAnd ( JobPeer::DUE_DATE, $arr ["dueDateEnd"], Criteria::LESS_EQUAL );
		
		if (! is_null ( $arr ["shootDateStart"] ))
			$c->add ( JobPeer::DATE, $arr ["shootDateStart"], Criteria::GREATER_EQUAL );
		
		if (! is_null ( $arr ["shootDateEnd"] ))
			$c->addAnd ( JobPeer::DATE, $arr ["shootDateEnd"], Criteria::LESS_EQUAL );
		
		if (strlen ( $arr ["clientId"] )) {
			$cc = new Criteria ( );
			$cc->add ( JobClientPeer::CLIENT_ID, $arr ["clientId"] );
			$clients = JobClientPeer::doSelectJoinAll ( $cc );
			$jobIds = array ();
			
			foreach ( $clients as $client ) {
				$jobIds [] = $client->getJob ()->getId ();
			}
			
			$c->add ( JobPeer::ID, $jobIds, Criteria::IN );
		}
		
		if (strlen ( $arr ["photographerId"] )) {
			$cc = new Criteria ( );
			$cc->add ( JobPhotographerPeer::PHOTOGRAPHER_ID, $arr ["photographerId"] );
			$photogs = JobPhotographerPeer::doSelectJoinAll ( $cc );
			$jobIds = array ();
			
			foreach ( $photogs as $ph ) {
				$jobIds [] = $ph->getJob ()->getId ();
			}
			
			$c->addAnd ( JobPeer::ID, $jobIds, Criteria::IN );
		}
		
		if ($arr ["sortDirection"] == 1) {
			$c->addDescendingOrderByColumn ( $arr ["sortOn"] );
		} else {
			$c->addAscendingOrderByColumn ( $arr ["sortOn"] );
		}
		
		return $c;
	}
	
	protected function getPager($c, $urlInfo = null) {
		$this->page = $this->getRequest ()->getParameter ( "page" );
		$this->sortedBy = $this->getRequest ()->getParameter ( "sortBy" );
		$this->invert = $this->getRequest ()->getParameter ( "invert" );
		
		if (is_null ( $this->sortedBy )) {
			$this->sortedBy = JobPeer::DATE;
		}
		if (is_null ( $this->invert ) || $this->invert == "false") {
			$this->invert = false;
			$c->addAscendingOrderByColumn ( $this->sortedBy );
		} else {
			$c->addDescendingOrderByColumn ( $this->sortedBy );
			$this->invert = true;
		}
		
		if (! is_numeric ( $this->page ))
			$this->page = 1;
			
		// if this user is only a client 
		// make sure they can only see their jobs
		

		$this->pager = new sfPropelPager ( "Job", sfConfig::get ( "app_items_per_page" ) );
		$this->pager->setCriteria ( $c );
		$this->pager->setPage ( $this->page );
		$this->pager->setPeerMethod ( "doSelectJoinAll" );
		$this->pager->init ();
		
		$this->results = $this->pager->getResults ();
		sfPropelActAsTaggableBehavior::preloadTags ( $this->results );
		
		if (! is_null ( $urlInfo )) {
			
			$sortUrls = array ();
			
			foreach ( JobPeer::$LIST_VIEW_SORTABLE as $key => $val ) {
				$sortUrls [$key] ["true"] = $this->generateUrl ( $urlInfo ["route"], array ($urlInfo ["slugOn"] => $urlInfo ["slug"], "sortBy" => $key, "invert" => "true" ) );
				$sortUrls [$key] ["false"] = $this->generateUrl ( $urlInfo ["route"], array ($urlInfo ["slugOn"] => $urlInfo ["slug"], "sortBy" => $key, "invert" => "false" ) );
			}
			
			$this->sortUrlJson = json_encode ( $sortUrls );
		}
	
	}

}
?>
