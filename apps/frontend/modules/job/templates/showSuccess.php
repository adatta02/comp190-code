<?php include_component ( "static", "topmenu", array("moveToSkip" => null) ); ?>
<?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => null, 
                                "viewingCurrent" => null) ); ?>

<div id="content-container">
  <div id="now-viewing">Viewing job #<?php echo $job->getId(); ?></div>
	
	<div class="info-header">Basic Info 
	   <a href="#" onclick="javascript:$('#job-basic-info').toggle(); return false;">[tg]</a>
	</div>
	
	<div id="job-basic-info" class="collapsable">
	<a href="#basic"></a>
		<table width="100%" border="0">
		  <tr>
		    <td width="20%">Event</td>
		    <td width="80%"><?php echo $job->getEvent(); ?></td>
		  </tr>
		  <tr>
		    <td>Status</td>
		    <td><?php echo $job->getStatus()->getState(); ?></td>
		  </tr>
      <tr>
        <td>Shoot Type</td>
        <td><?php echo $job->getPhotoType() ?></td>
      </tr>
		  <tr>
		    <td>Shoot Date</td>
		    <td><?php echo $job->getPrettyShootDate() ?></td>
		  </tr>
		  <tr>
		    <td>Due Date</td>
		    <td><?php echo $job->getDueDate("F n, o"); ?></td>
		  </tr>
      <tr>
        <td>Created At</td>
        <td><?php echo $job->getCreatedAt("F n, o"); ?></td>
      </tr>
		  <tr>
		    <td>Contact</td>
		    <td><?php echo mail_to($job->getContactEmail(), $job->getContactName()) . " " . $job->getContactEmail(); ?></td>
		  </tr>
		  <tr>
		    <td>Contact Phone</td>
		    <td><?php echo $job->getContactPhone() ?></td>
		  </tr>
      <tr>
        <td>Publication</td>
        <td>
          <?php if($job->getPublication()) 
                  echo $job->getPublication()->getName();
                else
                  echo "None"; 
          ?>
       </td>
      </tr>
		</table>
	</div>
	
	<div class="info-header">Shoot Info 
     <a href="#" onclick="javascript:$('#job-shoot-info').toggle(); return false;">[tg]</a>
  </div>
  
	<div id="job-shoot-info" class="collapsable">
	 <a href="#shoot"></a>
	 
	 <table>
	   <tr>
	     <td class="shoot-datetime">Shoot Date</td>
	     <td class="shoot-datetime"><?php echo $job->getPrettyShootDate(); ?></td>
	   </tr>
	   <tr>
	     <td>Shoot Address</td>
	     <td><?php echo $job->getPrettyAddress(); ?></td>
	   </tr>
	 </table>
	 
	 MAP GOES HERE!
	 
	</div>
	
</div>

