<?php use_helper("Url"); ?>
<script type="text/javascript">
  $("#loading").html("Building photoshelter credentials...");
  $("#ps-form").load("<?php echo url_for("load_photoshelter_form"); ?>", 
                          {username: $("#signin_username").val(),
                          password:  $("#signin_password").val()});
</script>