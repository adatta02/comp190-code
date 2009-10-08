<script type="text/javascript">
  ProjectManager.sortUrls = <?php echo $sortUrlJson; ?>;
  ProjectManager.currentKey = "<?php echo $sortedBy; ?>";
  ProjectManager.isInverted = <?php echo ($invert ? 1 : 0) ?>;
  
  ProjectManager.reloadFunction = "reloadBySearch";
  ProjectManager.reloadParam = "<?php echo $searchBox; ?>";
  
  ProjectManager.removeJobTagUrl = "<?php echo url_for ( "job_remove_tag" );?>";
  ProjectManager.addJobTagUrl = "<?php echo url_for ( "job_add_tag" );?>";
  ProjectManager.moveJobUrl = "<?php echo url_for("job_move"); ?>";
</script>

<?php include_component ( "static", "topmenu", array("moveToSkip" => null) ); ?>

<div class="span-6">
  <?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => $sortedBy, 
                                "viewingCurrent" => null) ); ?>
</div>

<div class="span-17">

  <div class="box">
  
    <div id="list-container">
    
    <?php include_partial("job/renderList", 
                          array("pager" => $pager, 
                                "object" => $searchBox,
                                "viewingCaption" => " results for " . $searchBox,
                                "propelType" => "search-box",
                                "route" => "job_search",
                                "renderStatus" => true)); ?>
    
    </div>
  
  </div>
</div>