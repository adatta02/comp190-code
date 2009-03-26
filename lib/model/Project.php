<?php

class Project extends BaseProject
{
  public function __toString(){
    return $this->getName();
  }
}

$columns_map = array(  'from'   => ProjectPeer::NAME,
                       'to'     => ProjectPeer::SLUG);
 
sfPropelBehavior::add('Project', 
                      array('sfPropelActAsSluggableBehavior' => 
                        array('columns' => $columns_map, 
                              'separator' => '_', 'permanent' => true)));