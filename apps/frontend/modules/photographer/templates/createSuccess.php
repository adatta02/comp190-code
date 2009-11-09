<?php echo include_javascripts_for_form($InfoForm); ?>

<div class="span-6">
  <?php include_component ( "static", "shortcuts",
                          array("sortedBy" => null,
                                "viewingCurrent" => null,
                                "noSort" => true) ); ?>
</div>

<div class="span-17 last">
  <div id="content-container" class="box">
  <div id="now-viewing">
      Create photographer
  </div>
  
  <?php if($isCreate && $res): ?>
    <h3>The photographer was succesfully created!</h3>
  <?php else: ?>
  	<form id="info-form"
  	       action="<?php echo url_for("photographer_create"); ?>"
  	       method="post">
  	  <?php echo $InfoForm->renderGlobalErrors(); ?>
  	<table id="info-edit">
  	  <?php echo $InfoForm["name"]->renderRow(); ?>
  	  <?php echo $InfoForm["email"]->renderRow(); ?>
  	  <?php echo $InfoForm["reset_password"]->renderRow(); ?>
  	  <?php echo $InfoForm["password"]->renderRow(); ?>
  	  <?php echo $InfoForm["phone"]->renderRow(); ?>
  	  <?php echo $InfoForm["affiliation"]->renderRow(); ?>
  	  <?php echo $InfoForm["website"]->renderRow(); ?>
  	  <?php echo $InfoForm["billing_info"]->renderRow(); ?>
  	  <?php echo $InfoForm["description"]->renderRow(); ?>
  	  <tr><td><?php echo submit_tag("Save"); ?>
  	  <?php echo $InfoForm->renderHiddenFields(); ?>
  	  </td></tr>
  	</table>
  	</form>
  <?php endif; ?>
  </div>
</div>