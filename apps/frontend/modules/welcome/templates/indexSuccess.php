<?php use_helper("Form"); ?>
<div id="login-container">
  <div id='box'>
    <h3>Please login using your Tufts UTLN:</h3> <br/>
  <div id="login-form">
  <form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
    <table>
      <?php echo $form ?>
    </table>
  <input type="submit" value="sign in" />
  </form>
  </div>
</div>
</div>