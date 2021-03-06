<script type="text/javascript">
  ProjectManager.photographerLiveSearchUrl = "<?php echo url_for("photographer_list"); ?>";
</script>

<div class="span-6">
  <?php include_component ( "static", "shortcuts", 
                            array("sortedBy" => JobPeer::DATE,
                                  "noSort" => true,
                                  "viewingCurrent" => null) ); ?>
</div>

<div class="span-17 last">
<div id="list-container" class="box">
    <div id="now-viewing"> 
      Viewing all photographers 
        <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?>
    </div>
    
    <div id="search-photogs">
      <label for="live-search-photographers">Live Search </label>
      <?php echo input_tag("live-search-photographers", $q); ?> | 
      <?php echo link_to("Create Photographer", "photographer_create") ?>
    </div>
    
    <div id="photographer-list" style="display:none">
     <?php include_partial("renderList", array("pager" => $pager, "q" => $q)); ?>
    </div>
    
  </div>
</div>

<script type="text/javascript">
$(document).ready(
  function(){
    $("#live-search-photographers").keyup(function(){ runLiveSearch(false) });
    if(window.location.hash){
      $("#live-search-photographers").val(window.location.hash.replace("#", ""));
      runLiveSearch(true);
    }else{
      $("#photographer-list").show();
    }
});

function runLiveSearch(showDiv){
  
  window.location.hash = $("#live-search-photographers").val();
  
  $("#ajax-loading").attr("style", "display:inline");
  $("#photographer-list").load(ProjectManager.photographerLiveSearchUrl, 
                                {q: $("#live-search-photographers").val()},
                                function() {
                                    if(showDiv){
                                      $("#photographer-list").show();
                                    }
                                    $("#ajax-loading").attr("style", "display:none");
  });
}
</script>
