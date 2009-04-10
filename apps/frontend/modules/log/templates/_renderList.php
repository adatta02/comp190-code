<?php
use_helper("PMRender");

$count = 1;
foreach($pager->getResults() as $l){
  renderLog($l, (($count % 2 == 0) ? "1" : "2"));
  $count += 1;
}

?>

<div class="clear"></div>


<?php include_component("static", 
                        "propelPager", 
                         array("pager" => $pager, 
                               "route" => "view_log",
                               "propelType" => "", 
                               "object" => null)); ?>
<script type="text/javascript">
  activateMouseOvers();
</script>