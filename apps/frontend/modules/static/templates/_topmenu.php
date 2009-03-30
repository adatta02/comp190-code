<?php use_helper("Form"); ?>
<?php use_helper("JavascriptBase"); ?>

<div id="top-menu">
    <div id="left-top-menu"></div>

		<div id="top-menu-one">
		  <div id="top-menu-container">
			  <div id="move-menu">
			    Move to: <?php echo select_tag("move-to", options_for_select($options, "")); ?>
			  </div>

			  <div id="tag-menu">
          <a href="#" onclick="javascript:$('#add-tag-menu').toggle()">
            <?php echo image_tag("add.png", array("class" => "plus-img")); ?> Tag
          </a>
        </div>

			   <div id="project-menu">
          <?php echo image_tag("add.png", array("class" => "plus-img")); ?> Project
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
			  
			  <div id="add-tag-menu">
			   <?php echo input_tag("add-tag"); ?> 
			   <?php echo button_to_function("Add", "addJobTag()"); ?>
			  </div>
			  
		  </div>
		</div>
		
    <div id="right-top-menu"></div>
    
    <div class="clear"></div>
    
</div>