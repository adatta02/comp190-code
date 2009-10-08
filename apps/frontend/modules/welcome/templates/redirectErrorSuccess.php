<div class="span-16 box">

  <div id="login-container">
    <h3>Sorry! There was an error logging you into Photoshelter.</h3>
    
    <hr class="space" />
    
    Please contact us at photo@tufts.edu with the following information:
    
    <hr class="space" />
    Error Class: <?php echo $error[0]["class"] ?>
    <hr class="space" />
    Error Message: <?php echo $error[0]["message"] ?>
    
    <?php echo link_to("Return home", "homepage"); ?>
  </div>

</div>