<?php use_helper("JavascriptBase"); ?>

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
		<td>
		  <?php 
		    echo link_to_function(
		          image_tag("delete.png", array("class" => "plus-img")), 
		          "removeClientFromJob(" . $c->getId() . ")"); ?>
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