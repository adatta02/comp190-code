<?php use_helper("Form"); ?>

<div class="box centered-container">

    <h3>Please login using your Tufts UTLN:</h3>
    <form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
      <table>
        <?php echo $form ?>
        <tr>
          <td><input type="submit" value="Sign In" /></td>
        </tr>
      </table>
    </form>
    
</div>