<script type="text/javascript">
  ProjectManager.sortUrls = <?php echo $sortUrlJson; ?>;
  ProjectManager.currentKey = "<?php echo $sortedBy; ?>";
  ProjectManager.isInverted = <?php echo ($invert ? 1 : 0) ?>;
  ProjectManager.routeId = -1;
  ProjectManager.tagId = -1;
  ProjectManager.projectId = <?php echo $project->getId(); ?>;
  ProjectManager.removeJobTagUrl = "<?php echo url_for ( "job_remove_tag" );?>";
  ProjectManager.addJobTagUrl = "<?php echo url_for ( "job_add_tag" );?>";
  ProjectManager.moveJobUrl = "<?php echo url_for("job_move"); ?>";
</script>

<?php include_component ( "static", "topmenu", array("moveToSkip" => null) ); ?>
<?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => $sortedBy, 
                                "viewingCurrent" => null) ); ?>

<div id="list-container">

<?php include_partial("job/renderList", 
                      array("pager" => $pager, 
                            "object" => $project,
                            "route" => "project_view",
                            "renderStatus" => true)); ?>

</div>