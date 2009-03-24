<?php use_helper("Form"); ?>
<div id="top-menu-one">
  <div id="move-menu" style="float:left">
    Move to: <?php echo select_tag("move-to", $options); ?>
  </div>
  
  <div id="project-menu" style="float:left; padding-left: 50px">
    [+] Project
  </div>
  
  <div id="tag-menu" style="float:left; padding-left: 70px">
    [+] Tag
  </div>
  
  <div style="clear:both"></div>
  
  <div id="check-menu" style="padding-top: 8px">
    Select: All None Toggle
  </div>
  
</div>