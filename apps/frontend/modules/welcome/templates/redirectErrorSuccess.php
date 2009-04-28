<div id="login-container">
  <h3>Sorry! There was an error logging you into Photoshelter.</h3>
  <p>Please contact us at staff@photo.tufts.edu with the following information: <br/>
  Error Class: <?php echo $error[0]["class"] ?> <br />
  Error Message: <?php echo $error[0]["message"] ?>
  </p>
  <?php echo link_to("Return home", "homepage"); ?>
</div>