<?php use_helper("JavascriptBase"); ?>

<table width="100%" id="billing-info-table">
  <tr>
    <td width="20%">Shoot Fee</td>
    <td width="80%"><?php echo "$".$job->getEstimate(); ?></td>
  </tr>
  <?php if(!(sfContext::getInstance()->getUser()->getProfile()->getUserType()->getId() 
          == sfConfig::get("app_user_type_photographer"))): ?>
  <tr>
    <td width="20%">Processing</td>
    <td width="80%"><?php echo "$".$job->getProcessing(); ?></td>
  </tr>
  <?php endif; ?>
</table>

<?php if(!is_null($form)): ?>

<form id="billing-info-form"
       action="<?php echo url_for("job_edit", array("form" => 'billing', "job_id" => $job->getId())); ?>"
       method="post">
	<table id="billing-edit-table" style="display: none">
	   <?php echo $form["estimate"]->renderRow(); ?>
	   <?php echo $form["processing"]->renderRow(); ?>
	   <tr><td><?php echo button_to_function("Save", "saveBillingInfo()"); ?>
	</table>
</form>

<?php echo link_to("Print Invoice", "job_invoice", array("slug" => $job->getSlug()), array("target" => "_blank")) ?>

<?php endif; ?>

<div id="invoice"></div>
