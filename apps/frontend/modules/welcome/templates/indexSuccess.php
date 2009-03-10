<h2>Welcome to Photo @ Tufts.edu!</h2>
<div class="body">
  <h3>Please login using your Tufts UTLN:</h3>
  <div id="login-form">
  <form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
    <table>
      <?php echo $form ?>
    </table>
  <input type="submit" value="sign in" />
  </form>
  </div>
</div>