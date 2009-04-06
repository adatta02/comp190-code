<script type="text/javascript">
  
  ProjectManager.viewingJobId = <?php echo $job->getId(); ?>;
  ProjectManager.addClientToJobUrl = "<?php echo url_for("@job_add_client"); ?>";
  ProjectManager.removeClientFromJob = "<?php echo url_for("@job_remove_client"); ?>";
  ProjectManager.addPhotographerToJobUrl = "<?php echo url_for("@job_add_photographer"); ?>";
  ProjectManager.removePhotographerFromJobUrl = "<?php echo url_for("@job_remove_photographer"); ?>";
  
  $(document).ready( 
    function(){
    
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

<div class="info-header">Basic <a href="#"
	onclick="javascript:$('#job-basic-info').toggle(); return false;">[tg]</a>
</div>

<div id="job-basic-info" class="collapsable"><a href="#basic"></a>
<table width="100%" border="0">
	<tr>
		<td width="20%">Event</td>
		<td width="80%"><?php echo $job->getEvent(); ?></td>
	</tr>
	<tr>
		<td>Status</td>
		<td><?php echo $job->getStatus()->getState(); ?></td>
	</tr>
	<tr>
		<td>Shoot Type</td>
		<td><?php echo $job->getPhotoType() ?></td>
	</tr>
	<tr>
		<td>Shoot Date</td>
		<td><?php echo $job->getPrettyShootDate() ?></td>
	</tr>
	<tr>
		<td>Due Date</td>
		<td><?php echo $job->getDueDate("F n, o"); ?></td>
	</tr>
	<tr>
		<td>Created At</td>
		<td><?php echo $job->getCreatedAt("F n, o"); ?></td>
	</tr>
	<tr>
		<td>Contact</td>
		<td><?php echo mail_to($job->getContactEmail(), $job->getContactName()) . " &lt;" . $job->getContactEmail(); ?>&gt;</td>
	</tr>
	<tr>
		<td>Contact Phone</td>
		<td><?php echo $job->getContactPhone() ?></td>
	</tr>
	<tr>
		<td>Publication</td>
		<td>
          <?php if($job->getPublication()) 
                  echo $job->getPublication()->getName();
                else
                  echo "None"; 
          ?>
       </td>
	</tr>
	<tr>
		<td>Tags</td>
		<td>
        <?php foreach($job->getTags() as $tag): ?>
          <?php echo link_to($tag, "job_listby_tag", array("name" => $tag)) . " "; ?>
        <? endforeach; ?>
       </td>
	</tr>
</table>
</div>

<hr />

<div class="info-header">Shoot <a href="#"
	onclick="javascript:$('#job-shoot-info').toggle(); return false;">[tg]</a>
</div>

<div id="job-shoot-info" class="collapsable"><a href="#shoot"></a>

<table>
	<tr>
		<td class="shoot-datetime">Shoot Date</td>
		<td class="shoot-datetime"><?php echo $job->getPrettyShootDate(); ?></td>
	</tr>
	<tr>
		<td>Shoot Address</td>
		<td><?php echo $job->getPrettyAddress(); ?></td>
	</tr>
</table>

<div id="job-map">MAP GOES HERE!</div>

</div>

<hr />

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
</div>

<div id="job-billing-info" class="collapsable"></div>

</div>

