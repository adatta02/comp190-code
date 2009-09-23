<script type="text/javascript">
  ProjectManager.clientLiveSearchUrl = "<?php echo url_for("client_list"); ?>";
</script>

<div class="span-6">
<?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => JobPeer::DATE,
                                "noSort" => true,
                                "viewingCurrent" => null) ); ?>
</div>

<div class="span-17 last">
  <div class="box" id="list-container">
    <div id="now-viewing"> 
      Viewing all clients 
        <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?>
    </div>
    
    <div id="search-clients">
      <label for="live-search-clients">Live Search </label>
      <?php echo input_tag("live-search-clients", $q); ?>
    </div>
    
    <div id="client-list" style="display:none">
     <?php include_partial("renderList", array("pager" => $pager, "q" => $q)); ?>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(
  function(){
    $("#live-search-clients").keyup(function(){ runLiveSearch(false) });
    if(window.location.hash){
      $("#client-list").val(window.location.hash.replace("#", ""));
      runLiveSearch(true);
    }else{
      $("#client-list").show();
    }
});

function runLiveSearch(showDiv){
  
  window.location.hash = $("#live-search-clients").val();
  
  $("#ajax-loading").attr("style", "display:inline");
  $("#client-list").load(ProjectManager.clientLiveSearchUrl, 
                                {q: $("#live-search-clients").val()},
                                function() {
                                    if(showDiv){
                                      $("#client-list").show();
                                    }
                                    $("#ajax-loading").attr("style", "display:none");
  });
}
</script>
