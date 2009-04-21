<?php 
use_helper("Form");
use_helper("Url");

echo form_tag("http://pa.photoshelter.com/bsapi/custom/tuftsphotoAuth", 
              array("method" => "POST", "name" => "redirect", "id" => "redirect"));
echo input_hidden_tag("c", $encodedData);
echo input_hidden_tag("s", $encodedSignature);
?>
</form>
<script type="text/javascript">
  $("#loading").html("Redirecting to Photoshelter.com!");
  $("#redirect").submit();
</script>