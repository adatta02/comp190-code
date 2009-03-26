<?php use_helper("PMRender"); ?>

<div id="now-viewing"> 
  Viewing <?php echo $object; ?> <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?> 
</div>

<?php 
$count = 1;
foreach($pager->getResults() as $i){
  renderJobListView($i, (($count % 2 == 0) ? "1" : "2"));
  $count += 1;
} 
?>

<div class="clear"></div>

<?php include_component("static", 
                        "propelPager", 
                         array("pager" => $pager, 
                               "route" => "job_list_by",
                               "propelType" => "state", 
                               "object" => $object)); ?>