<?php use_helper("JavascriptBase"); ?>

<table width="100%" id="billing-info-table">
  <tr>
    <td width="20%">Shoot Fee</td>
    <td width="80%"><?php echo "$".$job->getEstimate(); ?></td>
  </tr>
  <tr>
    <td width="20%">Processing</td>
    <td width="80%"><?php echo "$".$job->getProcessing(); ?></td>
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
	
	<?php $shoot = $job->getEstimate();
	      $processing = $job->getProcessing();
	      $total = $shoot + $processing;
	      echo $total;
	?>

	var total = <?php echo $total; ?>;

	document.open();
	document.writeln('<div style="width:600px;height:800px;"><p style="margin-left:50px;"><?php echo image_tag("topBar.png"); ?></p>');
	document.writeln('<p align="right" style="padding-right:50px;margin-top:-30px;font-family:arial;"><b>University Relations</b><br><br>University Photography</p>');	
	document.writeln('<div style="padding-left:20px;"><p><?php print(Date("F d,Y")); ?></p?');
	document.writeln('<p><b>INVOICE #<?php echo $job->getId(); ?></b></p>');
	document.writeln('<p><b>Client (Bill to)</b></p>');
	document.writeln('<p><?php foreach($job->getClients() as $i){ echo $i->getName(); ?><br>');
	document.writeln('<?php echo $i->getDepartment(); ?><br>');
	document.writeln('<?php echo $i->getAddress(); } ?><br><br>');
	document.writeln('<p><b>Job</b></p>');
	document.writeln('<p><?php echo "Job #".$job->getId(); ?><br>');
	document.writeln('<?php echo $job->getEvent(); ?><br>');	
	document.writeln('<?php if($job->getPublicationId()){ echo $job->getPublication()->getName(); } ?><br></p>');
	document.writeln('<p><?php if(!is_null($job->getDate())){ echo $job->getDate("F d, Y"); } ?><br>');
	document.writeln('<?php echo $job->getStartTime().' - '.$job->getEndTime(); ?><br>');
	document.writeln('<?php echo $job->getPrettyAddress(); ?></p>');
	document.writeln('<p><b>Charges</b></p>');
	document.writeln('<p><?php foreach($job->getPhotographers() as $i){ echo $i->getName().", ".$i->getAffiliation(); } ?><br><br>');
	document.writeln('Shoot Fee: $<?php echo $job->getEstimate(); ?><br>');
	document.writeln('Processing: $<?php echo $job->getProcessing(); ?><br><br>');
	document.writeln('<b>TOTAL: $' + total + '</b></p></div>'); 
	document.writeln('<div style="margin-top:75px;margin-left:10px;"><p style="font-family:arial;color:grey;">80 George Street, Medford, MA 02155 | TEL: 617.627.3549 | FAX: 617.627.3549</p></div></div>');		
	document.close();
	}

</script>

<?php echo link_to("Print Invoice", "job_invoice", array("slug" => $job->getSlug()), array("target" => "_blank")) ?>
<div id="invoice"></div>
