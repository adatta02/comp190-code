<?php

class JobPhotographer extends BaseJobPhotographer
{
	
  public function save(PropelPDO $con = null)
  {
  	parent::save($con);
  	
  	$photoId = $this->getPhotographerId();
  	$arr = $this->getJob()->createCalendarArray();
  	
  	switch( $photoId ){
  		case 5: // Joanie
  		  $url = "http://www.google.com/calendar/feeds/" . urlencode(sfConfig::get("app_joanie_calendar_id")) . "/private/full";
  		  
  			$arr = $this->getJob()->createCalendarArray();
  			$arr["calUrl"] = $url;
  			$event = sfGCalendar::createJobEvent ( $arr );
        $this->getJob()->setGCalIdCustom ( $event->id );
        $this->getJob()->setGCalIdCustomUrl( $arr["calUrl"] );
        $this->getJob()->save();
  			break;
      case 25: // Alonso
        $url = "http://www.google.com/calendar/feeds/" . sfConfig::get("app_alonso_calendar_id") . "/private/full";
        
        $arr = $this->getJob()->createCalendarArray();
        $arr["calUrl"] = $url;
        $event = sfGCalendar::createJobEvent ( $arr );
        $this->getJob()->setGCalIdCustom ( $event->id );
        $this->getJob()->setGCalIdCustomUrl( $arr["calUrl"] );
        $this->getJob()->save();
        break;
  		default: break;
  	}
  }
  
}
