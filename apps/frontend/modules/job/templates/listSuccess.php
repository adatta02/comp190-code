<?php use_helper("PMRender"); ?>

<?php include_component ( "static", "topmenu", array("moveToSkip" => $routeObject) ); ?>
<?php include_component ( "static", "shortcuts", array("sortByCurrent" => "", "viewingCurrent" => $showing) ); ?>

<div id="list-container">

<div id="now-viewing"> Viewing <?php echo $showing; ?> </div>

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
                                "object" => $routeObject)); ?>

</div>

<script type="text/javascript">

$(document).ready( 
  function(){
    
    // when you toggle the move-to go ahead and move the jobs
    $("#move-to").change( 
      function(){ 
        var obj = new Object();
        var jobs = new Array();
        $(".job-check:checked").each( function(){ jobs.push( $(this).val() ); });
        
        obj.state = $("#move-to").val();
        obj.jobs = jobs;
        
        
    }); 
  });

</script>