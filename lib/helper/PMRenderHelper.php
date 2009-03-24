<?php use_helper("Form"); ?>

<?php

  function renderJobListView($job){
  	?>
  	 <div class="job-list-item" style="padding-bottom:7px;">
  
	   <table class="status<?php echo $job->getStatusId(); ?>" cellpadding="4"/>
	     <tr>
		<td rowspan="2"> <?php echo checkbox_tag('job-' . $job->getId(), 1, 0); ?> </td>
		<td> <span class="names">Job:</span> <?php echo $job->getId(); ?> </td>
		<td> <span class="names">Shoot Date: </span><?php echo $job->getDate(); ?> </td>
		<td> <span class="names">Time:</span> <?php echo $job->getStartTime() . "-" . $job->getEndTime(); ?> </td>
	     
	        <td> <span class="names">Slug: </span> ??? </td>
		<td> <span class="names">Photographer: </span>??? </td>
		<td> <span class="names">Due Date:</span> <?php echo $job->getDueDate(); ?> </td>
	     </tr>
	   </table>

  	 </div>
  	<?php 
  }
?>