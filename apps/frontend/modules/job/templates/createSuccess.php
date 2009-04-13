
<?php echo include_javascripts_for_form($form); ?>
<?php echo include_stylesheets_for_form($form); ?>
 
<?php include_component ( "static", "topmenu",
                          array("moveToSkip" => null, "noMenu" => true) ); ?>
<?php include_component ( "static", "shortcuts",
                          array("sortedBy" => JobPeer::DATE,
                                "noSort" => true,
                                "viewingCurrent" => null) ); ?>
<div id="list-container">
  <h2>Request a photographer:</h2>
  <h3><?php echo $form->renderGlobalErrors(); ?></h3>
  
  <form action="<?php echo url_for('@job_create') ?>" method="POST">
  <table id="formTable" cellspacing="4">
    <tr valign="top">
    <td>
    <h3>Client</h3>
    <table>
		   <tr><?php echo $form["name"]->renderRow(); ?> </tr>
		   <tr><?php echo $form["department"]->renderRow(); ?> </tr>
		   <tr><?php echo $form["address"]->renderRow(); ?> </tr>
		   <tr><?php echo $form["email"]->renderRow(); ?> </tr>
		   <tr><?php echo $form["phone"]->renderRow(); ?> </tr>
		   <tr><?php echo $form["acct_num"]->renderRow(); ?> </tr>
		   <tr><?php echo $form["dept_id"]->renderRow(); ?> </tr>
    </table>
    </td>
  <td>
    <h3>Shoot Contact</h3>
    <span>Same as client? <?php echo checkbox_tag("copy-client-info", 1, 0, array("onclick" => "javascript:copyClient();")); ?></span>
    <table>
	    <tr><?php echo $form["contact_name"]->renderRow(); ?> </tr>
	    <tr><?php echo $form["contact_email"]->renderRow(); ?> </tr>
	    <tr><?php echo $form["contact_phone"]->renderRow(); ?> </tr>
    </table>
  </td>
</tr>

<tr valign="top">
  <td>
    <h3>Shoot</h3>
    <table>
		    <tr><?php echo $form["publication_id"]->renderRow(); ?> </tr>
		    <tr><?php echo $form["event"]->renderRow(); ?> </tr>
		    <tr><?php echo $form["project_id"]->renderRow(); ?> </tr>
	      <tr><?php echo $form["date"]->renderRow(); ?> </tr>
	      <tr><td></td><td><small>If time is TBD leave blank</small></td></tr>
		    <tr><?php echo $form["start_time"]->renderRow(); ?> </tr>
		    <tr><?php echo $form["end_time"]->renderRow(); ?> </tr>
		    <tr><?php echo $form["street"]->renderRow(); ?> </tr>
		    <tr><?php echo $form["city"]->renderRow(); ?></tr>
		    <tr><td><?php echo $form["state"]->renderRow(); ?> </td>
		    <td><?php echo $form["zip"]->renderRow(); ?> </td></tr>
		    <tr><?php echo $form["due_date"]->renderRow(); ?> </tr>
      </table>
    </td>
  <td>
<h3>Photography</h3>
<table cellpadding="5">
    <tr><?php echo $form["photo_type"]->renderRow(); ?> </tr>
    <tr><?php echo $form["ques1"]->renderRow(); ?> </tr>
    <tr><?php echo $form["ques2"]->renderRow(); ?> </tr>
    <tr><?php echo $form["ques3"]->renderRow(); ?> </tr>
</table>
</td>
</tr>

<tr>
<td align="right">
    <input type="submit" value="submit" />
    <?php echo $form->renderHiddenFields(); ?>
</td>
</tr>
</table>
</form>

  </div>
</div>
