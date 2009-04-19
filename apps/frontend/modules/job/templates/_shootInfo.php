<?php use_helper("JavascriptBase"); ?>

<table width="100%" id="shoot-info-table">
  <tr>
    <td width="20%">Shoot Address</td>
    <td width="80%"><?php echo $job->getPrettyAddress(); ?></td>
  </tr>
</table>

<form id="shoot-info-form"
       action="<?php echo url_for("job_edit", array("form" => 'shoot', "job_id" => $job->getId())); ?>"
       method="post">
	<table id="shoot-edit-table" style="display: none">
	   <?php echo $form["street"]->renderRow(); ?>
	   <?php echo $form["city"]->renderRow(); ?>
	   <?php echo $form["state"]->renderRow(); ?>
	   <?php echo $form["zip"]->renderRow(); ?>
	   <tr><td><?php echo button_to_function("Save", "saveShootInfo()"); ?>
	</table>
</form>

<script type="text/javascript">
  $(document).ready(function(){ initialize(); });
  function initialize() {
    
    if (GBrowserIsCompatible()) {
      var map = new GMap2(document.getElementById("map"));
      var geocoder = new GClientGeocoder();
      map.setUIToDefault();
      
      var address = "<?php echo $job->getStreet(); ?>,<?php echo $job->getCity(); ?>,<?php echo $job->getState(); ?>";
                  geocoder.getLatLng(
                  address,
                    function(point) {
                      if (!point) {
                        alert(address + " not found");
                    } else {
                        map.setCenter(point, 13);
                        var marker = new GMarker(point);
                        map.addOverlay(marker);
                        marker.openInfoWindowHtml(address);
                    }
                  }
                );
      }
    }
 </script>

<div id="map" style="width: 500px; height: 300px" onunload="GUnload()">

</div>