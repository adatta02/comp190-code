<?php

class PhotographerPeer extends BasePhotographerPeer
{
 public static function getArrayForAutocomplete($q){
    $c = new Criteria();
    $crit0 = $c->getNewCriterion(PhotographerPeer::NAME, "%" . $q . "%", Criteria::LIKE);
    $crit1 = $c->getNewCriterion(PhotographerPeer::EMAIL, "%" . $q . "%", Criteria::LIKE);
    $crit0->addOr($crit1);
    $c->add($crit0);
    $c->setLimit(10);
    
    $names = array();
    $clients = PhotographerPeer::doSelect($c);
    foreach($clients as $p){
      $names[] = array("id" => $p->getId(), 
                       "name" => $p->getName(),
                       "email" => $p->getEmail());
    }
    
    return $names;
  }
}
