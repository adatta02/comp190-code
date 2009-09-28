<?php use_helper("PMRender"); ?>

<div id="now-viewing"> 
  Viewing <?php echo $viewingCaption; ?>
    <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?> 
</div>

<table>
  <tbody>
    <tr>
      <th></th>
      <th>ID</th>
      <th>Tags</th>
      <th>Event</th>
      <th>Client</th>
      <th>Photographer</th>
      <th>Date</th>
    </tr>

<?php 
$route = (isset($route) ? $route : "job_list_by");
$propelType = (isset($propelType) ? $propelType : "state");
$renderStatus = (isset($renderStatus) ? $renderStatus : false);

$count = 1;
foreach($pager->getResults() as $i){
  renderJobListViewTable($i, (($count % 2 == 0) ? "1" : "2"), $renderStatus);
  $count += 1;
}

?>

  </tbody>
</table>

<?php include_component("static", 
                        "propelPager", 
                         array("pager" => $pager, 
                               "route" => $route,
                               "propelType" => $propelType, 
                               "object" => $object)); ?>
                         
<script type="text/javascript">
  activateMouseOvers();
</script>