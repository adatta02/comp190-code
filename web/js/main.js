var ProjectManager = new Object();
ProjectManager.NONE = 1;
ProjectManager.ALL = 2;
ProjectManager.TOGGLE = 3;
ProjectManager.item2OldColor = null;
ProjectManager.item1OldColor = null;
ProjectManager.mouseOverColor = "#8bb2d1";

function copyClient(){
  $("#requestjob_contact_name").val( $("#requestjob_name").val() );
  $("#requestjob_contact_email").val( $("#requestjob_email").val() );
  $("#requestjob_contact_phone").val( $("#requestjob_phone").val() );
}

function diffNotes(jobId, originalDiff){
  var obj = new Object();
  obj.noteDiffId = $("input:checked").val();
  obj.jobId = jobId;
  
  $("#ajax-loading").show();
  $("#diff-result").load(ProjectManager.diffNotesUrl, 
                          obj, function(){ $("#ajax-loading").hide() });
}

function saveInternalNotes(){
  var queryString = $("#internal-notes-form").serialize();
  var postTo = $("#internal-notes-form").attr("action");
  
  $("#ajax-loading").show();
  $.post( postTo, queryString, 
          function(data){ $("#job-internal-notes").html(data); $("#ajax-loading").hide(); });
}

function saveBasicInfo(){
  var queryString = $("#basic-info-form").serialize();
  var postTo = $("#basic-info-form").attr("action");
  
  $("#ajax-loading").show();
  $.post( postTo, queryString, function(data){ $("#job-basic-info").html(data); $("#ajax-loading").hide(); });
}

function saveClientInfo(){
    var queryString = $("#info-form").serialize();
    var postTo = $("#info-form").attr("action");

    $("#ajax-loading").show();
    $.post( postTo, queryString, function(data){ $("#client-info").html(data); $("#ajax-loading").hide(); });
}

function savePhotographerInfo(){
    var queryString = $("#info-form").serialize();
    var postTo = $("#info-form").attr("action");

    $("#ajax-loading").show();
    $.post( postTo, queryString, function(data){ $("#photographer-info").html(data); $("#ajax-loading").hide(); });
}

function saveShootInfo(){
  var queryString = $("#shoot-info-form").serialize();
  var postTo = $("#shoot-info-form").attr("action");
  
  $("#ajax-loading").show();
  $.post( postTo, queryString, function(data){ $("#job-shoot-info").html(data); $("#ajax-loading").hide(); });
}

function savePhotographyInfo(){
  var queryString = $("#photography-info-form").serialize();
  var postTo = $("#photography-info-form").attr("action");
  
  $("#ajax-loading").show();
  $.post( postTo, queryString, function(data){ $("#job-photogrpahy-info").html(data); $("#ajax-loading").hide(); });
}

function saveBillingInfo(){
  var queryString = $("#billing-info-form").serialize();
  var postTo = $("#billing-info-form").attr("action");

  $("#ajax-loading").show();
  $.post( postTo, queryString, function(data){ $("#job-billing-info").html(data); $("#ajax-loading").hide(); });
}

function showProjectCreate(){
  $("#create-project-form").show();
}

function createProject(){

  if( new String($("#project-name").val()).length >= 45 ){
    alert("The project name is to long!");
    return;
  }

  $("#ajax-loading").show();
  $("#create-project-form").hide();
  
  $("#project-name").load(ProjectManager.createProjectUrl, 
                          {name: $("#project-name").val()},
                          function(){ $("#ajax-loading").hide(); alert("Project Created!"); });
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

function removeClientFromJob(clientId){
  var obj = new Object();
  obj.clientId = clientId;
  obj.viewingJobId = ProjectManager.viewingJobId;
  
  tb_remove();
  
  $("#ajax-loading").show();
  $("#job-client-list").load(ProjectManager.removeClientFromJob, 
                              {obj: $.toJSON(obj)},
                              function(){ $("#ajax-loading").hide(); });
}

function addClientToJob(){
  var obj = new Object();
  obj.clientId = $("#add-client-id").val();
  obj.viewingJobId = ProjectManager.viewingJobId;
  
  tb_remove();
  
  $("#ajax-loading").show();
  $("#job-client-list").load(ProjectManager.addClientToJobUrl, 
                              {obj: $.toJSON(obj)},
                              function(){ $("#ajax-loading").hide(); });
}

function addPhotographerToJob(){
  var obj = new Object();
  obj.photographerId = $("#add-photographer-id").val();
  obj.viewingJobId = ProjectManager.viewingJobId;
  
  tb_remove();
  
  $("#ajax-loading").show();
  $("#job-photographer-list").load(ProjectManager.addPhotographerToJobUrl, 
                              {obj: $.toJSON(obj)},
                              function(){ $("#ajax-loading").hide(); });
}

function removePhotographerFromJob(photographerId){
  var obj = new Object();
  obj.photographerId = photographerId;
  obj.viewingJobId = ProjectManager.viewingJobId;
  
  tb_remove();
  
  $("#ajax-loading").show();
  $("#job-photographer-list").load(ProjectManager.removePhotographerFromJobUrl, 
                              {obj: $.toJSON(obj)},
                              function(){ $("#ajax-loading").hide(); });
}

function removeJobTag(jobId, tagVal){
  
  if(ProjectManager.isViewingJob){
    var obj = new Object();
    obj.jobId = jobId;
    obj.tagVal = tagVal;
    obj.viewingJob = true;
    
    $("#ajax-loading").show();
    $("#job-basic-info").load(ProjectManager.removeJobTagUrl, 
                              {obj: $.toJSON(obj)},
                                function(){ 
                                  $("#ajax-loading").hide(); 
                                });
    return;
  }
  
  
  var obj = new Object();
  obj.jobId = jobId;
  obj.tagVal = tagVal;
  
  obj = setRouteProperties(obj);
  
  $("#ajax-loading").show();
  $("#list-container").load(ProjectManager.removeJobTagUrl, 
                              {obj: $.toJSON(obj)},
                              function(){ $("#ajax-loading").hide(); });
}

function addToProject(){
  var jobs = new Array();
  $(".job-check:checked").each( function(){ jobs.push( $(this).val() ); });
  
  if(jobs.length == 0)
    return;
  
  var obj = new Object();
  obj = setRouteProperties(obj);
  
  obj.jobs = jobs;
  obj.addProjectId = $("#add-project-id").val();
  obj.projectName = $("#project-name").val();
  obj.createNew = $("#project-create-new").attr("checked");
  obj.removeFromProject = $("#project-create-remove").attr("checked");
  
  tb_remove();
  
  $("#ajax-loading").show();
  $("#list-container").load(ProjectManager.addJobsToProjectUrl, 
                              {obj: $.toJSON(obj)},
                              function(){ $("#ajax-loading").hide(); });
}

function addJobTag(jobId){

  if(ProjectManager.isViewingJob){
    
    var obj = new Object();
    obj.jobs = new Array();
    obj.jobs.push(jobId);
    obj.tags = $("#add-tag-val").val();
    obj.viewingJob = true;
    
    $("#ajax-loading").show();
    $("#job-basic-info").load(ProjectManager.addJobTagUrl, 
                              {obj: $.toJSON(obj)},
                                function(){ 
                                  $("#ajax-loading").hide(); 
                              });
    return;
  }

  var jobs = new Array();
  $(".job-check:checked").each( function(){ jobs.push( $(this).val() ); });

  if(jobs.length == 0)
    return;
  
  var obj = new Object();
  obj = setRouteProperties(obj);
  
  obj.addTagId = $("#add-tag-id").val();
  obj.jobs = jobs;
  obj.tags = $("#add-tag").val();
  
  $('#add-tag-menu').hide();
  
  $("#ajax-loading").show();
  $("#list-container").load(ProjectManager.addJobTagUrl, 
                              {obj: $.toJSON(obj)},
                              function(){ $("#ajax-loading").hide(); });
}

function setRouteProperties(obj){
  obj.reloadFunction = ProjectManager.reloadFunction;
  
  if(ProjectManager.reloadParam instanceof Function){
    obj.reloadParam = ProjectManager.reloadParam();
  }else{
    obj.reloadParam = ProjectManager.reloadParam;
  }
  
  return obj;
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
        
        obj = setRouteProperties(obj);
        obj.state = $("#move-to").val();
        obj.jobs = jobs;
        
        $("#ajax-loading").show();
        $("#list-container").load(ProjectManager.moveJobUrl, 
                                  {obj: $.toJSON(obj)},
                                  function(){ $("#ajax-loading").hide(); });
    }); 
  });

function activateMouseOvers(){
  ProjectManager.item1OldColor = $(".job-list-item-1:first").css("background-color");
  ProjectManager.item2OldColor = $(".job-list-item-2:first").css("background-color");
    
  $(".job-list-item-1").mouseenter( 
        function(){  $(this).css("background-color", ProjectManager.mouseOverColor); });
  
  $(".job-list-item-1").mouseleave( 
        function(){  $(this).css("background-color", ProjectManager.item1OldColor);  });
    
  $(".job-list-item-2").mouseenter( 
        function(){  $(this).css("background-color", ProjectManager.mouseOverColor); });
  
  $(".job-list-item-2").mouseleave( 
        function(){  $(this).css("background-color", ProjectManager.item2OldColor);  });
}
  
