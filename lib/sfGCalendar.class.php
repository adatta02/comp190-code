<?php

class sfGCalendar {
	
	private static $IS_REGISTERED = false;
	private static $service = null;
	
  private static function register(){
  	include_once("Zend/Loader.php");
    Zend_Loader::loadClass('Zend_Gdata');
    Zend_Loader::loadClass('Zend_Gdata_AuthSub');
    Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
    Zend_Loader::loadClass('Zend_Gdata_HttpClient');
    Zend_Loader::loadClass('Zend_Gdata_Calendar');
    
		// Parameters for ClientAuth authentication
		$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
		$user = sfConfig::get("app_gcal_user");
		$pass = sfConfig::get("app_gcal_password");

    // Create an authenticated HTTP client
    $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);

    // Create an instance of the Calendar service
    self::$service = new Zend_Gdata_Calendar($client);
    self::$IS_REGISTERED = true;
  }
  
  public static function getCalendarList(){
  	
  	if(!self::$IS_REGISTERED)
     self::register();
  	
     $calFeed = self::$service->getCalendarListFeed();
     $arr = array();
     
     foreach ($calFeed as $calendar) {
     	$arr[] = array( $calendar->title->text, $calendar->getLink("alternate")->href   );
     }
  	
     return $arr;
  }
  
  public static function getEventById($id){
  
    if(!self::$IS_REGISTERED)
     self::register();
  	
    try {
      $event = self::$service->getCalendarEventEntry($id);
    } catch (Zend_Gdata_App_Exception $e) {
      // well this is BAD but I'm not sure what to do...
      throw new sfException("Unable to retrieve event!", 0);
    }
    
    return $event;
  }
  
  public static function updateJobEventById($eventId, $arr){
  	
  	if(!self::$IS_REGISTERED)
     self::register();
    
  	try{
  	 // $event = self::getEventById($eventId);
  	 $event = self::$service->getCalendarEventEntry($eventId);
  	}catch(sfException $ex){
  		return null;
  	}
  	
    $event->title = self::$service->newTitle($arr["title"]);
    $event->where = array(self::$service->newWhere($arr["location"]));
    $event->content = self::$service->newContent($arr["content"]);
    $when = self::$service->newWhen();
    $when->startTime = $arr["startTime"];
    $when->endTime = $arr["endTime"];
    $event->when = array($when);
    
  	$event->save();
  	
  	return true;
  }
  
  public static function deleteEventById($eventId){
    if(!self::$IS_REGISTERED)
     self::register();
    
    try{
     $event = self::$service->getCalendarEventEntry($eventId);
    }catch(sfException $ex){
    	echo $ex->getMessage();
      return false;
    }
    
    try{
    	$event->delete();
    }catch(sfException $ex){
    	echo $ex->getMessage();
      return false;
    }
    
    return true;
  }
  
  public static function createJobEvent($arr){
    
  	if(!self::$IS_REGISTERED)
  	 self::register();
  	
    // Create a new entry using the calendar service's magic factory method
    $event = self::$service->newEventEntry();
    
    // Populate the event with the desired information
    // Note that each attribute is crated as an instance of a matching class
    $event->title = self::$service->newTitle($arr["title"]);
    $event->where = array(self::$service->newWhere($arr["location"]));
    $event->content = self::$service->newContent($arr["content"]);
    
    // Set the date using RFC 3339 format.
    $when = self::$service->newWhen();
    $when->startTime = $arr["startTime"];
    $when->endTime = $arr["endTime"];
    $event->when = array($when);
    
    $url = null;
    if(array_key_exists("calUrl", $arr)){
    	$url = $arr["calUrl"];
    }
    
    // Upload the event to the calendar server
    // A copy of the event as it is recorded on the server is returned
    
    if(is_null($url)){
    	try{
    	   $newEvent = self::$service->insertEvent($event);
    	}catch(Exception $ex){ }
    }else{
    	try{
    	 $newEvent = self::$service->insertEvent($event, $url);
    	}catch(Exception $e){ }
    }
    
    return $newEvent;
  }
  
  public static function timestampToRFC3339($timestamp=0) {

    if (!$timestamp) {
        $timestamp = time();
    }
    $date = date('Y-m-d\TH:i:s', $timestamp);

    $matches = array();
    if (preg_match('/^([\-+])(\d{2})(\d{2})$/', date('O', $timestamp), $matches)) {
        $date .= $matches[1].$matches[2].':'.$matches[3];
    } else {
        $date .= 'Z';
    }
    return $date;
  }
  
}

?>