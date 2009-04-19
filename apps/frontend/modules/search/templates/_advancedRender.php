<?php use_helper("PMRender"); ?>
  <?php
   $count = 1;
   foreach($pager->getResults() as $i){
    renderJobListView($i, (($count % 2 == 0) ? "1" : "2"), true);
    $count += 1;
   }
  ?>
  
<?php if($pager->haveToPaginate()): ?>
  <?php
    $page = $pager->getPage();
    $pageTo = (($page + 10) < $pager->getLastPage()) ? ($page + 10) : $pager->getLastPage();
    $pageFrom = (($page - 10) > 0) ? ($page - 10) : 1; 
    
    echo link_to_function("<<", "jumpToPage(" . $pager->getFirstPage() . ")");
    for($i=$pageFrom; $i <= $pageTo; $i++){
      echo ($i == $page) ? $i : link_to_function($i, "jumpToPage(" . $i . ")");
      echo " ";
    }
    
    echo link_to_function(">>", "jumpToPage(" . $pager->getLastPage() . ")");
  ?>
<?php endif; ?>
