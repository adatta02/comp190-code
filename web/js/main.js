var ProjectManager = new Object();
ProjectManager.NONE = 1;
ProjectManager.ALL = 2;
ProjectManager.TOGGLE = 3;

function showProjectCreate(){
  $("#create-project-form").show();
}

function createProject(){

  if( new String($("#project-name").val()).length >= 45 ){
    alert("The project name is to long!");
    return;
  }

  $("#ajax-loading").attr("style", "display:inline");
  $("#create-project-form").hide();
  
  $("#project-name").load(ProjectManager.createProjectUrl, 
                          {name: $("#project-name").val()},
                          function(){ $("#ajax-loading").attr("style", "display:none"); alert("Project Created!"); });
}

function toggle(what){
  switch(what){
    case ProjectManager.NONE:
      $(".job-check").each( function(){ $(this).attr("checked", false); } );
    break;
    case ProjectManager.ALL:
      $(".job-check").each( function(){ $(this).attr("checked", true); } );
    break;
    case ProjectManager.TOGGLE:
      $(".job-check").each( 
        function(){ 
          $(this).attr("checked", ($(this).attr("checked")) ? false : true ); 
       });
    break;
    default: break;
  }
  
  return false;
}

var item2OldColor, item1OldColor;

function removeJobTag(jobId, tagVal){
  var obj = new Object();
  obj.jobId = jobId;
  obj.tagVal = tagVal;
  
  obj.render = ProjectManager.routeId;
  obj.projectId = ProjectManager.projectId;
  obj.tagId = ProjectManager.tagId;
  
  $("#ajax-loading").attr("style", "display:inline");
  $("#list-container").load(ProjectManager.removeJobTagUrl, 
                              {obj: $.toJSON(obj)},
                              function(){ $("#ajax-loading").attr("style", "display:none"); });
}

function addToProject(){
  var jobs = new Array();
  $(".job-check:checked").each( function(){ jobs.push( $(this).val() ); });
  
  if(jobs.length == 0)
    return;
  
  var obj = new Object();
  obj.render = ProjectManager.routeId;
  obj.projectId = ProjectManager.projectId;
  obj.tagId = ProjectManager.tagId;
  obj.jobs = jobs;
  obj.projectName = $("#project-name").val();
  obj.createNew = $("#project-create-new").attr("checked");
  obj.removeFromProject = $("#project-create-remove").attr("checked");
  
  tb_remove();
  
  $("#ajax-loading").attr("style", "display:inline");
  $("#list-container").load(ProjectManager.addJobsToProjectUrl, 
                              {obj: $.toJSON(obj)},
                              function(){ $("#ajax-loading").attr("style", "display:none"); });
}

function addJobTag(){

  var jobs = new Array();
  $(".job-check:checked").each( function(){ jobs.push( $(this).val() ); });

  if(jobs.length == 0)
    return;
  
  var obj = new Object();
  obj.render = ProjectManager.routeId;
  obj.projectId = ProjectManager.projectId;
  obj.tagId = ProjectManager.tagId;
  
  obj.jobs = jobs;
  obj.tags = $("#add-tag").val();
  
  $('#add-tag-menu').hide();
  
  $("#ajax-loading").attr("style", "display:inline");
  $("#list-container").load(ProjectManager.addJobTagUrl, 
                              {obj: $.toJSON(obj)},
                              function(){ $("#ajax-loading").attr("style", "display:none"); });
}

function invertSort(){
  var key;
  
  if(ProjectManager.isInverted == 1)
    key = "false";
  else
    key = "true";
  
  window.location = ProjectManager.sortUrls[$("#sort-by-options").val()][key];
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
        window.location = ProjectManager.sortUrls[$("#sort-by-options").val()]["false"];
      });
  
    // when you toggle the move-to go ahead and move the jobs
    $("#move-to").change( 
      function(){ 
        var obj = new Object();
        var jobs = new Array();
        
        if($("#move-to").val() < 1)
          return;
        
        $(".job-check:checked").each( function(){ jobs.push( $(this).val() ); });
        
        obj.render = ProjectManager.routeId;
        obj.projectId = ProjectManager.projectId;
        obj.tagId = ProjectManager.tagId;
        
        obj.state = $("#move-to").val();
        obj.jobs = jobs;
        
        $("#ajax-loading").attr("style", "display:inline");
        $("#list-container").load(ProjectManager.moveJobUrl, 
                                  {obj: $.toJSON(obj)},
                                  function(){ $("#ajax-loading").attr("style", "display:none"); });
    }); 
  });