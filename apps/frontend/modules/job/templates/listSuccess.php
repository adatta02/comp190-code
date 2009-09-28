<script type="text/javascript">
  ProjectManager.sortUrls = <?php echo $sortUrlJson; ?>;
  ProjectManager.currentKey = "<?php echo $sortedBy; ?>";
  ProjectManager.isInverted = <?php echo ($invert ? 1 : 0) ?>;
  
  ProjectManager.reloadFunction = "reloadByState";
  ProjectManager.reloadParam = "<?php echo $routeObject->getId ()?>";
  
  ProjectManager.removeJobTagUrl = "<?php echo url_for ( "job_remove_tag" );?>";
  ProjectManager.addJobTagUrl = "<?php echo url_for ( "job_add_tag" );?>";
  ProjectManager.moveJobUrl = "<?php echo url_for("job_move"); ?>";
</script>

<?php include_component ( "static", "topmenu", array("moveToSkip" => $routeObject) ); ?>

<div class="span-6">
  <?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => $sortedBy, 
                                "viewingCurrent" => $routeObject->__toString()) ); ?>
</div>

<div class="span-17 last job-container">
  <div class="box" id="list-container">
  <?php include_partial("renderList", 
                       array("pager" => $pager,
                             "viewingCaption" => $routeObject->__toString(), 
                             "object" => $routeObject)); ?>
  </div>
</div>