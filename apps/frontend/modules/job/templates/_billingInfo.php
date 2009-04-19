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
	
	var total = 100;

	document.open();
	document.writeln('<div style="width:800px;height:850px;border:0px;"><?php echo image_tag("topBar.png"); ?>');
	document.writeln('<p align="right" style="font-family:arial;"><b>University Relations</b><br><br>University Photography</p>');	
	document.writeln('<p><?php print(Date("F d,Y")); ?></p?');
	document.writeln('<p><b>INVOICE #<?php echo $job->getId(); ?></b></p>');
	document.writeln('<p><b>Client (Bill to)</b></p>');
	document.writeln('<p><?php foreach($job->getClients() as $i){ echo $i->getName(); ?><br>');
	document.writeln('<?php echo $i->getDepartment(); ?><br>');
	document.writeln('<?php echo $i->getAddress(); } ?><br>');
	document.writeln('<p><b>Job</b></p>');
	document.writeln('<p><?php echo "Job #".$job->getId(); ?><br>');
	document.writeln('<?php echo $job->getEvent(); ?><br>');	
	document.writeln('PUBLICATION<br></p>');
	document.writeln('<p><?php if(!is_null($job->getDate())){ echo $job->getDate("F d, Y"); } ?><br>');
	document.writeln('<?php echo $job->getStartTime().' - '.$job->getEndTime(); ?><br>');
	document.writeln('<?php echo $job->getPrettyAddress(); ?></p>');
	document.writeln('<p><b>Charges</b></p>');
	document.writeln('<p><?php foreach($job->getPhotographers() as $i){ echo $i->getName().", ".$i->getAffiliation(); } ?><br><br>');
	document.writeln('Shoot Fee: $<?php echo $job->getEstimate(); ?><br>');
	document.writeln('Processing: $<?php echo $job->getEstimate(); ?><br><br>');
	document.writeln('<b>TOTAL: $' + total + '</b></p>'); 
	document.writeln('<div><p style="font-family:arial;color:grey;float:bottom;">80 George Street, Medford, MA 02155 | TEL: 617.627.3549 | FAX: 617.627.3549</p></div></div>');		
	document.close();
	}

</script>

<button type="button" onclick="GenerateInvoice()">Generate Invoice</button>
<div id="invoice"></div>
