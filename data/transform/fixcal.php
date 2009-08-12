<?php

error_reporting(E_ALL);
include_once "../../config/ProjectConfiguration.class.php";

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', true);
$sfContext = sfContext::createInstance($configuration);
$sfContext->dispatch();

$c = new Criteria();
$c->add( JobPhotographerPeer::PHOTOGRAPHER_ID, 25 );
$jobs = JobPhotographerPeer::doSelect( $c );

$count = 1;
foreach( $jobs as $jp ){
	$j = $jp->getJob();
	
	// sfGCalendar::deleteEventById( $j->getGCalId() );
  /* if( !is_null($j->getGCalIdCustom()) ){
    $arr["calUrl"] = $j->getGCalIdCustomUrl();
    try{
      sfGCalendar::deleteEventById( $j->getGCalIdCustomUrl() );
    }catch(Exception $ex){ }  
  } */
	
	$arr = $j->createCalendarArray();
	$arr["calUrl"] = "http://www.google.com/calendar/feeds/t21645rjqqbtbch34skj0kjq3g%40group.calendar.google.com/private/full";
	
	echo ( $count / count($jobs) ) * 100 . "\n";
  $count += 1;
	
  try{
		$event = sfGCalendar::createJobEvent ( $arr );
		$j->setGCalIdCustom ( $event->id );
		$j->setGCalIdCustomUrl( $arr["calUrl"] );
    $j->save();
	}catch(Exception $ex){ 
		echo $ex->getMessage();
	}
	
}

?>