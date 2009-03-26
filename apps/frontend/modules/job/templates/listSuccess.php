<?php include_component ( "static", "topmenu", array("moveToSkip" => $routeObject) ); ?>
<?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => $sortedBy, 
                                "viewingCurrent" => $routeObject->__toString()) ); ?>

<div id="list-container">

<?php include_partial("renderList", 
                      array("pager" => $pager, 
                            "object" => $routeObject)); ?>

</div>

<script type="text/javascript">

var sortUrls = <?php echo $sortUrlJson; ?>;
var currentKey = "<?php echo $sortedBy; ?>";
var isInverted = <?php echo ($invert ? 1 : 0) ?>;
var item2OldColor, item1OldColor;


function invertSort(){
  var key;
  
  if(isInverted == 1)
    key = "false";
  else
    key = "true";
  
  window.location = sortUrls[$("#sort-by-options").val()][key];
}

$(document).ready( 
  function(){
  
    item2OldColor = $(".job-list-item-2:first").css("background-color");
    item1OldColor = $(".job-list-item-1:first").css("background-color");
    
    $(".job-list-item-1").mouseover( 
        function(){  $(this).css("background-color", item2OldColor); });
  
    $(".job-list-item-1").mouseleave( 
        function(){  $(this).css("background-color", item1OldColor);  });
    
    $(".job-list-item-2").mouseover( 
        function(){  $(this).css("background-color", item1OldColor); });
  
    $(".job-list-item-2").mouseleave( 
        function(){  $(this).css("background-color",item2OldColor);  });
  

  
    // when you toggle the sort drop down change the sorting
    $("#sort-by-options").change(
      function(){
        window.location = sortUrls[$("#sort-by-options").val()]["false"];
      });
  
    // when you toggle the move-to go ahead and move the jobs
    $("#move-to").change( 
      function(){ 
        var obj = new Object();
        var jobs = new Array();
        
        if($("#move-to").val() < 1)
          return;
        
        $(".job-check:checked").each( function(){ jobs.push( $(this).val() ); });
        
        obj.render = <?php echo $routeObject->getId() ?>;
        obj.state = $("#move-to").val();
        obj.jobs = jobs;
        
        $("#ajax-loading").attr("style", "display:inline");
        $("#list-container").load("<?php echo url_for("job_move"); ?>", 
                                  {obj: $.toJSON(obj)},
                                  function(){ $("#ajax-loading").attr("style", "display:none"); });
    }); 
  });

</script>