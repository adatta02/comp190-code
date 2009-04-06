<?php use_helper("JavascriptBase"); ?>

<?php if(count($job->getPhotographers()) > 0): ?>
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
		<td><?php echo link_to_function(image_tag("delete.png", array("class" => "plus-img")), "removePhotographerFromJob(" . $ph->getId() . ")"); ?></td>
		<td><?php echo $ph->getName() ?></td>
		<td><?php echo $ph->getEmail() ?></td>
		<td><?php echo $ph->getPhone() ?></td>
		<td><?php echo $ph->getAffiliation() ?></td>
	</tr>  
     <?php endforeach; ?>
</table>
<?php else: ?>
  This job has no photographers attached to it.
<?php endif; ?>