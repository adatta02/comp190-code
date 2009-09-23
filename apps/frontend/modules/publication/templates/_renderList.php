<ul class="listless">
<?php
use_helper("PMRender");
$count = 1;
foreach($pager->getResults() as $proj){
	renderPublication($proj, (($count % 2 == 0) ? "1" : "2"));
	$count += 1;
}
?>
</ul>

<?php include_component("static", 
                        "propelPager", 
                         array("pager" => $pager, 
                               "route" => "manage_publications",
                               "propelType" => "", 
                               "object" => null)); ?>
<script type="text/javascript">
  activateMouseOvers();
</script>