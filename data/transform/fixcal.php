<?php

error_reporting(E_ALL);
include_once "../../config/ProjectConfiguration.class.php";

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', true);
$sfContext = sfContext::createInstance($configuration);

/*
$c = new Criteria();
$c->add(JobPeer::G_CAL_ID, null);

foreach( JobPeer::doSelect( $c ) as $job ){
  
  list( $hour, $min, $sec ) = explode(":", $job->getStartTime());
  list( $eHour, $eMin, $eSec ) = explode(":", $job->getEndTime());
  
  echo $job->getId() . "\n";
  
  if( $hour < 5 && ($eHour+12) < 24 ){
    $hour += 12;
    $start = $hour . ":" . $min . ":" . $sec;
    $job->setStartTime( $start );
    
    list( $hour, $min, $sec ) = explode(":", $job->getEndTime());
    $hour += 12;
    $end = $hour . ":" . $min . ":" . $sec;
    
    $job->setEndTime( $end );
  }
  
  try{
    $job->save();
  }catch( Exception $ex ){
    echo $ex->getMessage();
    echo $ex->getTraceAsString();
  }
  
  sleep(1);
}

*/

$c = new Criteria();
$c->add( JobPhotographerPeer::PHOTOGRAPHER_ID, 25 );
$c->add( JobPeer::G_CAL_ID_CUSTOM, null);
$c->addJoin( JobPhotographerPeer::JOB_ID, JobPeer::ID );

$jobs = JobPhotographerPeer::doSelect( $c );

$count = 1;
foreach( $jobs as $jp ){
  
  $jp->save();
  
  echo ( $count / count($jobs) ) * 100 . "\n";
  $count += 1;
  sleep(5);
}

/*
$dom = DOMDocument::load("tuftsph_jm2db.xml");
$jobs = $dom->getElementsByTagName("jobs");
    
$total = $jobs->length;
$count = 1;
    
foreach($jobs as $job){
  $jid = 0;
  $startTime = null;
  $endTime = null;
      
  $childNodes = $job->childNodes;
      
  foreach($childNodes as $child){
  	switch( $child->nodeName ){
          case "id"; $jid = $child->textContent; break;
          case "shoot_startT": $startTime = $child->textContent; break;
          case "shoot_endT": $endTime = $child->textContent; break;
          case "shoot_start": $shootStart = $child->textContent; break;
          case "shoot_end": $shootEnd = $child->textContent; break;
            default: break;
    }
  }
  
  $j = JobPeer::retrieveByPk( $jid );
  
  if( is_null($j) ){
  	echo "Missing job - " . $jid . "\n";
  	continue;
  }
  
  if( is_null($endTime) ){ $endTime = $shootEnd; }
  if( is_null($startTime) ){ $startTime = $shootStart; }
  
  list($hour, $min, $sec) = explode(":", $endTime);
  list($shour, $smin, $ssec) = explode(":", $startTime);
  
  if( $hour < $shour ){ 
  	$hour += 12;
  }
  
  $t = new DateTime();
  $t->setTime($hour, $min, $sec);
  $j->setEndTime($t);

  $t = new DateTime();
  $t->setTime($shour, $smin, $ssec);
  $j->setStartTime($t);
  
  try{
      $j->save();
  }catch(Exception $ex){
      echo $ex->getMessage() . " -- " . $j->getId();
  }
    
  echo ($count / $total) * 100 . "\n";
  $count += 1; 
}

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
  } 
	
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
	
} */

?>