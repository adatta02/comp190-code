<?php

class ProjectPeer extends BaseProjectPeer
{
 public static function getNamesForAutocomplete($q){
    $c = new Criteria();
    $c->add(ProjectPeer::NAME, $q . "%", Criteria::LIKE);
    $c->setLimit(10);
    
    $names = array();
    $projects = ProjectPeer::doSelect($c);
    foreach($projects as $p){
      $names[] = array("id" => $p->getId(), "name" => $p->getName());
    }
    
    return $names;
  }
}
