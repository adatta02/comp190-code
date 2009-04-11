<?php use_helper("JavascriptBase"); ?>

<table width="100%" id="shoot-info-table">
  <tr>
    <td width="20%">Shoot Address</td>
    <td width="80%"><?php echo $job->getPrettyAddress(); ?></td>
  </tr>
</table>

<form id="shoot-info-form"
       action="<?php echo url_for("job_edit", array("form" => 'shoot', "job_id" => $job->getId())); ?>"
       method="post">
	<table id="shoot-edit-table" style="display: none">
	   <?php echo $form["street"]->renderRow(); ?>
	   <?php echo $form["city"]->renderRow(); ?>
	   <?php echo $form["state"]->renderRow(); ?>
	   <?php echo $form["zip"]->renderRow(); ?>
	   <tr><td><?php echo button_to_function("Save", "saveShootInfo()"); ?>
	</table>
</form>

<div id="job-map">MAP GOES HERE!</div>
