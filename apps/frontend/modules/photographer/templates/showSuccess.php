<?php use_helper("PMRender"); ?>
<?php echo include_javascripts_for_form($InfoForm); ?>
<?php echo GoogleMapsInclude(); ?>

<?php include_component ( "static", "topmenu", array("moveToSkip" => null, "noMenu" => true) ); ?>
<?php include_component ( "static", "shortcuts",
                          array("sortedBy" => null,
                                "viewingCurrent" => null,
                                "noSort" => true) ); ?>

<div id="content-container">
<div id="now-viewing">
    Viewing photographer <?php echo $photographer->getName(); ?>
   <span id="delete-link">
      <?php echo link_to_function("Delete Photographer", "confirmDelete()"); ?>
   </span>
    <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?>
  </div>

<div class="info-header">Information
<a href="#" onclick="javascript:$('#info-edit').toggle(); return false;">
  <?php echo image_tag("pencil.png", array("class" => "image-href")) ?>
</a>
</div>

<div id="photographer-info"><a href="#info"></a>
  <?php include_partial("Info", array("photographer" => $photographer, "InfoForm" => $InfoForm)); ?>
</div>

<div class="info-header">Locations</div>
<form id="locations">
	<input type="text" id="loc" /><button type="button" onclick="getLocations()">Add Location</button>
</form> 
<div id="location-container">
<?php 
      $pr = PhotographerRegionPeer::doSelect(new Criteria());
      foreach ($pr as $i){
         if($pr->getPhotographerId() == $photographer->getId()){
	      echo $pr->getAddress();
	 }
      }
?>

</div>
</div>

<script type="text/javascript">
  function confirmDelete(){
    var res = confirm("Are you sure you want to delete this photographer?");
    
    if(res){
      window.location = "<?php echo url_for("photographer_remove", $photographer); ?>";
    }
  }

  function getLocations(address){
	var geocoder = new GClientGeocoder();
	var address = document.getElementById('loc');
	var latlng;
	
	geocoder.getLatLng(
                  address.value,
                    function(point) {
                      if (!point) {
                        alert(address.value + " not found");
                    } else {
                        latlng = point;
			var coords = new GPoint();
			var p = new GPoint();
			var curProj = G_NORMAL_MAP.getProjection();
			p = curProj.fromLatLngToPixel(latlng, 10);
			coords.x = Math.floor(p.x / 256);
			coords.y = Math.floor(p.y / 256);
                    }
                  }
                );
	}

	function distance(destX, destY, phoX, phoY, dist){
		var x = Math.pow((phoX - destX),2);
		var y = Math.pow((phoY - destY),2);
		actualDist = Math.sqrt(x + y);
		if(dist <= actualDist){
		}
	}
	

</script>
