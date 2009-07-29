<?php

error_reporting(E_ALL);
include_once "../../config/ProjectConfiguration.class.php";

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'dev', true);
$sfContext = sfContext::createInstance($configuration);
$sfContext->dispatch();

$dom = new DOMDocument();
$dom->loadXML( file_get_contents("buildings.kml") );

$xpath = new DOMXPath($dom);
$query = '//Placemark';
$entries = $xpath->query($query);

echo "\n\n\n";

foreach($entries as $en){
	$children = $en->childNodes;
	
	$add = new CampusBuilding();
	
	foreach($children as $cn){
		$nodeName = $cn->localName;
		
		if( $nodeName == "name" ){
			$add->setName( $cn->textContent );
			echo $cn->textContent . "\n";
		}
		
		if( $nodeName == "ExtendedData" ){
		  $extendedChildren = $cn->childNodes;
		  foreach($extendedChildren as $ex){
		  	switch( $ex->localName ){
		  		case "CenterLat": $add->setLatitude( $ex->textContent ); break;
		  		case "CenterLng": $add->setLongitude( $ex->textContent ); break;
		  		case "Address": $add->setAddress( $ex->textContent ); break;
		  		default: break;
		  	}
		  }
		}
		
	}
	
	$add->save();
}

?>