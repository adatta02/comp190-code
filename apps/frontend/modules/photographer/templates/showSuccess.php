<?php use_helper("PMRender"); ?>
<?php echo include_javascripts_for_form($InfoForm); ?>
<?php echo GoogleMapsInclude(); ?>

<div class="span-6">
  <?php include_component ( "static", "shortcuts",
                            array("sortedBy" => null,
                                  "viewingCurrent" => null,
                                  "noSort" => true) ); ?>
</div>

<script type="text/javascript">

  <?php 
  $points = array();
  foreach ($photographer->getPhotographerRegions() as $pr){
    $obj = array();
    $obj["lat"] = $pr->getLatitude();
    $obj["lng"] = $pr->getLongitude();
    $obj["address"] = $pr->getAddress();
    $points[] = $obj;
  }?>

  var map;
  var points = <?php echo json_encode($points) ?>;
  var markers = new Array();
  
  $(document).ready(function(){ initialize(); });
  $(document).unload( function(){ GUnload(); });
   
  function initialize() {
    if (!GBrowserIsCompatible()) {
      return;
    }
    
    map = new GMap2(document.getElementById("location-map"));
    map.setCenter(new GLatLng(42.85986,-71.05957), 5);
    map.setUIToDefault();
    
    loadPoints(points);
  }
  
  function loadPoints(pointsToLoad){
    $.each(pointsToLoad, 
     function(i, n){ 
       var latlng = new GLatLng(n.lat, n.lng);
       map.addOverlay( createMarker(latlng, n.address) );
     });
  }
  
  function confirmDelete(){
    var res = confirm("Are you sure you want to delete this photographer?");
    
    if(res){
      window.location = "<?php echo url_for("photographer_remove", $photographer); ?>";
    }
  }

  function deleteLocation(id, address){
    var res = confirm("Are you sure you want to delete this location?");
    if(res){
    
      var newPoints = new Array();
      $.each(points, function(i, n){
        if(n.address != address){
          newPoints.push( n );
        }
      });
      
      points = newPoints;
      map.clearOverlays();
      loadPoints(points);
    
      $("#loading").show();
      $("#location-list").load("<?php echo url_for("photographer_delete_location"); ?>", 
                              {id: id, photogId: <?php echo $photographer->getId() ?>}, 
                              function(data){ 
                                $("#loading").hide(); 
                              });
    }
  }

  function getLocations(address){
   var geocoder = new GClientGeocoder();
   var address = $("#loc").val();
   var latlng;
  
    geocoder.getLatLng(address, 
       function(point) {
         if (!point) {
           alert("Sorry! We couldn't geocode " + address);
           return;
         }
        
        points.push( {lat: point.lat(), lng: point.lng(), address: address} );
        
        $("#loading").show();
        $("#location-list").load("<?php echo url_for("photographer_save_location"); ?>", 
                   {lat: point.lat(), 
                    lng: point.lng(), 
                    address: address, photogId: "<?php echo $photographer->getId() ?>"}, 
                   function(data){ 
                     $("#loading").hide();
                     map.addOverlay( createMarker(point, address) );
                   });
                
     });
  }

</script>


<div class="span-17 last">
  <div id="content-container" class="box">
  <div id="now-viewing">
    Viewing photographer <?php echo $photographer->getName(); ?>
    <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?>
  </div>

  <hr class="space" />
  <div id="delete-link">
        <?php echo link_to_function("Delete Photographer", "confirmDelete()"); ?>
        |
        <?php echo link_to ( "View jobs by " . $photographer->getName(), "photographer_view_jobs", $photographer )?>
  </div>
  <hr class="space" />
  
  <div class="info-header">Information <a href="#"
  	onclick="javascript:$('#info-edit').toggle(); return false;">
    <?php echo image_tag("pencil.png", array("class" => "image-href")) ?>
  </a></div>
  
  <div id="photographer-info"><a href="#info"></a>
    <?php include_partial("Info", array("photographer" => $photographer, "InfoForm" => $InfoForm)); ?>
  </div>
  
  <div class="info-header">Locations</div>
  <div id="location-list">
    <?php include_partial("regionList", array("photographer" => $photographer)); ?>
  </div>
  	<form id="locations"><input type="text" id="loc" />
  	<button type="button" onclick="getLocations()">Add Location</button>
  	<?php echo image_tag("loading.gif", array("id" => "loading", "style" => "display: none")) ?>
  </form>
  
  <br />
  
  <div id="location-container"></div>
    <div id="location-map" style="width: 500px; height: 300px">
  </div>
</div>