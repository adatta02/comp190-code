<?php use_helper("PMRender"); ?>
<?php echo include_javascripts_for_form($basicInfoForm); ?>
<?php echo include_stylesheets_for_form($basicInfoForm); ?>

<script 
  src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true_or_false&amp;key=<?php echo sfConfig::get("app_gmap_key"); ?>"
  type="text/javascript">
</script>

<script type="text/javascript">
  
  ProjectManager.viewingJobId = <?php echo $job->getId(); ?>;
  ProjectManager.addClientToJobUrl = "<?php echo url_for("@job_add_client"); ?>";
  ProjectManager.removeClientFromJob = "<?php echo url_for("@job_remove_client"); ?>";
  ProjectManager.addPhotographerToJobUrl = "<?php echo url_for("@job_add_photographer"); ?>";
  ProjectManager.removePhotographerFromJobUrl = "<?php echo url_for("@job_remove_photographer"); ?>";
  ProjectManager.addJobTagUrl = "<?php echo url_for("@job_add_tag"); ?>";
  ProjectManager.removeJobTagUrl = "<?php echo url_for("@job_remove_tag"); ?>";
  ProjectManager.isViewingJob = true;
  
  function jumpEditHistoryToPage(page){
    $("#history-loading").show();
    $("#job-edit-history").load("<?php echo url_for("job_view_history", array("slug" => $job->getSlug())); ?>", {page: page}, 
                           function(){ $("#history-loading").hide();});
  }
  
  $(document).ready( 
    function(){
    
	  $("#add-tag-val")
	    .autocomplete('<?php echo url_for ( "@tag_autocomplete" )?>', $.extend({}, {
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
	    .result(function(event, data) { });
    
    $("#add-client-name")
    .autocomplete('<?php
        echo url_for ( "@client_autocomplete" )?>', $.extend({}, {
      dataType: 'json',
      parse:    function(data) {
                  var parsed = [];
                  var obj;
                  for(var i=0; i < data.length; i++){
                    obj = new Object();
                    obj.data = [data[i].name + " &lt;" + data[i].email + "&gt", data[i].id];
                    obj.value = data[i].name;
                    obj.result = data[i].name;
                    parsed.push(obj);
                  }
                  return parsed;
      }}, {width: 300}))
    .result(function(event, data) { $("#add-client-id").val(data[1]); });
    
    $("#add-photographer-name")
    .autocomplete('<?php
        echo url_for ( "@photographer_autocomplete" )?>', $.extend({}, {
      dataType: 'json',
      parse:    function(data) {
                  var parsed = [];
                  var obj;
                  for(var i=0; i < data.length; i++){
                    obj = new Object();
                    obj.data = [data[i].name + " &lt;" + data[i].email + "&gt", data[i].id];
                    obj.value = data[i].name;
                    obj.result = data[i].name;
                    parsed.push(obj);
                  }
                  return parsed;
      }}, {width: 300}))
    .result(function(event, data) { $("#add-photographer-id").val(data[1]); });
    
   });
</script>

<?php include_component ( "static", "topmenu", array("moveToSkip" => null, "noMenu" => true) ); ?>
<?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => null, 
                                "viewingCurrent" => null,
                                "noSort" => true) ); ?>

<div id="content-container">
<div id="now-viewing">
    Viewing job #<?php echo $job->getId(); ?>
    <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?> 
  </div>

<div class="info-header">Basic 
<a href="#" onclick="javascript:$('#job-basic-info').toggle(); return false;">[tg]</a>
<a href="#" onclick="javascript:$('#basic-info-edit').toggle(); $('#basic-info-table').toggle(); return false;">
  <?php echo image_tag("pencil.png", array("class" => "image-href")) ?>
</a>
</div>

<div id="job-basic-info" class="collapsable"><a href="#basic"></a>
  <?php include_partial("basicInfo", array("job" => $job, "basicInfoForm" => $basicInfoForm)); ?>
</div>

<hr />

<div class="info-header">Shoot <a href="#"
	onclick="javascript:$('#job-shoot-info').toggle(); return false;">[tg]</a>
	 <a href="#" onclick="javascript:$('#shoot-edit-table').toggle(); $('#shoot-info-table').toggle(); return false;">
    <?php echo image_tag("pencil.png", array("class" => "image-href")) ?>
  </a>
	
</div>

<div id="job-shoot-info" class="collapsable"><a href="#shoot"></a>
  <?php include_partial("shootInfo", array("job" => $job, "form" => $shootInfoForm)); ?>
</div>

<hr />

<div class="info-header">Photography <a href="#"
	onclick="javascript:$('#job-photogrpahy-info').toggle(); return false;">[tg]</a>
	 <a href="#" onclick="javascript:$('#photography-edit-table').toggle(); $('#photography-info-table').toggle(); return false;">
    <?php echo image_tag("pencil.png", array("class" => "image-href")) ?>
  </a>
	
</div>

<div id="job-photogrpahy-info" class="collapsable">
  <a href="#photography"></a>
  <?php include_partial("photographyInfo", array("job" => $job, "form" => $photographyInfoForm)); ?>
</div>

<hr/>

<div class="info-header">Clients <a href="#"
	onclick="javascript:$('#job-client-info').toggle(); return false;">[tg]</a>
</div>

<div id="job-client-info" class="collapsable">
<div class="info-header-small">Current Clients: <a
	href="#TB_inline?height=200&width=330&inlineId=hiddenAddClient&modal=false"
	class="thickbox">
	   <?php echo image_tag("add.png", array("class" => "plus-img")); ?>
	   </a></div>

<div id="hiddenAddClient" style="display: none">
<h3>Add Client:</h3>
<label for="add-client-name"> Client Name <br />
</label>
	   <?php echo input_tag("add-client-name", "", array("size" => 30)); ?>
	   <?php echo input_hidden_tag("add-client-id"); ?>
	   <?php echo button_to_function("Add", "addClientToJob()"); ?>
</div>

<div id="job-client-list">
    <?php include_partial("clientList", array("job" => $job)); ?>
	</div>

</div>
<hr />

<div class="info-header">Photographers <a href="#"
	onclick="javascript:$('#job-photographer-info').toggle(); return false;">[tg]</a>
</div>

<div id="job-photographer-info" class="collapsable">
  <div class="info-header-small">
    Current Photographers: 
    <a href="#TB_inline?height=200&width=330&inlineId=hiddenAddPhotographer&modal=false"
        class="thickbox">
      <?php echo image_tag("add.png", array("class" => "plus-img")); ?>
    </a>
  </div>

   <div id="hiddenAddPhotographer" style="display:none">
     <h3>Add Photographer:</h3>
     <label for="add-photographer-name">
       Photographer Name <br/>
     </label>
     <?php echo input_tag("add-photographer-name", "", array("size" => 30)); ?>
     <?php echo input_hidden_tag("add-photographer-id"); ?>
     <?php echo button_to_function("Add", "addPhotographerToJob()"); ?>
   </div>

	<div id="job-photographer-list">
	  <?php include_partial("photographerList", array("job" => $job)); ?>
	</div>

</div>

<hr />

<div class="info-header">Billing and Delivery <a href="#"
	onclick="javascript:$('#job-billing-info').toggle(); return false;">[tg]</a>
	<a href="#" onclick="javascript:$('#billing-edit-table').toggle(); $('#billing-info-table').toggle(); return false;">
    <?php echo image_tag("pencil.png", array("class" => "image-href")) ?>
  </a>
</div>

<div id="job-billing-info" class="collapsable">
  	<?php include_partial("billingInfo", array("job" => $job, "form" => $billingInfoForm)); ?>
</div>

<hr />

<div class="info-header">Internal Notes <a href="#"
  onclick="javascript:$('#job-internal-notes').toggle(); return false;">[tg]</a>
  <a href="#" onclick="javascript:$('#internal-notes-edit').toggle(); $('#internal-notes-div').toggle(); return false;">
    <?php echo image_tag("pencil.png", array("class" => "image-href")) ?>
  </a>
</div>

<div id="job-internal-notes" class="collapsable">
  <?php include_partial("internalNotes", array("job" => $job)); ?>
</div>

<div class="info-header">History <a href="#"
  onclick="javascript:$('#job-edit-history').toggle(); return false;">[tg]</a>
  <?php echo image_tag("loading.gif", array("id" => "history-loading", "style" => "display: none")); ?> 
</div>

<hr />

<div id="job-edit-history" class="collapsable">
  <?php include_partial("logRender", array("pager" => $logPager)); ?>
</div>

</div>

