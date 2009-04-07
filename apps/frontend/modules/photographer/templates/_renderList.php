<?php
use_helper("PMRender");

$count = 1;
foreach($pager->getResults() as $photog){
  renderPhotographer($photog, ($count % 2 == 0 ? 1 : 2));
  $count += 1;
}

?>

<div class="clear"></div>


<?php include_component("static", 
                        "propelPager", 
                         array("pager" => $pager, 
                               "route" => "photographer_list",
                               "propelType" => "q", 
                               "object" => $q)); ?>
<script type="text/javascript">
  activateMouseOvers();
</script>