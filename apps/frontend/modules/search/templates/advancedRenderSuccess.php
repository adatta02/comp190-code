<?php use_helper("PMRender") ?>
<?php use_helper("Url"); ?>

<script type="text/javascript">
  
  ProjectManager.reloadFunction = "reloadByAdvancedSearch";
  ProjectManager.reloadParam = function(){ return $("#advanced_search_form").serialize(); };
  
  ProjectManager.removeJobTagUrl = "<?php echo url_for ( "job_remove_tag" );?>";
  ProjectManager.addJobTagUrl = "<?php echo url_for ( "job_add_tag" );?>";
  ProjectManager.moveJobUrl = "<?php echo url_for("job_move"); ?>";
</script>

<?php include_component ( "static", "topmenu", array("moveToSkip" => null, "noMenu" => false) ); ?>
<?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => null, 
                                "viewingCurrent" => null,
                                "noSort" => true) ); ?>

<div id="advanced-search-top">
	<div id="now-viewing"> 
	  Viewing advanced search results 
	  <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?> 
	</div>
	
	<?php include_partial("advancedSearchForm", array("form" => $form)); ?>
</div>

<div id="list-container">
  <?php include_partial("advancedRender", array("pager" => $pager)); ?>
</div>

<div class="clear"></div>