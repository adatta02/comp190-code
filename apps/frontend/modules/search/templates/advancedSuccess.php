<?php include_component ( "static", "topmenu", 
                          array("moveToSkip" => null, "noMenu" => false) ); ?>

<div class="span-6">
  <?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => null, 
                                "viewingCurrent" => null) ); ?>
</div>

<div class="span-17">

  <div class="box">

    <div id="list-container">
      <?php include_partial("advancedSearchForm", array("form" => $form)); ?>
    </div>
  </div>
</div>