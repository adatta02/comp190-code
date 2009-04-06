<?php

/**
 * Subclass for performing query and update operations on the 'tagging' table.
 *
 * 
 *
 * @package plugins.sfPropelActAsTaggableBehaviorPlugin.lib.model
 */ 
class TaggingPeer extends BaseTaggingPeer
{
	public static function getJobIdsByTag($tag){
	  $c = new Criteria();
    $c->add(TaggingPeer::TAG_ID, $tag->getId());
    $c->add(TaggingPeer::TAGGABLE_MODEL, "Job");
    
    $ids = array();
    $taggings = TaggingPeer::doSelect($c);
    foreach($taggings as $t){
      $ids[] = $t->getTaggableId();
    }
    
    return $ids;
	}
	
	public static function getNamesForAutocomplete($q){
	  $c = new Criteria();
    $c->add(TagPeer::NAME, $q . "%", Criteria::LIKE);
    $c->setLimit(10);
    
    $names = array();
    $tags = TagPeer::doSelect($c);
    foreach($tags as $tag){
      $names[] = $tag->getName();
    }
    
    return implode("\n", $names);
	}
}
