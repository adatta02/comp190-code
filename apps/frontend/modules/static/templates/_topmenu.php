<?php use_helper("Form"); ?>
<?php use_helper("JavascriptBase"); ?>

<script type="text/javascript">
  $(document).ready( 
    function(){
      $("#add-tag").autocomplete("<?php echo url_for("tag_autocomplete"); ?>");
      $("#project-name").autocomplete("<?php echo url_for("project_autocomplete"); ?>", {width: "300px"});
      ProjectManager.addJobsToProjectUrl = "<?php echo url_for("job_addto_project"); ?>";
   });
</script>

<div id="top-menu">
    <div id="left-top-menu"></div>

		<div id="top-menu-one">
		  <div id="top-menu-container">
			  
			  <?php
			   $noMenu = (isset($noMenu) ? $noMenu : false);  
			   if(!$noMenu): ?>
				  <div id="move-menu">
				    Move to: <?php echo select_tag("move-to", options_for_select($options, "")); ?>
				  </div>
	
				  <div id="tag-menu">
	          <a href="#" onclick="javascript:$('#add-tag-menu').toggle()">
	            <?php echo image_tag("add.png", array("class" => "plus-img")); ?> Tag
	          </a>
	        </div>
	
				   <div id="project-menu">
				    <a 
				      href="#TB_inline?height=155&width=300&inlineId=hiddenAddProjectContent&modal=false"
				      class="thickbox">
	          <?php echo image_tag("add.png", array("class" => "plus-img")); ?> Project
	          </a>
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
			  <?php endif; ?>
		  </div>
		</div>
		
    <div id="right-top-menu"></div>
    
    <div class="clear"></div>
    <div id="hiddenAddProjectContent" style="display:none">
      <h3>Add jobs to project</h3>
      <label for="name">Project Name </label> <br/>
      <?php  echo input_tag("project-name", "", array("size" => 40)); ?>
      <br/>
      <label for="project-create-new">Create new project</label>
      <?php echo checkbox_tag("project-create-new", 1, false); ?>
      <br/>
      <label for="project-create-remove">Remove from project</label>
      <?php echo checkbox_tag("project-create-remove", 1, false); ?>
      <br/>
      <?php echo button_to_function("Add", "addToProject()"); ?>
    </div>
    
</div>