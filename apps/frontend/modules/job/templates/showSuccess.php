<?php include_component ( "static", "topmenu", array("moveToSkip" => null) ); ?>
<?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => null, 
                                "viewingCurrent" => null) ); ?>

<div id="content-container">
  <div id="now-viewing">Viewing job #<?php echo $job->getId(); ?></div>
</div>