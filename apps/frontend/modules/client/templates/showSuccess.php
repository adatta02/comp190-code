<?php use_helper("PMRender"); ?>
<?php echo include_javascripts_for_form($InfoForm); ?>


<div class="span-6">
  <?php include_component ( "static", "shortcuts",
                          array("sortedBy" => null,
                                "viewingCurrent" => null,
                                "noSort" => true) ); ?>
</div>

<div class="span-17 last">
  <div id="content-container" class="box">
  
  <div id="now-viewing">
      Viewing client <?php echo $client->getName(); ?> 
      <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?>
  </div>
  
  <?php echo link_to_function("Delete Client", "confirmDelete()"); ?>
  <hr class="space" />
  
  <div class="info-header">Information
  <a href="#" onclick="javascript:$('#info-edit').toggle(); return false;">
    <?php echo image_tag("pencil.png", array("class" => "image-href")) ?>
  </a>
  </div>
  
  <div id="client-info"><a href="#info"></a>
    <?php include_partial("Info", array("client" => $client, "InfoForm" => $InfoForm)); ?>
  </div>
 </div>
</div>
<script type="text/javascript">
  function confirmDelete(){
    var res = confirm("Are you sure you want to delete this client?");
    
    if(res){
      window.location = "<?php echo url_for("client_remove", $client); ?>";
    }
  }
</script>