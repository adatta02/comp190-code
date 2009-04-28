<?php use_helper("PMRender"); ?>
<?php echo include_javascripts_for_form($basicInfoForm); ?>
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

<script language="javascript">

function email(template){
	  <?php
           $cN = $job->getContactName();
	   foreach($job->getPhotographers() as $i){ 
	      $pName = $i->getName();
	   }
	   
	   $u = url_for('@job_email');	

	?>
        var connam = "<?php echo $cN; ?>";
	var pn = "<?php echo $pName; ?>";
	
	var url = "<?php echo $u; ?>";

	var doc = document.getElementById('emailSec');
	var emailStuff = "<form action='" + url + "' method='POST'><table>";
	emailStuff += "<tr><td>From</td><td><input type='text' id='from' value='' /></td></tr>";

	   if(template == "details"){
               emailStuff += "<tr><td>To</td><td><input type='text' id='to' value='' /></td></tr>";
               emailStuff += "<tr><td>Subject</td><td><input type='text' id='subject' value='Verify Details' /></td></tr>";
               emailStuff += "<tr><td colspan='2'><textarea id='body' rows='20' cols='50'>Dear " + connam + ", \n\n Thank you for submitting your photo assignment request. Please review and confirm with us the details of your job at LINK.\n\nUnless otherwise noted in your request, delivery time for photos is 10-14 business days. If you have any questions, please contact us at the email address or phone number below.\n\nThanks again!\n\nThe Tufts Photo Team \n\nUniversity Photography\n80 George St., First Floor\nMedford,MA 02155\nTel:617.627.4282\nFax: 617.627.3549\nphoto.tufts.edu</textarea></td></tr>";
         }

	   if(template == "acceptance"){
	       emailStuff += "<tr><td>To</td><td><input type='text' id='to' value='' /></td></tr>";
               emailStuff += "<tr><td>Subject</td><td><input type='text' id='subject' value='Job Acceptance' /></td></tr>";
               emailStuff += "<tr><td colspan='2'><textarea id='body' rows='20' cols='50'>Dear " + connam + ", \n\n Here is your final approved photo request. Please review the details and contact us as soon as possible if you need to make changes.\n\nWe look forward to working with you on this assignment.\n\nThe Tufts Photo Team \n\nUniversity Pho\
tography\n80 George St., First Floor\nMedford,MA 02155\nTel:617.627.4282\nFax: 617.627.3549\nphoto.tufts.edu</textarea></td></tr>";
         }

	if(template == "completion"){
	       emailStuff += "<tr><td>To</td><td><input type='text' id='to' value='' /></td></tr>";
               emailStuff += "<tr><td>Subject</td><td><input type='text' id='subject' value='Job Completion' /></td></tr>";
	       emailStuff += "<tr><td colspan='2'><textarea id='body' rows='20' cols='50'>Dear " + connam + ", \n\n We have photographed our assignment. The photos are being processed and will be delivered to you within 10-14 business days unless otherwise noted. \n\nThanks for choosing University Photography!\n\nThe Tufts Photo Team \n\nUniversity Photography\n80 George St., First Floor\nMedford,MA 02155\nTel:617.627.4282\nFax: 617.627.3549\nphoto.tufts.edu</textarea></td></tr>";
    	 }
	 
	 if(template == "assign"){	 	     
	       emailStuff += "<tr><td>To</td><td><input type='text' id='to' value='' /></td></tr>";
               emailStuff += "<tr><td>Subject</td><td><input type='text' id='subject' value='Photographer Assignment' /></td></tr>";
	       emailStuff += "<tr><td colspan='2'><textarea id='body' rows='20' cols='50'>Dear " + pn + ", \n\n Thank you for working on this assignment. If you have any questions, please contact us at the email address or phone number below.\nPlease arrange to deliver the images by FTP or mail within 1-2 business days of the shoot.\n\nGood Luck!\n\nThe Tufts Photo Team \n\nUniversity Photography\n80 George St., First Floor\nMedford,MA 02155\nTel:617.627.4282\nFax: 617.627.3549\nphoto.tufts.edu</textarea></td></tr>";
         }

	emailStuff += '<tr><td colspan="2"><input type="submit" value="Send Email" /></td></tr>';
	emailStuff += "</table></form>";
	
	doc.innerHTML = emailStuff;
}


function putIn(template){
	 <?php
           $toEmail = $job->getContactEmail();
           $cName = $job->getContactName();

	  $fromEmail = $sfGuardUserProfile->getEmail();

	   foreach($job->getPhotographers() as $i){
              $pEmail = $i->getEmail();
           }


	?>
        var cn = "<?php echo $cName; ?>";
	var t;

	var f = "<?php echo $fEmail; ?>";

	if(template == "assign"){
            t = "<?php echo $pEmail; ?>";	
	}else{
	    t = "<?php echo $toEmail; ?>";
        }
	
	 document.getElementById('from').value = f;
 	 document.getElementById('to').value = t;
	
}

</script>



<div id="content-container">
<div id="now-viewing">
    Viewing job #<?php echo $job->getId(); ?>
    <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?>

</div>  

<div class="info-header">Basic 
<a href="#" onclick="javascript:$('#job-basic-info').toggle(); return false;">
<?php echo image_tag("arrow.png", array("class" =>"image-href", "style" => "width:15px;height:15px;")); ?>
</a>
<a href="#" onclick="javascript:$('#basic-info-edit').toggle(); $('#basic-info-table').toggle(); return false;">
  <?php echo image_tag("pencil.png", array("class" => "image-href")) ?>
</a>
</div>

<div id="job-basic-info" class="collapsable"><a href="#basic"></a>
  <?php include_partial("basicInfo", array("job" => $job, "basicInfoForm" => $basicInfoForm)); ?>
</div>

<hr />

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

<hr />

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

<hr/>

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
<hr />

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

<hr />

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

<hr />

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

<div class="info-header">History <a href="#"
  onclick="javascript:$('#job-edit-history').toggle(); return false;">
<?php echo image_tag("arrow.png", array("class" =>"image-href", "style" => "width:15px;height:15px;")); ?></a>
  <?php echo image_tag("loading.gif", array("id" => "history-loading", "style" => "display: none")); ?> 
</div>

<hr />

<div id="job-edit-history" class="collapsable">
  <?php include_partial("logRender", array("pager" => $logPager)); ?>
</div>

<hr/>


<div class="info-header">Email<br><br></div>
<div>
<form>
<select name="temp">
<option value="details">Verify Details</option>
<option value="acceptance">Job Acceptance</option>
<option value="completion">Job Completion</option>
<option value="assign">Photographer Assignment</option>
</select>
<button type='button' onclick='email(temp.value);putIn(temp.value);'>Show Template</button>
</form>
<br><br>
</div>

<div id="emailSec"></div>


</div>

