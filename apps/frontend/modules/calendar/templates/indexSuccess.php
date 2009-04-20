<?php include_component ( "static", "topmenu", array("moveToSkip" => null, "noMenu" => true) ); ?>
<?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => null, 
                                "viewingCurrent" => null,
                                "noSort" => true) ); ?>
<div id="content-container">
<div id="now-viewing">Viewing Jobs Calendar</div>
  <iframe src="http://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=contact%40setfive.com&amp;color=%232952A3&amp;ctz=America%2FNew_York" 
    style=" border-width:0 " 
    width="800" height="600" 
    frameborder="0" scrolling="no"></iframe>
</div>