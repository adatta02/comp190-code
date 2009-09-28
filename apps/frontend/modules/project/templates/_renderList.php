<table>
  <tbody>
    <tr>
      <td>Name</td>
      <td># Jobs</td>
    </tr>
<?php
use_helper("PMRender");
$count = 1;
foreach($pager->getResults() as $proj){
	renderProjectTable($proj, (($count % 2 == 0) ? "1" : "2"));
	$count += 1;
}

?>
  </tbody>
</table>
<?php include_component("static", 
                        "propelPager", 
                         array("pager" => $pager, 
                               "route" => "project_list",
                               "propelType" => "", 
                               "object" => null)); ?>
<script type="text/javascript">
  activateMouseOvers();
</script>