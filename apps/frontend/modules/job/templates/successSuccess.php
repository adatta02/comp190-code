<?php if($sf_user->hasCredential("admin")) :?>
<div class="span-6">
  <?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => null, 
                                "viewingCurrent" => null,
                                "noSort" => true) ); ?>
</div>
<?php else: ?>
<div class="span-6">
  <?php include_component ( "static", "userShortcuts",
                          array("sortedBy" => null,
                                "viewingCurrent" => null,
                                "noSort" => false) ); ?>
</div>
<?php endif; ?>

<div class="span-16 box">
  <h2>Thank You! - Request Received</h2>
  Your request was successfully entered into the system. A staff member will contact you shortly regarding your photo job. 
  Thank you for your interest in University Photography.
  
  <hr class="space" />
  
  <?php echo link_to("Submit another job", "job_create"); ?>
</div>