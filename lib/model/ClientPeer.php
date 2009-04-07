<?php

class ClientPeer extends BaseClientPeer
{
	// TODO: Switch these to use Zend not MySQL
	
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
	
	public static function getCriteriaForAutocomplete($q){
    $c = new Criteria();
    $crit0 = $c->getNewCriterion(ClientPeer::NAME, "%" . $q . "%", Criteria::LIKE);
    $crit1 = $c->getNewCriterion(ClientPeer::EMAIL, "%" . $q . "%", Criteria::LIKE);
    $crit0->addOr($crit1);
    $c->add($crit0);
    return $c;
	}
	
}
