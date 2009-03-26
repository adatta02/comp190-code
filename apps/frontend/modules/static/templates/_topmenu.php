<?php use_helper("Form"); ?>

<div id="top-menu">
    <div id="left-top-menu"></div>

		<div id="top-menu-one">
		  <div id="top-menu-container">
			  <div id="move-menu">
			    Move to: <?php echo select_tag("move-to", options_for_select($options, "")); ?>
			  </div>
			  
			  <div id="top-search">
			      <?php echo input_tag("search-box"); ?> <?php echo submit_tag("Search"); ?>
			  </div>
			  
			  <div style="clear:both"></div>
			  
			  <div id="check-menu">
			    Select: <a href="#" onclick="return toggle(ProjectManager.ALL); return false;">All</a> 
			             * <a href="#" onclick="return toggle(ProjectManager.NONE);">None</a> 
			             * <a href="#" onclick="return toggle(ProjectManager.TOGGLE)">Toggle</a>
			  </div>
			  
			  <div id="project-menu">
          [+] Project
        </div>
        
        <div id="tag-menu">
          [+] Tag
        </div>
			  
		  </div>
		</div>
		
    <div id="right-top-menu"></div>
    
    <div class="clear"></div>
    
</div>