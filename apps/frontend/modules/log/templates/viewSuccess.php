<script type="text/javascript">
  
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
      Viewing log entries <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?> 
    </div>
    
    <div id="log-list">
     <?php include_partial("renderList", array("pager" => $pager)); ?>
    </div>
  
  </div>
</div>