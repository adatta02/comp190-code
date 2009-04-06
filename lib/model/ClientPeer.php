<?php

class ClientPeer extends BaseClientPeer
{
	public static function getArrayForAutocomplete($q){
    $c = new Criteria();
    $crit0 = $c->getNewCriterion(ClientPeer::NAME, "%" . $q . "%", Criteria::LIKE);
    $crit1 = $c->getNewCriterion(ClientPeer::EMAIL, "%" . $q . "%", Criteria::LIKE);
    $crit0->addOr($crit1);
    $c->add($crit0);
    $c->setLimit(10);
    
    $names = array();
    $clients = ClientPeer::doSelect($c);
    foreach($clients as $p){
      $names[] = array("id" => $p->getId(), 
                       "name" => $p->getName(),
                       "email" => $p->getEmail());
    }
    
    return $names;
	}
}
