<?php use_helper("JavascriptBase"); ?>

<?php if(count($job->getPhotographers()) > 0): ?>
<table width="100%">

    <col width="10%"></col>
     <col width="25%"></col>
     <col width="25%"></col>
     <col width="15%"></col>
     <col width="25%"></col>

	<tr align="left">
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