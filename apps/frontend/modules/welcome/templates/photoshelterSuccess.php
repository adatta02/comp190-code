<?php use_helper("Form"); ?>

<div class="span-12">
  <div class='box'>
    <h3>For security, please re-enter your password:</h3> <br/>
    <div id="loading" style="display: none">Loading...</div> 
    <div id="login-form">
      <form id="sfguard-login" onsubmit="sfguardLogin(); return false;" 
            action="<?php echo url_for('@load_photoshelter_form') ?>" method="post">
	    <table>
	      <?php echo $form["password"]->renderRow(); ?>
	    </table>
	  <input type="submit" value="Sign In" />
	  </form>
	  
	  <hr class="space" />
	  <h3><?php echo link_to("Return to homepage", "homepage") ?></h3>
  </div>
</div>
<div id="ps-form"></div>
<div id="ps-result"></div>
</div>


<script type="text/javascript">

  function sfguardLogin(){
    $("#loading").show();
    
    $("#login-form").load($("#login-form form").attr("action"), {"password": $("#signin_password").val()});
  }

</script>