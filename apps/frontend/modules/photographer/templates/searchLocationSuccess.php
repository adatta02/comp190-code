<?php use_helper("PMRender"); ?>
<?php echo GoogleMapsInclude(); ?>

<div class="span-6">
  <?php include_component ( "static", "shortcuts",
                            array("sortedBy" => null,
                                  "viewingCurrent" => null,
                                  "noSort" => true) ); ?>
</div>

<div class="span-17 last">
  <div class="box" id="content-container">
    <div id="now-viewing">Viewing photographer location search</div>
    <?php echo form_tag("", array("onsubmit" => "locationSearch(); return false;")) ?>
      <label for="search-for">Search</label>
      <?php echo input_tag("search-for", null, array("id" => "search-for")); ?>
      <?php echo submit_tag("Search"); ?>
      <?php echo image_tag("loading.gif", array("id" => "loading", "style" => "display: none")) ?>
    </form>
    
    <div id="map-container" style="padding-top: 10px;">
      <div id="map" style="height: 500px; width: 800px"></div>
    </div>
    
    <div id="result-list-container" style="padding-top: 10px">
      <div class="info-header">Results</div>
      <div id="result-list"></div>
    </div>
  </div>
</div>

<script type="text/javascript">

  $(document).ready(function(){ initialize(); });
  
  var geocoder = new GClientGeocoder();
  var markers = new Array();
  var map;
  var searchLatLng;
  
  function openMarker(markerIndex){
    var mk = markers[markerIndex];
    map.panTo( mk.marker.getLatLng() );
    mk.marker.openInfoWindow( mk.content );
  }
  
  function locationSearch(){
    geocoder.getLatLng($("#search-for").val(), 
       function(point) {
         if (!point) {
           alert("Sorry! We couldn't geocode " + address);
           return;
         }
        
        searchLatLng = point;
        $("#loading").show();
        $.getJSON("<?php echo url_for("photographer_search_location"); ?>", 
                              {lat: point.lat(), lng: point.lng()}, 
                              function(data){
                                var html = "<ul>";
                                
                                $("#loading").hide();
                                $.each(data, 
                                  function(i, val){
                                    var pt = new GLatLng(val.latitude, val.longitude);
                                    var content = "<a href=\"" + val.link + "\">" + val.photographer_name + "</a><br/>" + val.address;
                                    var mk = createMarker(pt, content);
                                    
                                    markers.push( {marker: mk, content: content} );
                                    map.addOverlay( mk );
                                    
                                    html += "<li><a href=\"" + val.link + "\">" + val.photographer_name + "</a> -- " +
                                              "<a href=\"#\" onclick=\"openMarker(" + (markers.length-1) + "); return false;\">" 
                                              + val.address + "</a></li>";
                                  });
                                
                                html += "</ul>";
                                $("#result-list").html( html );
                              });
                
     });
  }
  
  function initialize() {
    if (!GBrowserIsCompatible()) {
      return;
    }
    
    map = new GMap2(document.getElementById("map"));
    map.setCenter(new GLatLng(42.85986,-71.05957), 5);
    map.setUIToDefault();
  }
</script>