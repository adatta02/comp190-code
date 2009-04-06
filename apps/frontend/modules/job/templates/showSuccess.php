<?php include_component ( "static", "topmenu", array("moveToSkip" => null) ); ?>
<?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => null, 
                                "viewingCurrent" => null) ); ?>

<div id="content-container">
  <div id="now-viewing">Viewing job #<?php echo $job->getId(); ?></div>
	
	<div class="info-header">Basic 
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
		    <td><?php echo mail_to($job->getContactEmail(), $job->getContactName()) . " &lt;" . $job->getContactEmail(); ?>&gt;</td>
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
      <tr>
       <td>Tags</td>
       <td>
        <?php foreach($job->getTags() as $tag): ?>
          
        <? endforeach; ?>
       </td>
      </tr>
		</table>
	</div>
	
	<hr/>
	
	<div class="info-header">Shoot 
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
	 
	 <div id="job-map">MAP GOES HERE!</div>
	 
	</div>
	
	 <hr/>
	
  <div class="info-header">Clients 
     <a href="#" onclick="javascript:$('#job-client-info').toggle(); return false;">[tg]</a>
  </div>
	
	<div id="job-client-info" class="collapsable">
	 <div class="info-header-small">Current Clients: <?php echo image_tag("add.png"); ?></div>
	 
	 <?php if(count($job->getClients())): ?>
	 
	 <table>
     <tr>
       <th>Remove</th>
       <th>Name</th>
       <th>Email</th>
       <th>Phone</th>
       <th>Department</th>
     </tr>
     <?php foreach($job->getClients() as $c): ?>
     <tr>
       <td><?php echo image_tag("delete.png"); ?></td>
       <td><?php echo $c->getName() ?></td>
       <td><?php echo $c->getEmail() ?></td>
       <td><?php echo $c->getPhone() ?></td>
       <td><?php echo $c->getDepartment() ?></td>
     </tr>  
     <?php endforeach; ?>
    </table>
  <?php else: ?>
    There are no clients attached to this job.
  <?php endif; ?>
	</div>
	
  <hr/>
	
	<div class="info-header">Photographers 
     <a href="#" onclick="javascript:$('#job-photographer-info').toggle(); return false;">[tg]</a>
  </div>
  
  <div id="job-photographer-info" class="collapsable">
   <div class="info-header-small">Current Photographers: <?php echo image_tag("add.png"); ?></div>
	  <table>
	   <tr>
	     <th>Remove</th>
	     <th>Name</th>
	     <th>Email</th>
	     <th>Phone</th>
	     <th>Affiliation</th>
	   </tr>
	   
	   <?php foreach($job->getPhotographers() as $ph): ?>
	   <tr>
	     <td><?php echo image_tag("delete.png"); ?></td>
       <td><?php echo $ph->getName() ?></td>
       <td><?php echo $ph->getEmail() ?></td>
       <td><?php echo $ph->getPhone() ?></td>
       <td><?php echo $ph->getAffiliation() ?></td>
     </tr>  
	   <?php endforeach; ?>
	   
	  </table>
  </div>
	
	<hr />
	
	<div class="info-header">Billing and Delivery 
     <a href="#" onclick="javascript:$('#job-billing-info').toggle(); return false;">[tg]</a>
  </div>
  
  <div id="job-billing-info" class="collapsable">
    
  </div>
	
</div>

