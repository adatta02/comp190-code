<?php use_helper("Form"); ?>

<div id="login-container">
  <div id='box'>
    <h3>For security, please re-enter your password:</h3> <br/>
    <div id="loading" style="display: none">Loading...</div> 
    <div id="login-form">
      <form id="sfguard-login" onsubmit="sfguardLogin(); return false;" 
            action="<?php echo url_for('@load_photoshelter_form') ?>" method="post">
	    <table>
	      <?php echo $form["password"]->renderRow(); ?>
	    </table>
	  <input type="submit" value="sign in" />
	  </form>
	  
	  <br />
	  <?php echo link_to("Return to homepage", "homepage") ?>
  </div>
</div>
<div id="ps-form"></div>
<div id="ps-result"></div>
</div>


<script type="text/javascript">

  function sfguardLogin(){
    $("#loading").show();
    
    $("#login-form").load($("#login-form form").attr("action"),
                          {"password": $("#signin_password").val()});
  }

</script>