<?php use_helper("JavascriptBase"); ?>

<table width="100%" id="billing-info-table">
  <tr>
    <td width="20%">Shoot Fee</td>
    <td width="80%"><?php echo "$".$job->getEstimate(); ?></td>
  </tr>
  <tr>
    <td width="20%">Processing</td>
    <td width="80%"><?php echo "$".$job->getEstimate(); ?></td>
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

<script language="javascript">

	function GenerateInvoice(){
	var invoice = "<img src='../../../../../web/css/images/topBar.png' />"; 
	invoice += "<?php print(Date('F d,Y')); ?><br/><br/>";
	invoice += "<b>INVOICE #<?php echo $job->getId(); ?> </b><br/><br/>";
	invoice += "<b>Client (Bill to)</b><br/><br/>";
	
	invoice += "<b>Job</b><br/><br/>";
	invoice += "<?php echo 'Job #'.$job->getId().'<br/>'.$job->getEvent().'<br/> Publication <br/><br/>'.$job->getDate().'<br/>'.$job->getStartTime().' - '.$job->getEndTime().'<br/>'.$job->getPrettyAddress(); ?><br/><br/>";
	invoice += "<b>Charges</b><br/><br/>";

	invoice += "Shoot Fee: $<?php echo $job->getEstimate(); ?><br/>";
	invoice += "Processing: $<?php echo $job->getEstimate(); ?><br/>";
	invoice += "<b>TOTAL: $ </b>";
 	<!-- document.getElementById('invoice').innerHTML = invwriteoice;
	-->	

	var page = document.open('');
	page.write(invoice);
	page.close();
	}

</script>

<button type="button" onclick="GenerateInvoice()">Generate Invoice</button>
<div id="invoice"></div>
