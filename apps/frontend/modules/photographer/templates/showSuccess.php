<?php use_helper("PMRender"); ?>
<?php echo include_javascripts_for_form($InfoForm); ?>


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

<script language="javascript">


ß</scipt>



<div class="info-header">Locations</div>
<form id="locations">
	<input type="text" name="loc" />
</form> 
	<button type="button" onclick="getLocations();">Add Location</button>
<div id="location-container">

</div>
</div>

<script type="text/javascript">
  function confirmDelete(){
    var res = confirm("Are you sure you want to delete this photographer?");
    
    if(res){
      window.location = "<?php echo url_for("photographer_remove", $photographer); ?>";
    }
  }
</script>
