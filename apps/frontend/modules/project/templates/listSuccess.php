<?php use_helper("JavascriptBase"); ?>
<script type="text/javascript">
  ProjectManager.createProjectUrl = "<?php echo url_for("project_create"); ?>";
</script>

<div class="span-6">
  <?php include_component ( "static", "shortcuts", 
                            array("sortedBy" => JobPeer::DATE,
                                  "noSort" => true,
                                  "viewingCurrent" => null) ); ?>
</div>

<div class="span-17 last">
  
  <div class="box" id="list-container">
  
	<div id="now-viewing"> 
	  Viewing all projects <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?> 
	</div>
	
	<div id="create-project">
	 <a href="#" onclick="showProjectCreate()">Create Project</a>
	 <div id="create-project-form" style="display:none">
	   <label for="project-name">Name:</label>
	     <?php echo input_tag("project-name", "", array("MAXLENGTH" => 44, "size" => 50)); ?>
	   <?php echo button_to_function("Create", "createProject(); return false;"); ?>
	 </div>
	</div>
	
	<div id="project-list">
	 <?php include_partial("renderList", array("pager" => $pager)); ?>
	</div>
	
  </div>

</div>