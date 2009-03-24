<?php use_helper("Form"); ?>

<?php

  function renderJobListView($job){
  	?>
  	 <div class="job-list-item" style="padding-top: 5px; padding-bottom: 5px">
  	   <?php echo checkbox_tag('job-' . $job->getId(), $job->getId(), 0, array("class" => "job-check")); ?> |
  	   <?php echo $job->getId(); ?>
  	   [tags here]
  	   <?php echo $job->getDate("Y-m-d") ?>
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