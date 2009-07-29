<?php use_helper("Form"); ?>
<?php use_helper("JavascriptBase"); ?>


<script type="text/javascript">
  $(document).ready( 
    function(){

  // tag-search
  $("#search-tag").autocomplete('<?php echo url_for ( "@tag_autocomplete" )?>', $.extend({}, {
      dataType: 'json',
      parse:    function(data) {
                  var parsed = [];
                  var obj;
                  for(var i=0; i < data.length; i++){
                    obj = new Object();
                    obj.data = [data[i].name, data[i].searchUrl];
                    obj.value = data[i].name;
                    obj.result = data[i].name;
                    parsed.push(obj);
                  }
                  return parsed;
      }}, {}))
    .result(function(event, data) { window.location = data[1]; });

  // search-box
  $("#search-box")
    .autocomplete('<?php
        echo url_for ( "@job_autocomplete" )?>', $.extend({}, {
      dataType: 'json',
      parse:    function(data) {
                  var parsed = [];
                  var obj;
                  for(var i=0; i < data.length; i++){
                    obj = new Object();
                    obj.data = [data[i].name, data[i].url];
                    obj.value = data[i].name;
                    obj.result = data[i].name;
                    parsed.push(obj);
                  }
                  return parsed;
      }}, {}))
    .result(function(event, data) { window.location = data[1]; });
    
  $("#add-tag")
    .autocomplete('<?php
				echo url_for ( "@tag_autocomplete" )?>', $.extend({}, {
      dataType: 'json',
      parse:    function(data) {
                  var parsed = [];
                  var obj;
                  for(var i=0; i < data.length; i++){
                    obj = new Object();
                    obj.data = [data[i].name, data[i].id];
                    obj.value = data[i].name;
                    obj.result = data[i].name;
                    parsed.push(obj);
                  }
                  return parsed;
      }}, {}))
    .result(function(event, data) { $("#add-tag-id").val(data[1]); });

  $("#project-name")
    .autocomplete('<?php
				echo url_for ( "@project_autocomplete" )?>', $.extend({}, {
      dataType: 'json',
      parse:    function(data) {
                  var parsed = [];
                  var obj;
                  for(var i=0; i < data.length; i++){
                    obj = new Object();
                    obj.data = [data[i].name, data[i].id];
                    obj.value = data[i].name;
                    obj.result = data[i].name;
                    parsed.push(obj);
                  }
                  return parsed;
      }}, {}))
    .result(function(event, data) { $("#add-project-id").val(data[1]); });

      ProjectManager.addJobsToProjectUrl = "<?php
						echo url_for ( "job_addto_project" );
						?>";
   });
</script>

<div id="top-menu">

<div id="top-menu-one">
<div class="top-menu-container">
			  
			  <div id="user-banner">
			   <?php echo "Logged in as " . $sf_user->getUserName(); ?>
			  </div>
			  
			  <?php
			   $noMenu = (isset($noMenu) ? $noMenu : false);  
			   if(!$noMenu): ?>
				  <div id="move-menu">
				    <ul class="nobullet-ul">
				      <li>Move to: <?php echo select_tag("move-to", options_for_select($options, "")); ?></li>
				      <li>Select: 
				          <a href="#all" onclick="return toggle(ProjectManager.ALL); return false;">All</a> | 
				          <a href="#none" onclick="return toggle(ProjectManager.NONE); return false;">None</a> | 
				          <a href="#toggle" onclick="return toggle(ProjectManager.TOGGLE); return false;">Toggle</a>
				        </li>
				    </ul>
				  </div>

          <div id="tag-menu">
            <ul class="nobullet-ul">
	           <li>
	             <a href="#TB_inline?height=155&width=300&inlineId=add-tag-menu&modal=false" class="thickbox">
		            <?php echo image_tag("add.png", array("class" => "plus-img")); ?> Tag
		          </a>
		         </li>
		         <li>
              <a href="#TB_inline?height=200&width=400&inlineId=hiddenAddProjectContent&modal=false" class="thickbox">
                <?php echo image_tag("add.png", array("class" => "plus-img")); ?> Project
              </a>
		         </li>
		        </ul>
	        </div>

<div id="top-search">
  <ul class="nobullet-ul">
	  <li>
	  <?php echo form_tag("@job_search", array("method" => "GET")); ?>
	    <?php echo input_tag("search-box", "", array("style" => "width: 240px")); ?> 
	    <?php echo submit_tag("Search"); ?>
	  </form>
	  </li>
	  <li>
	    <a href="#TB_inline?height=100&width=300&inlineId=hiddenSearchByTag&modal=false" class="thickbox">Search by tag</a> 
	     |  
	    <?php echo link_to("Advanced Search", "advanced_search"); ?>
	  </li>
  </ul>
</div>

<div style="clear: both"></div>

  <div id="add-tag-menu">
    <p style="padding-top: 10px">
      <label for="add-tag">Enter Tag</label>
      <?php echo input_tag("add-tag"); ?>
      <?php echo input_hidden_tag("add-tag-id"); ?>
      <?php echo button_to_function("Add", "addJobTag()"); ?>
    </p>
    </p>
  </div>
    <?php endif; ?>
		  </div>
</div>

<div class="clear"></div>
<div id="hiddenAddProjectContent" style="display: none">
<h3>Add jobs to project</h3>
<label for="name">Project Name </label> <br />
      <?php  echo input_tag("project-name", "", array("size" => 40)); ?>
      <br />
<label for="project-create-new">Create new project</label>
      <?php echo checkbox_tag("project-create-new", 1, false); ?>
      <br />
<label for="project-create-remove">Remove from project</label>
      <?php echo checkbox_tag("project-create-remove", 1, false); ?>
      <br />
      <?php echo input_hidden_tag("add-project-id"); ?>
      <?php echo button_to_function("Add", "addToProject()"); ?>
</div>

<div id="hiddenSearchByTag" style="display:none">
  <h3>Search By Tag</h3>
  <?php echo input_tag("search-tag", "", array("size" => 25)); ?>
</div>

</div>
