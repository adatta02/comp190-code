<?php use_helper("Form"); ?>

<div id="top-menu">
    <div id="left-top-menu"></div>

		<div id="top-menu-one">
		  <div id="top-menu-container">
			  <div id="move-menu" style="float:left">
			    Move to: <?php echo select_tag("move-to", $options); ?>
			  </div>
			  
			  <div id="project-menu">
			    [+] Project
			  </div>
			  
			  <div id="tag-menu">
			    [+] Tag
			  </div>
			  
			  <div id="top-search" style="float:left; padding-left: 80px">
			      <?php echo input_tag("search-box"); ?> <?php echo submit_tag("Search"); ?>
			  </div>
			  
			  <div style="clear:both"></div>
			  
			  <div id="check-menu">
			    Select: All None Toggle
			  </div>
		  </div>
		</div>
		
    <div id="right-top-menu"></div>
    
    <div class="clear"></div>
    
</div>