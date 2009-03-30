<?php use_helper("Form"); ?>

<?php

  function renderJobListView($job, $classNum){
  	?>
  	 <div class="job-list-item-<?php echo $classNum ?>"
	   <?php
 	      $sTime = $job->getStartTime();
	      $eTime = $job->getEndTime();
	      $sTime = substr($sTime, -8, 5);
	      $eTime = substr($eTime, -8, 5);
	   ?>
             <table id="job-table" width="100%">
	     <col width="4%"></col>
	     <col width="30%"></col> 
	     <col width="33%"></col>
	     <col width="33%"></col>
	      <tr>
		   <td rowspan="2">
                     <?php echo checkbox_tag('job-' . $job->getId(), $job->getId(), 0, array("class" => "job-check")); ?> 
		   </td>
		   <td> Job  <?php echo $job->getId(); ?> </td>
		   <td>
                    <?php
            	       if($job->getProjectId()){
                           $title = $job->getProject()->getName();
                	    $title = ( substr($title, 0, 30) == $title ) ? $title : substr($title, 0, 30) . "..." ;
             		      echo link_to($title, "project_view", $job->getProject());
             		}
                     ?>
		   </td>
		   <td> <?php echo $job->getEvent(); ?> </td>
               </tr>
	       <tr>
		   <td> <?php echo $job->getDate("F d, Y") . " " .  $sTime . " - " . $eTime ?> </td> 
		   <td>Tags: [tags here]</td>
		    <td align="center">
		     <?php 
		        if($job->getProjectId()){
			?>
			   <img src="../../web/css/images/header_left.jpg" />
			<?php
			} 
	              ?>
		   </td>
   	   	</tr>
	     </table>
  	 </div>
  	<?php 
  }
?>