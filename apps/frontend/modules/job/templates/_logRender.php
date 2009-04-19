<?php use_helper("JavascriptBase"); ?>
<table>
  <tr style="text-align: left">
    <th>Message</th>
    <th>Time</th>
    <th>Username</th>
    <th>Details</th>
  </tr>

<?php foreach($pager->getResults() as $res): ?>
  <tr>
    <td><?php echo $res->getMessageType()->getType(); ?></td>
    <td><?php echo $res->getWhen("r"); ?></td>
    <td><?php echo $res->getUser()->getUserName(); ?></td>
    <td><?php echo $res->getMessage(); ?></td>
  </tr>
<?php endforeach; ?>

</table>

<?php if($pager->haveToPaginate()): ?>
  <?php
    $page = $pager->getPage();
    $pageTo = (($page + 10) < $pager->getLastPage()) ? ($page + 10) : $pager->getLastPage();
    $pageFrom = (($page - 10) > 0) ? ($page - 10) : 1; 
    
    echo link_to_function("<<", "jumpEditHistoryToPage(" . $pager->getFirstPage() . ")");
    for($i=$pageFrom; $i <= $pageTo; $i++){
      echo ($i == $page) ? $i : link_to_function($i, "jumpEditHistoryToPage(" . $i . ")");
      echo " ";
    }
    
    echo link_to_function(">>", "jumpEditHistoryToPage(" . $pager->getLastPage() . ")");
  ?>
<?php endif; ?>