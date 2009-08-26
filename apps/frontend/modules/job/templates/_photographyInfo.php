<?php use_helper("JavascriptBase"); ?>

<table width="100%" id="photography-info-table">
  <tr>
    <td width="20%">Photo Type</td>
    <td width="80%"><?php echo $job->getPhotoType(); ?></td>
  </tr>
  <tr>
     <td width="20%"> Other Info </td>
           <?php if($job->getOther()){?>
	        <td width="80%"><?php echo $job->getOther(); ?> </td>	   	  
	   <?php }else{ ?>
	   	 <td width="80%"><?php echo $job->getQues1() . "<br/>" . $job->getQues2(). "<br/>" . $job->getQues3(); ?> </td>
	   <?php }
	    ?>
  </tr>
</table>

<?php if(!is_null($form)): ?>

<form id="photography-info-form"
       action="<?php echo url_for("job_edit", array("form" => 'photography', "job_id" => $job->getId())); ?>"
       method="post">
	<table id="photography-edit-table" style="display: none">
	   <?php echo $form["photo_type"]->renderRow(); ?> 
 
	   <?php if($job->getOther()){
	   	 echo $form['other']->renderRow();
                 }else{
		   echo $form["ques1"]->renderRow();
                 echo $form["ques2"]->renderRow();
                 echo $form["ques3"]->renderRow();
		 } ?>
	   <tr><td><?php echo button_to_function("Save", "savePhotographyInfo()"); ?>
	</table>
</form>

<?php endif; ?>
