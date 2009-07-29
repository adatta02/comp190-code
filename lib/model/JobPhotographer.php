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
  			$arr = $this->getJob()->createCalendarArray();
  			$arr["calUrl"] = "http://www.google.com/calendar/feeds/18gp9a10ca95a9j6kr8npq41oc%40group.calendar.google.com/private/full";
  			$event = sfGCalendar::createJobEvent ( $arr );
        $this->getJob()->setGCalIdCustom ( $event->id );
        $this->getJob()->setGCalIdCustomUrl( $arr["calUrl"] );
        $this->getJob()->save();
  			break;
      case 25: // Alonso
        $arr = $this->getJob()->createCalendarArray();
        $arr["calUrl"] = "http://www.google.com/calendar/feeds/t21645rjqqbtbch34skj0kjq3g%40group.calendar.google.com/private/full";
        $event = sfGCalendar::createJobEvent ( $arr );
        $this->getJob()->setGCalIdCustom ( $event->id );
        $this->getJob()->setGCalIdCustomUrl( $arr["calUrl"] );
        $this->getJob()->save();
        break;
  		default: break;
  	}
  	
  }
}
