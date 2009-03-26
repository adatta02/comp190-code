var ProjectManager = new Object();
ProjectManager.NONE = 1;
ProjectManager.ALL = 2;
ProjectManager.TOGGLE = 3;


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