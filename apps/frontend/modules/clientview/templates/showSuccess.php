<?php use_helper("PMRender"); ?>
<?php echo GoogleMapsInclude(); ?>

<?php include_component ( "static", "topmenu", array("moveToSkip" => null, "noMenu" => true) ); ?>
<?php include_component ( "static", "userShortcuts",
                          array("sortedBy" => null,
                                "viewingCurrent" => null,
                                "noSort" => false) ); ?>

<div id="content-container">
<div id="now-viewing">
    Viewing job #<?php echo $job->getId(); ?>
    <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?>

</div>  

<div class="info-header">Basic 
<a href="#" onclick="javascript:$('#job-basic-info').toggle(); return false;">
<?php echo image_tag("arrow.png", array("class" =>"image-href", "style" => "width:15px;height:15px;")); ?>
</a>

</div>

<div id="job-basic-info" class="collapsable"><a href="#basic"></a>
  <?php include_partial("job/basicInfo", 
          array("job" => $job, "basicInfoForm" => null)); ?>
</div>

<hr />

<div class="info-header">Shoot <a href="#"
	onclick="javascript:$('#job-shoot-info').toggle(); return false;">
	<?php echo image_tag("arrow.png", array("class" =>"image-href", "style" => "width:15px;height:15px;")); ?></a>
</div>

<div id="job-shoot-info" class="collapsable"><a href="#shoot"></a>
  <?php include_partial("job/shootInfo", array("job" => $job, "form" => null)); ?>
</div>

<hr />

<div class="info-header">Photography <a href="#"
	onclick="javascript:$('#job-photogrpahy-info').toggle(); return false;">
	<?php echo image_tag("arrow.png", array("class" =>"image-href", "style" => "width:15px;height:15px;")); ?></a>
</div>

<div id="job-photogrpahy-info" class="collapsable">
  <a href="#photography"></a>
  <?php include_partial("job/photographyInfo", array("job" => $job, "form" => null)); ?>
</div>

<hr/>

<div class="info-header">Clients <a href="#"
	onclick="javascript:$('#job-client-info').toggle(); return false;">
	<?php echo image_tag("arrow.png", array("class" =>"image-href", "style" => "width:15px;height:15px;")); ?></a>
</div>

<div id="job-client-info" class="collapsable">
<div class="info-header-small">Current Clients:</div>

<div id="job-client-list">
  <?php include_partial("job/clientList", array("job" => $job)); ?>
</div>
</div>

<hr />

<div class="info-header">Billing and Delivery <a href="#"
	onclick="javascript:$('#job-billing-info').toggle(); return false;">
  <?php echo image_tag("arrow.png", array("class" =>"image-href", "style" => "width:15px;height:15px;")); ?></a>
</div>

<div id="job-billing-info" class="collapsable">
  	<?php include_partial("job/billingInfo", array("job" => $job, "form" => null)); ?>
</div>

</div>

