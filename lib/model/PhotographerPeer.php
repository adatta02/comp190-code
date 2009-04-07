<?php

class PhotographerPeer extends BasePhotographerPeer
{
	
	// TODO: Switch both of these to use Zend instead of MySQL
  public static function getArrayForAutocomplete($q){
    
  	$c = self::getCriteriaForAutocomplete($q);
  	$c->setLimit(10);
  	
    $names = array();
    $photogs = PhotographerPeer::doSelect($c);
    
    foreach($photogs as $p){
      $names[] = array("id" => $p->getId(), 
                       "name" => $p->getName(),
                       "email" => $p->getEmail());
    }
    
    return $names;
  }
  
  public static function getCriteriaForAutocomplete($q){
  	$c = new Criteria();
    $crit0 = $c->getNewCriterion(PhotographerPeer::NAME, "%" . $q . "%", Criteria::LIKE);
    $crit1 = $c->getNewCriterion(PhotographerPeer::EMAIL, "%" . $q . "%", Criteria::LIKE);
    $crit0->addOr($crit1);
    $c->add($crit0);
    
    return $c;
  }
  
}
