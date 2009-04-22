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

      var gmarkers = [];
      var htmls = [];
      var to_htmls = [];
      var from_htmls = [];
      var i=0;

      function createMarker(point,html) {
        var marker = new GMarker(point);

	to_htmls[i] = html + '<br>Directions: <b>To here<\/b> - <a href="javascript:fromhere(' + i + ')">From here<\/a>' +
           '<br>Start address:<form action="http://maps.google.com/maps" method="get" target="_blank">' +
           '<input type="text" SIZE=40 MAXLENGTH=40 name="saddr" id="saddr" value="" /><br>' +
           '<INPUT value="Get Directions" TYPE="SUBMIT">' +
           '<input type="hidden" name="daddr" value="' + point.lat() + ',' + point.lng() +
           '"/>';
   
	from_htmls[i] = html + '<br>Directions: <a href="javascript:tohere(' + i + ')">To here<\/a> - <b>From here<\/b>' +
           '<br>End address:<form action="http://maps.google.com/maps" method="get"" target="_blank">' +
           '<input type="text" SIZE=40 MAXLENGTH=40 name="daddr" id="daddr" value="" /><br>' +
           '<INPUT value="Get Directions" TYPE="SUBMIT">' +
           '<input type="hidden" name="saddr" value="' + point.lat() + ',' + point.lng() + 
	   '"/>';

	   html = html + '<br>Directions: <a href="javascript:tohere('+i+')">To here<\/a> - <a href="javascript:fromhere('+i+')">From here<\/a>';
	 
        GEvent.addListener(marker, "click", function() {
          marker.openInfoWindowHtml(html);
        });

        htmls[i] = html;
        i++;
        return marker;
      }

      function tohere(i) {
        marker.openInfoWindowHtml(to_htmls[i]);
      }

      function fromhere(i) {
        marker.openInfoWindowHtml(from_htmls[i]);
      }
  
      var address = "<?php echo $job->getStreet(); ?>,<?php echo $job->getCity(); ?>,<?php echo $job->getState(); ?>";
                  geocoder.getLatLng(
                  address,
                    function(point) {
                      if (!point) {
                        alert(address + " not found");
                    } else {
                        map.setCenter(point, 13);
                        var marker = createMarker(point, address);
			map.addOverlay(marker);
			marker.openInfoWindowHtml(html);
                    }
                  }
                );
      }
    }
 </script>

<div id="map" style="width: 500px; height: 300px" onunload="GUnload()">

</div>