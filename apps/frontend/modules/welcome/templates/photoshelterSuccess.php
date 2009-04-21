<?php use_helper("Form"); ?>

<div id="login-container">
  <div id='box'>
    <h3>Please login using your Tufts UTLN:</h3> <br/>
    <div id="loading" style="display: none">Loading...</div> 
    <div id="login-form">
      <form id="sfguard-login" onsubmit="sfguardLogin(); return false;" 
            action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
	    <table>
	      <?php echo $form ?>
	    </table>
	  <input type="submit" value="sign in" />
	  </form>
  </div>
</div>
<div id="ps-form"></div>
<div id="ps-result"></div>
</div>


<script type="text/javascript">

  function sfguardLogin(){
    $("#loading").show();
    var r = ($("#signin_remember:checked").val() == "on" ? "on" : "");
    $("#login-form").load($("#login-form form").attr("action"), 
                            {"signin[username]": $("#signin_username").val(),
                            "signin[password]": $("#signin_password").val(),
                            "signin[remember]": r},
                           function(){
                            $("#login-form form").submit(function(){ sfguardLogin(); return false; });
                           });
  }

</script>