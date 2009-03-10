<?php use_helper("PMRender"); ?>

<?php foreach($pager->getResults() as $i): ?>
  <?php renderJobListView($i); ?>
<?php endforeach; ?>

<?php include_component("static", "pager", array("pager" => $pager, "url" => $url)); ?>