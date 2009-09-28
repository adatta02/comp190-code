<?php use_helper("JavascriptBase"); ?>

<?php if(count($job->getClients())): ?>

<table width="100%">
	<col width="10%"></col>
	<col width="25%"></col>
	<col width="25%"></col>
	<col width="15%"></col>
	<col width="25%"></col>

	<tr align="left">
		<th><?php if( $sf_user->hasCredential("admin")){ ?>Remove <?php } ?></th>
		<th>Name</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Department</th>
	</tr>
       <?php foreach($job->getClients() as $c): ?>
       <tr>
		<td>
		  <?php
		    if( $sf_user->hasCredential("admin")){ 
		      echo link_to_function(
		          image_tag("delete.png", array("class" => "plus-img")), 
		          "removeClientFromJob(" . $c->getId() . ")");
		    } 
        ?>
	  </td>
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
