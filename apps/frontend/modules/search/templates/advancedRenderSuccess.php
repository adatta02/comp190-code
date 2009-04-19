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

<div id="list-container">
  <?php include_partial("advancedSearchForm", array("form" => $form)); ?>
  
	<div id="now-viewing"> 
	  Viewing advanced search results 
	  <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?> 
	</div>
	
	<?php
	 $count = 1;
	 foreach($pager->getResults() as $i){
	  renderJobListView($i, (($count % 2 == 0) ? "1" : "2"), true);
	  $count += 1;
	 }
	?>
	
<?php if($pager->haveToPaginate()): ?>
  <?php
    $page = $pager->getPage();
    $pageTo = (($page + 10) < $pager->getLastPage()) ? ($page + 10) : $pager->getLastPage();
    $pageFrom = (($page - 10) > 0) ? ($page - 10) : 1; 
    
    echo link_to_function("<<", "jumpToPage(" . $pager->getFirstPage() . ")");
    for($i=$pageFrom; $i <= $pageTo; $i++){
      echo ($i == $page) ? $i : link_to_function($i, "jumpToPage(" . $i . ")");
      echo " ";
    }
    
    echo link_to_function(">>", "jumpToPage(" . $pager->getLastPage() . ")");
  ?>
<?php endif; ?>
	
	<div class="clear"></div>
  
</div>