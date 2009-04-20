<?php use_helper("Form"); ?>
<div id="login-container">
  <h2>Redirecting...</h2>
 
  <?php 
    echo form_tag("http://pa.photoshelter.com/bsapi/custom/tuftsphotoAuth", 
          array("method" => "POST", "name" => "redirect", "id" => "redirect"));
    echo input_hidden_tag("c", $encodedData);
    echo input_hidden_tag("s", $encodedSignature);
  ?>
  
</div>

<script type="text/javascript">
  $(document).ready( function(){ $("#redirect").submit(); });
</script>