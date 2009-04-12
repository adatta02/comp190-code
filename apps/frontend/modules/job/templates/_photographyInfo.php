<?php use_helper("JavascriptBase"); ?>

<?php echo $ques[1]; ?>
<table width="100%" id="photography-info-table">
  <tr>
    <td width="20%">Photo Type</td>
    <td width="80%"><?php echo $job->getPhotoType(); ?></td>
  </tr>
  <tr>
     <td width="20%"> Other Info </td>

          <?php if(count($ques) == 3){ ?>
           <td width="80%"><?php echo $ques[0] . "<br/>" . $ques[1] . "<br/>" . $ques[2]; ?> </td>
	   <?php } 
	   else{ ?>
	     <td width="80%"><?php echo $job->getOther(); ?> </td>
	   <?php }
	    ?>
  </tr>
</table>

<form id="photography-info-form"
       action="<?php echo url_for("job_edit", array("form" => 'photography', "job_id" => $job->getId())); ?>"
       method="post">
	<table id="photography-edit-table" style="display: none">
	   <?php echo $form["photo_type"]->renderRow(); ?> 
	   <?php if(count($ques) == 3){ 
	    	      echo $form["ques1"]->renderRow();
           	      echo $form["ques2"]->renderRow();
           	      echo $form["ques3"]->renderRow();
           	 }
           	 else{ 
		     echo $form["other"]->renderRow();
           	 } ?>

	   <tr><td><?php echo button_to_function("Save", "savePhotographyInfo()"); ?>
	</table>
</form>
