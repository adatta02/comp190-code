<?php use_helper("PMRender"); ?>
<?php echo GoogleMapsInclude(); ?>

<script type="text/javascript">
$(document).ready( function(){
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
});
</script>

<div class="span-6">
  <?php include_component ( "static", "userShortcuts",
                          array("sortedBy" => null,
                                "viewingCurrent" => null,
                                "noSort" => false) ); ?>
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
  
  </div>
  
  <div id="job-basic-info" class="collapsable"><a href="#basic"></a>
    <?php include_partial("job/basicInfo", 
            array("job" => $job, "basicInfoForm" => null)); ?>
  </div>
  
  <div class="info-header">Shoot <a href="#"
  	onclick="javascript:$('#job-shoot-info').toggle(); return false;">
  	<?php echo image_tag("arrow.png", array("class" =>"image-href", "style" => "width:15px;height:15px;")); ?></a>
  </div>
  
  <div id="job-shoot-info" class="collapsable"><a href="#shoot"></a>
    <?php include_partial("job/shootInfo", array("job" => $job, "form" => null)); ?>
  </div>
  
  <div class="info-header">Photography <a href="#"
  	onclick="javascript:$('#job-photogrpahy-info').toggle(); return false;">
  	<?php echo image_tag("arrow.png", array("class" =>"image-href", "style" => "width:15px;height:15px;")); ?></a>
  </div>
  
  <div id="job-photogrpahy-info" class="collapsable">
    <a href="#photography"></a>
    <?php include_partial("job/photographyInfo", array("job" => $job, "form" => null)); ?>
  </div>
  
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
  
  <div class="info-header">Billing and Delivery <a href="#"
  	onclick="javascript:$('#job-billing-info').toggle(); return false;">
    <?php echo image_tag("arrow.png", array("class" =>"image-href", "style" => "width:15px;height:15px;")); ?></a>
  </div>
  
  <div id="job-billing-info" class="collapsable">
    	<?php include_partial("job/billingInfo", array("job" => $job, "form" => null)); ?>
  </div>
  
  </div>
  
</div>

