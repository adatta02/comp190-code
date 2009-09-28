<table>
  <tbody>
  <tr>
    <th>Name</th>
    <th>Phone</th>
    <th># Jobs</th>
  </tr>
  
<?php
use_helper("PMRender");

$count = 1;
foreach($pager->getResults() as $client){
  renderClientRow($client, ($count % 2 == 0 ? 1 : 2));
  $count += 1;
}

?>
  </tbody>
</table>

<?php include_component("static", 
                        "propelPager", 
                         array("pager" => $pager, 
                               "route" => "client_list",
                               "propelType" => "q", 
                               "object" => $q)); ?>
<script type="text/javascript">
  activateMouseOvers();
</script>