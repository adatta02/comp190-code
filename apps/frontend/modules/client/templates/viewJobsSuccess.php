<script type="text/javascript">
  ProjectManager.sortUrls = <?php echo $sortUrlJson; ?>;
  ProjectManager.currentKey = "<?php echo $sortedBy; ?>";
  ProjectManager.isInverted = <?php echo ($invert ? 1 : 0) ?>;
  
  ProjectManager.reloadFunction = "reloadByClient";
  ProjectManager.reloadParam = "<?php echo $client->getId(); ?>";
  
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
  <div id="list-container" class="box">
  <?php include_partial("job/renderList", 
                        array("pager" => $pager, 
                              "object" => $client->getSlug(),
                              "propelType" => "slug",
                              "viewingCaption" => " jobs owned by " . $client->getName(),
                              "route" => "client_view_jobs",
                              "renderStatus" => true)); ?>
  </div>
</div>