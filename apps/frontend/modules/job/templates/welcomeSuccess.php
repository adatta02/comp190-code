<script type="text/javascript">
  ProjectManager.sortUrls = <?php echo $sortUrlJson; ?>;
  ProjectManager.currentKey = "<?php echo $sortedBy; ?>";
  ProjectManager.isInverted = <?php echo ($invert ? 1 : 0) ?>;
  
  ProjectManager.reloadFunction = "reloadByWelcome";
  ProjectManager.reloadParam = "";
  
  ProjectManager.removeJobTagUrl = "<?php echo url_for ( "job_remove_tag" );?>";
  ProjectManager.addJobTagUrl = "<?php echo url_for ( "job_add_tag" );?>";
  ProjectManager.moveJobUrl = "<?php echo url_for("job_move"); ?>";
</script>

<?php include_component ( "static", "topmenu", array("moveToSkip" => null) ); ?>

<div class="span-6">
<?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => $sortedBy, 
                                "viewingCurrent" => "Active") ); ?>
</div>

<div class="span-17 last">
  <div class="box" id="list-container">

  <?php include_partial("renderList", 
                       array("pager" => $pager,
                             "viewingCaption" => "Active Jobs", 
                             "object" => null,
                             "renderStatus" => true)); ?>
  </div>                        
</div>