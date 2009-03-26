<?php use_helper("Form"); ?>

<?php

  function renderJobListView($job, $classNum){
  	?>
  	 <div class="job-list-item-<?php echo $classNum ?>">
  	   <?php echo checkbox_tag('job-' . $job->getId(), $job->getId(), 0, array("class" => "job-check")); ?> |
  	   <?php echo $job->getId(); ?>
  	   [tags here]
  	   <?php echo $job->getDate("Y-m-d") ?> 
  	   <br/>
  	   <?php echo $job->getEvent(); ?>
  	   <?php  
  	     if($job->getProjectId()){
  	     	 $title = $job->getProject()->getName();
  	     	 $title = ( substr($title, 0, 30) == $title ) ? $title : substr($title, 0, 30) . "..." ;
  	       echo " | " . link_to($title, "project_view", $job->getProject());
  	     }
  	   ?>
  	 </div>
  	<?php 
  }
?>