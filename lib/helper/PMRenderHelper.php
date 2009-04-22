<?php 
use_helper("Form"); 
use_helper("JavascriptBase");

function GoogleMapsInclude(){
	$key = sfConfig::get("app_gmap_key");
	return '<script 
          src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=' 
	        . $key . '"
	        type="text/javascript"></script>';
}

  function renderLog($log, $classNum){
  ?>
     <div class="job-list-item-<?php echo $classNum ?>">
       <table class="job-table" width="100%">
          <col width="32%"></col>
          <col width="36%"></col>
          <col width="32%"></col>
        <tr>
           <td><?php echo $log->getWhen("F j, Y"); ?></td>
           <td><?php echo $log->getMessageType()->getType(); ?></td>
           <td><?php echo $log->getMessage(); ?></td>
           <td><?php echo $log->getUser()->getUserName(); ?></td>
         </tr>
         <tr>
          <td></td>
         </tr>
       </table>
     </div>
  <?php 
  }

  function renderClient($client, $classNum){
  ?>
     <div class="job-list-item-<?php echo $classNum ?>">
       <table class="job-table" width="100%">
          <col width="32%"></col>
          <col width="36%"></col>
          <col width="32%"></col>

	 <tr>
           <td><?php echo link_to($client->getName(), "client_view", $client); ?></td>
           <td><?php echo mail_to($client->getEmail() , $client->getEmail()); ?></td>
         </tr>
         <tr>
          <td><?php echo $client->getDepartment() ?></td>
          <td><?php echo $client->getPhone(); ?></td>
          <td align="center"><?php echo link_to($client->getNumberOfJobs() . " jobs", "client_view_jobs", array("slug" => $client->getSlug())); ?>
        </tr>
       </table>
     </div>
  <?php 
  }

  function renderPhotographer($photographer, $classNum){
  ?>
     <div class="job-list-item-<?php echo $classNum ?>">
       <table class="job-table" width="100%">
          <col width="32%"></col>
          <col width="36%"></col>
          <col width="32%"></col>
         <tr>
           <td><?php echo link_to($photographer->getName(), "photographer_view", $photographer); ?></td>
           <td><?php echo mail_to($photographer->getEmail() , $photographer->getEmail()); ?></td>
         </tr>
         <tr>
          <td><?php echo $photographer->getAffiliation() ?></td>
          <td><?php echo $photographer->getPhone(); ?></td>
          <td align="center"><?php echo link_to($photographer->getNumberOfJobs() . " jobs", 
                                  "photographer_view_jobs", 
                                  $photographer) ?></td>
        </tr>
       </table>
     </div>
  <?php 
  }

  function renderProject($project, $classNum){
  	?>
  	 <div class="job-list-item-<?php echo $classNum ?>">
  	   <table class="job-table" width="100%">
  	     <tr><td>
  	       <?php echo link_to($project->getName(), "project_view", $project); ?>
  	     </td></tr>
  	     <tr><td>Contains <?php echo $project->getNumberOfJobs(); ?> jobs</td></tr>
  	   </table>
  	 </div>
  	<?php
  }

  function renderTagList($job){
  	$tags = $job->getTags();
  	
  	foreach($tags as $key => $val){
  		echo "<span class='job-tag'>" . link_to($key, "job_listby_tag", array("slug" => $key)) . 
  		      " <a onclick='javascript:removeJobTag(\"" . $job->getId() . "\", \"" . $key . "\");' href='#'>" 
  		      . image_tag("delete.png", array("class" => "delete-img")) . "</a></span>";
  	}
  	
  }

  function renderJobListView($job, $classNum, $renderStatus = false){
  	?>
<div class="job-list-item-<?php echo $classNum ?>">
	<?php
 	      $sTime = $job->getStartTime();
	      $eTime = $job->getEndTime();
	      $sTime = substr($sTime, -8, 5);
	      $eTime = substr($eTime, -8, 5);
	   ?>
	<table class="job-table" width="100%">
	     <col width="4%"></col>
	     <col width="30%"></col> 
	     <col width="33%"></col>
	     <col width="33%"></col>
	      <tr>
		   <td rowspan="2">
        <?php echo checkbox_tag('job-' . $job->getId(), $job->getId(), 0, array("class" => "job-check")); ?> 
		   </td>
		   <td>Job <?php echo link_to($job->getId(), "job_show", $job); ?></td>
		   <td>
         <?php echo $job->getEvent(); ?>
		   </td>
		   <td>       
		  <?php
        if($job->getProjectId()){
          $title = $job->getProject()->getName();
          $title = ( substr($title, 0, 30) == $title ) ? $title : substr($title, 0, 30) . "..." ;
          echo link_to($title, "project_view", $job->getProject());
        } ?> 
       </td>
               </tr>
	       <tr>
		   <td> <?php echo $job->getDate("F j, Y") . " " .  $sTime . " - " . $eTime ?> </td> 
		   <td>Tags: <?php renderTagList($job); ?></td>

       <?php if($renderStatus): ?>
          <td align="left">
          Status:
          <?php echo $job->getStatus()->getState(); ?>
          </td>
       <?php endif; ?>
       
		   <?php
		    $photogs = $job->getPhotographers(); 
		    if(count($photogs) == 1):
		    
			 foreach($photogs as $i){ ?>
		   	 <td>
			     <?php echo link_to($i, "photographer_view_jobs", $i) . " "; ?>
		   	 </td>
		   <?php 
		         }
		      elseif(count($photogs) == 0): ?>
		           <td> <?php echo "No Photographer"; ?> </td>
		      <?php else: 
		    ?>
		        <td> <?php echo count($photogs) . " Photographers"; ?> </td>
			   
		   <?php endif; ?>
      
   	   	</tr>
	     </table></div>
<?php 
  }
?>
