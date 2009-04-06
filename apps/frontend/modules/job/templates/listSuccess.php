<script type="text/javascript">
  ProjectManager.sortUrls = <?php echo $sortUrlJson; ?>;
  ProjectManager.currentKey = "<?php echo $sortedBy; ?>";
  ProjectManager.isInverted = <?php echo ($invert ? 1 : 0) ?>;
  ProjectManager.routeId = <?php echo $routeObject->getId ()?>;
  ProjectManager.tagId = -1;
  ProjectManager.projectId = -1;
  ProjectManager.removeJobTagUrl = "<?php echo url_for ( "job_remove_tag" );?>";
  ProjectManager.addJobTagUrl = "<?php echo url_for ( "job_add_tag" );?>";
  ProjectManager.moveJobUrl = "<?php echo url_for("job_move"); ?>";
</script>

<?php include_component ( "static", "topmenu", array("moveToSkip" => $routeObject) ); ?>
<?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => $sortedBy, 
                                "viewingCurrent" => $routeObject->__toString()) ); ?>

<div id="list-container">

<?php include_partial("renderList", 
                       array("pager" => $pager, 
                             "object" => $routeObject)); ?>

</div>