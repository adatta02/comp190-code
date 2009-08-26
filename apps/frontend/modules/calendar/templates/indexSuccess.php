<?php include_component ( "static", "topmenu", array("moveToSkip" => null, "noMenu" => true) ); ?>
<?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => null, 
                                "viewingCurrent" => null,
                                "noSort" => true) ); ?>

<script type="text/javascript">
function switchCal( showId ){
	$(".cal-container").each( 
			 function(){ 
				 $(this).hide(); 
  });

  $(showId).show();
}
</script>

<div id="content-container">

  <div id="now-viewing">Viewing Jobs Calendar</div>
  
  <div id="calendar-switch" style="padding-bottom: 20px">
    Switch to: <?php echo link_to_function("Global", "switchCal('#global-cal-container')"); ?> 
              | <?php echo link_to_function("Joanie's", "switchCal('#joanie-cal-container')"); ?>
              | <?php echo link_to_function("Alono's", "switchCal('#alonso-cal-container')"); ?>
  </div>
  
  <div class="cal-container" id="global-cal-container">
    <iframe src="http://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;src=contact%40setfive.com&amp;color=%232952A3&amp;ctz=America%2FNew_York" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>
  </div>
  
  <div class="cal-container" style="display: none" id="alonso-cal-container">
    <iframe src="http://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;src=t21645rjqqbtbch34skj0kjq3g%40group.calendar.google.com&amp;color=%23AB8B00&amp;ctz=America%2FNew_York" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>
  </div>  
  
  <div class="cal-container" style="display: none" id="joanie-cal-container">
    <iframe src="http://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;src=18gp9a10ca95a9j6kr8npq41oc%40group.calendar.google.com&amp;color=%23A32929&amp;ctz=America%2FNew_York" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>
  </div>
  
  <p>
    Export iCal links: <br />
    <ul>
      <li><a href="http://www.google.com/calendar/ical/contact%40setfive.com/public/basic.ics">Global</a></li>
      <li><a href="http://www.google.com/calendar/ical/18gp9a10ca95a9j6kr8npq41oc%40group.calendar.google.com/public/basic.ics">Alonso's Calendar</a></li>
      <li><a href="http://www.google.com/calendar/ical/t21645rjqqbtbch34skj0kjq3g%40group.calendar.google.com/public/basic.ics">Joanie's Calendar</a></li>
    </ul>
  </p>
</div>