<script type="text/javascript">
  ProjectManager.sortUrls = <?php echo $sortUrlJson; ?>;
  ProjectManager.currentKey = "<?php echo $sortedBy; ?>";
  ProjectManager.isInverted = <?php echo ($invert ? 1 : 0) ?>;
  
  ProjectManager.reloadFunction = "reloadByProject";
  ProjectManager.reloadParam = "<?php echo $project->getId(); ?>";
  
  ProjectManager.removeJobTagUrl = "<?php echo url_for ( "job_remove_tag" );?>";
  ProjectManager.addJobTagUrl = "<?php echo url_for ( "job_add_tag" );?>";
  ProjectManager.moveJobUrl = "<?php echo url_for("job_move"); ?>";
</script>

<div class="span-6">
  <?php include_component ( "static", "shortcuts", 
                            array("sortedBy" => $sortedBy, 
                                  "viewingCurrent" => null) ); ?>
</div>

<div class="span-17 last">
  <div class="box" id="list-container">
  
  <?php include_partial("job/renderList", 
                        array("pager" => $pager,
                              "viewingCaption" => " project " . $project->getName(),
                              "object" => $project->getSlug(),
                              "propelType" => "slug",
                              "route" => "project_view",
                              "renderStatus" => true)); ?>
  </div>
</div>