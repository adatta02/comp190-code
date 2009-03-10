<?php use_helper("Url"); ?>

<?php if($pager->haveToPaginate()): ?>

<?php
    echo link_to("<<", $url . "&page=" . $pager->getFirstPage());
    for($i=1; $i <= $pager->getLastPage(); $i++){
      echo ($i == $page) ? $i : link_to($i, $url . "&page=" . $i);
      echo " ";
    }
    echo link_to(">>", $url . "&page=" . $pager->getLastPage());

?>
<?php endif; ?>