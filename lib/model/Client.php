<?php

class Client extends BaseClient
{
}

$columns_map = array(  'from'   => ClientPeer::EMAIL,
                       'to'     => ClientPeer::SLUG);
sfPropelBehavior::add('Client', 
                      array('sfPropelActAsSluggableBehavior' => 
                        array('columns' => $columns_map, 
                              'separator' => '_', 'permanent' => true)));