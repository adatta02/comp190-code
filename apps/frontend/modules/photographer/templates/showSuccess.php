<?php use_helper("PMRender"); ?>
<?php echo include_javascripts_for_form($InfoForm); ?>


<?php include_component ( "static", "topmenu", array("moveToSkip" => null, "noMenu" => true) ); ?>
<?php include_component ( "static", "shortcuts",
                          array("sortedBy" => null,
                                "viewingCurrent" => null,
                                "noSort" => true) ); ?>

<div id="content-container">
<div id="now-viewing">
    Viewing photographer <?php echo $photographer->getName(); ?>
    <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?>
  </div>

<div class="info-header">Information
<a href="#" onclick="javascript:$('#info-edit').toggle(); return false;">
  <?php echo image_tag("pencil.png", array("class" => "image-href")) ?>
</a>
</div>

<div id="photographer-info"><a href="#info"></a>
  <?php include_partial("Info", array("photographer" => $photographer, "InfoForm" => $InfoForm)); ?>
</div>

</div>
