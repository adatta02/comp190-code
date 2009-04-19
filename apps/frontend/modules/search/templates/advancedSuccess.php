<?php include_component ( "static", "topmenu", array("moveToSkip" => null, "noMenu" => true) ); ?>
<?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => null, 
                                "viewingCurrent" => null) ); ?>

<div id="list-container">
  <?php include_partial("advancedSearchForm", array("form" => $form)); ?>
</div>