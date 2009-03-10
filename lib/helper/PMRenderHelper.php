<?php use_helper("Form"); ?>

<?php

  function renderJobListView($job){
  	?>
  	 <div class="job-list-item">
  	   <?php echo checkbox_tag('job-' . $job->getId(), 1, 0); ?> |
  	   <?php echo $job->getId(); ?> 
  	   <?php echo $job->getStatus()->getState(); ?>
  	   <?php echo $job->getEvent(); ?>
  	 </div>
  	<?php 
  }
?>