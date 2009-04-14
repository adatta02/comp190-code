<?php use_helper("JavascriptBase"); ?>

<script type="text/javascript">

	function Invoice(){
		var invoice = "<html><body>";
		invoice += "<img src='../../../../../web/css/images/topBar.png'></img>";
		invoice += "<?php print(Date('l F d,Y')); ?>\n\n";
		invoice += "<b>INVOICE #<?php echo $job->getId(); ?> </b>\n\n";
		invoice += "<b>Client (Bill to)</b>\n\n";
		
		invoice += "<b>Job</b>\n\n";
		invoice += "<?php echo 'Job #'.$job->getId().'\n'.$job->getEvent().'\n Publication \n\n'.$job->getDate().'\n'.$job->getStartTime().' - '.$job->getEndTime().'\n'.$job->getPrettyAddress(); ?>\n\n";
		invoice += "<b>Charges</b>\n\n";
		
		invoice += "Shoot Fee: $<?php echo $job->getEstimate(); ?>\n";
		invoice += "Processing: $<?php echo $job->getEstimate(); ?>\n";
		invoice += "<b>TOTAL: $ </b>";
		invoice += "</body></html>";
		var page = window.open('');
		page.document.write(invoice);		
		page.document.close();
	}

</script>

<table width="100%" id="billing-info-table">
  <tr>
    <td width="20%">Shoot Fee</td>
    <td width="80%"><?php echo $job->getEstimate(); ?></td>
  </tr>
  <tr>
    <td width="20%">Processing</td>
    <td width="80%"><?php echo $job->getEstimate(); ?></td>
  </tr>
  <tr>
    <td><button type="button" onclick="Invoice()">Generate Invoice</button></td>
  </tr>
</table>

<form id="billing-info-form"
       action="<?php echo url_for("job_edit", array("form" => 'billing', "job_id" => $job->getId())); ?>"
       method="post">
	<table id="billing-edit-table" style="display: none">
	   <?php echo $form["estimate"]->renderRow(); ?>
	   <?php echo $form["processing"]->renderRow(); ?>
	   <tr><td><?php echo button_to_function("Save", "saveBillingInfo()"); ?>
	</table>
</form>
