<?php use_helper("PMRender"); ?>
<?php // echo include_javascripts_for_form($basicInfoForm); ?>
<?php echo include_stylesheets_for_form($basicInfoForm); ?>

<?php echo GoogleMapsInclude(); ?>

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

    $("#building-search")
      .autocomplete('<?php echo url_for ( "@building_autocomplete" )?>', $.extend({}, {
        dataType: 'json',
        parse:    function(data) {
                    var parsed = [];
                    var obj;
                    for(var i=0; i < data.length; i++){
                      obj = new Object();
                      obj.data = [data[i].name, data[i].address, data[i].lat, data[i].lng];
                      obj.value = data[i].name;
                      obj.result = data[i].name;
                      parsed.push(obj);
                    }
                    return parsed;
        }}, {}))
      .result(function(event, data) { 
        var html = "<strong>" + data[0] + "</strong><br />" + data[1];
        var point = new GLatLng( data[2], data[3] );
        var marker = createMarker(point, html);
        
        map.clearOverlays();
        map.addOverlay(marker);
        map.setCenter(point, 15);
        marker.openInfoWindowHtml(html);
        
       });
    
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
    
    showEmailTemplate();
    
   });

var lastEmailName = "%name%";

function updateEmail(name, email){
  $("#email-to").val( email );
  $("#email-body").val( $("#email-body").val().replace(lastEmailName, name) );
  lastEmailName = name;
}

function showEmailTemplate(){
  $("#email-container").show();
  $("#email-photographers").hide();
  $("#email-to").val( "" );
  
  var template = $("#email-template").val();
  var contactEmail = "";
  var contactName = "";
  var photogEmail = "";
  var photogName = "";
  
  <?php
  $clients = $job->getClients();
  if( count($clients) == 1 ){
    $client = array_shift( $clients );
    ?>
    contactEmail = "<?php echo $client->getEmail(); ?>";
    contactName = "<?php echo $client->getName(); ?>";
    <?php
  }elseif( count($clients) > 1 ){
    $emails = array();
    foreach( $clients as $client ){
      $emails[] = $client->getEmail(); 
    }
    ?>
    contactEmail = "<?php echo implode(",", $emails) ?>";
    contactName = "<?php echo "" ?>";
    <?php
  }
  
  ?>
  
  if(template == "details"){
    $("#email-subject").val( "University Photography - Job #<?php echo $job->getId();?> Details" );
    $("#email-body").val( $("#email-template-details").html().replace("%name%", contactName) );
    $("#email-to").val( contactEmail );
  }
  
  if(template == "acceptance"){
    $("#email-subject").val( "University Photography - Job #<?php echo $job->getId();?> Accepted" );
    $("#email-body").val( $("#email-template-acceptance").html().replace("%name%", contactName) );
    $("#email-to").val( contactEmail );
  }

  if(template == "completion"){
    $("#email-subject").val( "University Photography - Job #<?php echo $job->getId();?> Completion" );
    $("#email-body").val( $("#email-template-completion").html().replace("%name%", contactName) );
    $("#email-to").val( contactEmail );
   }
   
   if(template == "assign"){         
    $("#email-subject").val( "University Photography - Job #<?php echo $job->getId();?> Assignment" );
    $("#email-photographers").show();
    $("#email-body").val( $("#email-template-assign").html() );
   }
}

function sendEmail(){
  var obj = new Object();
  
  if($("#email-to").val().length == 0){
    alert("Please enter something in the 'TO' field!");
    return;
  }
  
  obj.to = $("#email-to").val();
  obj.from = $("#email-from").val();
  obj.subject = $("#email-subject").val();
  obj.body = $("#email-body").val();
  obj.jobId = "<?php echo $job->getId(); ?>";
  
  $("#email-container").hide();
  $("#email-loading").show();
  
  $.getJSON("<?php echo url_for("job_email"); ?>", obj, 
              function(data){
                $("#email-loading").hide(); 
                alert(data);
              });
  
}

</script>

<div class="span-6">
  <?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => null, 
                                "viewingCurrent" => null,
                                "noSort" => true) ); ?>
</div>

<div class="span-17 last">
  <div id="content-container" class="box">
  <div id="now-viewing">
      Viewing job #<?php echo $job->getId(); ?>
      <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?>
  
  </div>  
  
  <div class="info-header">Basic 
  <a href="#" onclick="javascript:$('#job-basic-info').toggle(); return false;">
  <?php echo image_tag("arrow.png", array("class" =>"image-href", "style" => "width:15px;height:15px;")); ?>
  </a>
  <a href="#" 
    onclick="javascript: $('#basic-info-edit').toggle(); $('#basic-info-table').toggle(); activateTimepickrs(); return false;">
    <?php echo image_tag("pencil.png", array("class" => "image-href")) ?>
  </a>
  </div>
  
  <script type="text/javascript">
  function activateTimepickrs(){
  	$('#job_start_time').show();
  	$('#job_start_time')
  	 .timepickr({
  	 convention: 12,
  	 dropslide: {trigger: 'focus'},
  	 format12: '{h:02.d}:{m:02.d} {suffix:s}',
  	 format24: '{h:02.d}:{m:02.d}',
  	 handle: false,
  	 hours: true,
  	 minutes: true,
  	 seconds: false,
  	 prefix: ["am","pm"],
  	 suffix: ["am","pm"],
  	 rangeMin: ["00","15","30","45"],
  	 rangeSec: ["00","15","30","45"],
  	 updateLive: "true",
  	 resetOnBlur: "false"
  	});
  
  	  $('#job_end_time').show();
  	  $('#job_end_time')
  	   .timepickr({
  	   convention: 12,
  	   dropslide: {trigger: 'focus'},
  	   format12: '{h:02.d}:{m:02.d} {suffix:s}',
  	   format24: '{h:02.d}:{m:02.d}',
  	   handle: false,
  	   hours: true,
  	   minutes: true,
  	   seconds: false,
  	   prefix: ["am","pm"],
  	   suffix: ["am","pm"],
  	   rangeMin: ["00","15","30","45"],
  	   rangeSec: ["00","15","30","45"],
  	   updateLive: "true",
  	   resetOnBlur: "false"
  	  });
  	  
  	
  }
  </script>
  
  <div id="job-basic-info" class="collapsable">
    <a href="#basic"></a>
    <?php include_partial("basicInfo", array("job" => $job, "basicInfoForm" => $basicInfoForm)); ?>
  </div>
  
  <div class="info-header">Shoot <a href="#"
  	onclick="javascript:$('#job-shoot-info').toggle(); return false;">
  	<?php echo image_tag("arrow.png", array("class" =>"image-href", "style" => "width:15px;height:15px;")); ?></a>
  	 <a href="#" onclick="javascript:$('#shoot-edit-table').toggle(); $('#shoot-info-table').toggle(); return false;">
      <?php echo image_tag("pencil.png", array("class" => "image-href")) ?>
    </a>
  	
  </div>
  
  <div id="job-shoot-info" class="collapsable"><a href="#shoot"></a>
    <?php include_partial("shootInfo", array("job" => $job, "form" => $shootInfoForm)); ?>
  </div>
  
  <div class="info-header">Photography <a href="#"
  	onclick="javascript:$('#job-photogrpahy-info').toggle(); return false;">
  	<?php echo image_tag("arrow.png", array("class" =>"image-href", "style" => "width:15px;height:15px;")); ?></a>
  	 <a href="#" onclick="javascript:$('#photography-edit-table').toggle(); $('#photography-info-table').toggle(); return false;">
      <?php echo image_tag("pencil.png", array("class" => "image-href")) ?>
    </a>
  	
  </div>
  
  <div id="job-photogrpahy-info" class="collapsable">
    <a href="#photography"></a>
    <?php include_partial("photographyInfo", array("job" => $job, "form" => $photographyInfoForm)); ?>
  </div>
  
  <div class="info-header">Clients <a href="#"
  	onclick="javascript:$('#job-client-info').toggle(); return false;">
  	<?php echo image_tag("arrow.png", array("class" =>"image-href", "style" => "width:15px;height:15px;")); ?></a>
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
  
  <div class="info-header">Photographers <a href="#"
  	onclick="javascript:$('#job-photographer-info').toggle(); return false;">
  <?php echo image_tag("arrow.png", array("class" =>"image-href", "style" => "width:15px;height:15px;")); ?></a>
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
  
  <div class="info-header">Billing and Delivery <a href="#"
  	onclick="javascript:$('#job-billing-info').toggle(); return false;">
  <?php echo image_tag("arrow.png", array("class" =>"image-href", "style" => "width:15px;height:15px;")); ?></a>
  	<a href="#" onclick="javascript:$('#billing-edit-table').toggle(); $('#billing-info-table').toggle(); return false;">
      <?php echo image_tag("pencil.png", array("class" => "image-href")) ?>
    </a>
  </div>
  
  <div id="job-billing-info" class="collapsable">
    	<?php include_partial("billingInfo", array("job" => $job, "form" => $billingInfoForm)); ?>
  </div>
  
  <div class="info-header">Internal Notes <a href="#"
    onclick="javascript:$('#job-internal-notes').toggle(); return false;">
  <?php echo image_tag("arrow.png", array("class" =>"image-href", "style" => "width:15px;height:15px;")); ?></a>
    <a href="#" onclick="javascript:$('#internal-notes-edit').toggle(); $('#internal-notes-div').toggle(); return false;">
      <?php echo image_tag("pencil.png", array("class" => "image-href")) ?>
    </a>
  </div>
  
  <div id="job-internal-notes" class="collapsable">
    <?php include_partial("internalNotes", array("job" => $job)); ?>
  </div>
  
  <div id="job-attachments" class="collapsable">
    <?php include_component("job", "attachments", array("job" => $job)); ?>
  </div>
  
  <div class="info-header">History <a href="#"
    onclick="javascript:$('#job-edit-history').toggle(); return false;">
  <?php echo image_tag("arrow.png", array("class" =>"image-href", "style" => "width:15px;height:15px;")); ?></a>
    <?php echo image_tag("loading.gif", array("id" => "history-loading", "style" => "display: none")); ?> 
  </div>
  
  <div id="job-edit-history" class="collapsable">
    <?php include_partial("logRender", array("pager" => $logPager)); ?>
  </div>
  
  <div id="email-templates" class="collapsable">
  
  <div class="info-header">Email <?php echo image_tag("loading.gif", 
                                                      array("class" => "ajax-loading", "id" => "email-loading", "style" => "display: none")) ?> </div>
  
  <form>
  	<select id="email-template" onchange="showEmailTemplate()">
  	  <option value=''>Select a template</option>
  		<option value="details">Verify Details</option>
  		<option value="acceptance">Job Acceptance</option>
  		<option value="completion">Job Completion</option>
  		<option value="assign">Photographer Assignment</option>
  	</select>
  </form>
  
  <br/><br/>
  
  <div id=email-container style="display: none">
    <form action="<?php echo url_for("job_email"); ?>" method='POST' 
        onsubmit="javascript:sendEmail(); return false;">
      <label for="email-to">To</label> 
        <input type='text' id='email-to' value='' size="64" /> <br />
      
      <div id="email-photographers" style="display: none">
        <optgroup>
        <?php foreach($job->getPhotographers() as $ph): ?>
          <?php echo $ph->getName() . 
                radiobutton_tag("email-photog", $ph->getEmail(), 0,
                                array("onclick" => "updateEmail('" . $ph->getName() . "', '" . $ph->getEmail() . "')" )
                                ); ?> <br/>
        <?php endforeach; ?>
        </optgroup>
      </div>
      
      <label for="email-from">From</label> 
        <input type='text' id='email-from' value='photo@tufts.edu' /> <br />
      <label for="email-subject">Subject</label> 
        <input type='text' id='email-subject' value='' size="64" /> <br />
      <textarea id='email-body' style="width: 500px; height: 400px">
      </textarea>
      <hr class="space" />
      <input type="submit" value="Send" />
    </form>
  </div>
  </div>
  
  </div>
</div>

<div id="email-template-assign" style="display: none">Dear %name%,

Thank you for working on this assignment. 

If you have any questions, please contact us at the email address or phone number below.
Please arrange to deliver the images by FTP or mail within 1-2 business days of the shoot.

Good Luck!

The Tufts Photo Team

University Photography
80 George St., First Floor
Medford,MA 02155
Tel:617.627.4282
Fax: 617.627.3549
photo.tufts.edu

<?php echo getJobDetails($job); ?>

</div>

<div id="email-template-completion" style="display: none">Dear %name%, 

We have photographed our assignment. 
The photos are being processed and will be delivered to you within 10-14 business days unless otherwise noted. 

Thanks for choosing University Photography!

The Tufts Photo Team
University Photography
80 George St., First Floor
Medford,MA 02155
Tel:617.627.4282
Fax: 617.627.3549
photo.tufts.edu

<?php echo getJobDetails($job); ?>

</div>

<div id="email-template-acceptance" style="display: none">Dear %name%,

Here is your final approved photo request. 
Please review the details and contact us as soon as possible if you need to make changes.

We look forward to working with you on this assignment.

The Tufts Photo Team

University Phototography
80 George St., First Floor
Medford,MA 02155
Tel:617.627.4282
Fax: 617.627.3549
photo.tufts.edu

<?php echo getJobDetails($job); ?>

</div>

<div id="email-template-details" style="display: none;">Dear %name%,

Thank you for submitting your photo assignment request. 
Please review and confirm with us the details of your job by logging into 
http://jobs.tuftsphoto.com.
Unless otherwise noted in your request, delivery time for photos is 10-14 business days. 
If you have any questions, please contact us at the email address or phone number below.
Thanks again!
The Tufts Photo Team 

University Photography
80 George St., First Floor
Medford,MA 02155
Tel:617.627.4282
Fax: 617.627.3549
photo.tufts.edu

<?php echo getJobDetails($job); ?>

</div>

