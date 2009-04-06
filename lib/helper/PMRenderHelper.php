<?php use_helper("Form"); 

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
  		echo "<span class='job-tag'>" . link_to($key, "job_listby_tag", array("name" => $key)) . 
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
		   <td> <?php echo $job->getDate("F d, Y") . " " .  $sTime . " - " . $eTime ?> </td> 
		   <td>Tags: <?php renderTagList($job); ?></td>

       <?php if($renderStatus): ?>
          <td align="left">
          Status:
          <?php echo $job->getStatus()->getState(); ?>
          </td>
       <?php endif; ?>
       
		   <?php if($job->getProjectId()): ?>
		   <td align="center">
			   <?php echo image_tag("css/header_left.jpg"); ?>
		   </td>
      <?php endif; ?>
      
   	   	</tr>
	     </table></div>
<?php 
  }
?>
