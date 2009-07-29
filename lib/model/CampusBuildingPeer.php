<?php

class CampusBuildingPeer extends BaseCampusBuildingPeer
{
	public function retrieveForAutocomplete($q){
    $c = new Criteria();
    $crit0 = $c->getNewCriterion(CampusBuildingPeer::NAME, "%" . $q . "%", Criteria::LIKE);
    $c->add($crit0);
    $c->setLimit(10);
    
    $names = array();
    $arr = CampusBuildingPeer::doSelect($c);
    foreach($arr as $p){
      $names[] = array("id" => $p->getId(), 
                       "name" => $p->getName(),
                       "address" => $p->getAddress(),
                       "lat" => $p->getLatitude(),
                       "lng" => $p->getLongitude());
    }
    
    return $names;
		
	}
}
