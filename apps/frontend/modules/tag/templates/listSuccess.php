<script type="text/javascript">
  ProjectManager.sortUrls = <?php echo $sortUrlJson; ?>;
  ProjectManager.currentKey = "<?php echo $sortedBy; ?>";
  ProjectManager.isInverted = <?php echo ($invert ? 1 : 0) ?>;
  
  ProjectManager.reloadFunction = "reloadByTag";
  ProjectManager.reloadParam = "<?php echo $tag->getId(); ?>";
  
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
                            "object" => $tag->getSlug(),
                            "propelType" => "slug",
                            "viewingCaption" => " taggings for " . $tag->__toString(),
                            "route" => "job_listby_tag",
                            "renderStatus" => true)); ?>

</div>