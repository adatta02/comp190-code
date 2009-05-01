<?php use_helper("PMRender"); ?>

<script type="text/javascript">
  ProjectManager.sortUrls = <?php echo $sortUrlJson; ?>;
  ProjectManager.currentKey = "<?php echo $sortedBy; ?>";
  ProjectManager.isInverted = <?php echo ($invert ? 1 : 0) ?>;
</script>

<?php include_component ( "static", "topmenu", array("moveToSkip" => null, "noMenu" => true) ); ?>
<?php include_component ( "static", "userShortcuts",
                          array("sortedBy" => null,
                                "viewingCurrent" => null,
                                "noSort" => false) ); ?>

<div id="content-container">
<div id="now-viewing">
  Viewing <?php echo ($own ? "My Jobs" : $showType) ?> jobs
</div>

<div id="server-msg"></div>

<?php
$count = 0;
foreach($pager->getResults() as $i){
  renderClientJobListView($i, (($count % 2 == 0) ? "1" : "2"));
  $count += 1;
}

?>

<div class="clear"></div>

<?php include_component("static", 
                        "propelPager", 
                         array("pager" => $pager, 
                               "route" => "client_myjobs",
                               "propelType" => "state", 
                               "object" => $showType)); ?>

</div>


<script type="text/javascript">
  activateMouseOvers();
  
  function addClient(jobId){
    var res = confirm("Are you sure you want to be added as a client?");
    if(res){
      $("#server-msg").load('<?php echo url_for("@request_add_job")?>', {id: jobId});
    }
  }
</script>