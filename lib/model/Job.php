<?php

class Job extends BaseJob
{
}

$columns_map = array(  'from'   => JobPeer::EVENT,
                       'to'     => JobPeer::SLUG);
 
sfPropelBehavior::add('Job', 
                      array('sfPropelActAsSluggableBehavior' => 
                        array('columns' => $columns_map, 
                                'separator' => '_', 'permanent' => true)));