<?php use_helper("PMRender"); ?>

<div id="now-viewing" style="font-size: 18px; weight: bold">
  Viewing <?php echo $showing; ?>
</div>

<div id="jobs-container" style="padding-top: 10px">

<?php foreach($pager->getResults() as $i): ?>
  <?php renderJobListView($i); ?>
<?php endforeach; ?>

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
  
    // remove whatever status we are currently viewing
    var opts = $("#move-to").children();
    for(var i=0; i < opts.length; i++){
      if(opts[i].textContent == "<?php echo $showing ?>"){
        $(opts[i]).remove();
      }
    }
    
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