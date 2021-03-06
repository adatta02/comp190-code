<?php use_helper("JavascriptBase"); ?>
<div class="span-6">
<?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => null, 
                                "viewingCurrent" => null,
                                "noSort" => true) ); ?>
</div>

<script type="text/javascript">
function switchCal( showId ){
	$(".cal-container").each( 
			 function(){ 
				 $(this).hide(); 
  });

  $(showId).show();
}
</script>

<div class="span-17 last">
  <div id="content-container" class="box">
  
    <div id="now-viewing">Viewing Jobs Calendar</div>
    
    <div id="calendar-switch" style="padding-bottom: 20px">
      Switch to: <?php echo link_to_function("Global", "switchCal('#global-cal-container')"); ?> 
                | <?php echo link_to_function("Joanie", "switchCal('#joanie-cal-container')"); ?>
                | <?php echo link_to_function("Alonso", "switchCal('#alonso-cal-container')"); ?>
    </div>
    
    <div class="cal-container" id="global-cal-container">
      <iframe src="http://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;src=contact%40setfive.com&amp;color=%232952A3&amp;ctz=America%2FNew_York" 
        style="border-width:0; width: 95%" height="500" frameborder="0" scrolling="no"></iframe>
    </div>
    
    <div class="cal-container" style="display: none" id="alonso-cal-container">
      <iframe src="http://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;src=<?php echo urlencode(sfConfig::get("app_alonso_calendar_id")) ?>&amp;color=%23AB8B00&amp;ctz=America%2FNew_York" style=" border-width:0; width: 95%" height="500" frameborder="0" scrolling="no"></iframe>
    </div>  
    
    <div class="cal-container" style="display: none" id="joanie-cal-container">
      <iframe src="http://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;src=<?php echo urlencode(sfConfig::get("app_joanie_calendar_id")) ?>&amp;color=%23A32929&amp;ctz=America%2FNew_York" style=" border-width:0; width: 95%" height="500" frameborder="0" scrolling="no"></iframe>
    </div>
    
    <p>
      Export iCal links: <br />
      <ul>
        <li><a href="http://www.google.com/calendar/ical/contact%40setfive.com/public/basic.ics">Global</a></li>
        <li><a href="http://www.google.com/calendar/ical/<?php echo urlencode(sfConfig::get("app_alonso_calendar_id")) ?>/public/basic.ics">Alonso's Calendar</a></li>
        <li><a href="http://www.google.com/calendar/ical/<?php echo urlencode(sfConfig::get("app_joanie_calendar_id")) ?>/public/basic.ics">Joanie's Calendar</a></li>
      </ul>
    </p>
  </div>
</div>