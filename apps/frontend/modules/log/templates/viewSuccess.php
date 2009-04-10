<script type="text/javascript">
  
</script>
<?php include_component ( "static", "topmenu", 
                          array("moveToSkip" => null, "noMenu" => true) ); ?>
<?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => JobPeer::DATE,
                                "noSort" => true,
                                "viewingCurrent" => null) ); ?>
<div id="list-container">
  <div id="now-viewing"> 
    Viewing log entries <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?> 
  </div>
  
  <div id="log-list">
   <?php include_partial("renderList", array("pager" => $pager)); ?>
  </div>
  
</div>