<?php use_helper("Url"); ?>

<?php if($pager->haveToPaginate()): ?>

<?php
    $page = $pager->getPage();
    $pageTo = (($page + 10) < $pager->getLastPage()) ? ($page + 10) : $pager->getLastPage();
    $pageFrom = (($page - 10) > 0) ? ($page - 10) : 1; 
    
    echo link_to("<<", $url, array( "page" => $pager->getFirstPage() ));
    for($i=$pageFrom; $i <= $pageTo; $i++){
      echo ($i == $page) ? $i : link_to($i, $url, array( "page" => $i ));
      echo " ";
    }
    echo link_to(">>", $url, array("page" => $pager->getLastPage()));

?>
<?php endif; ?>