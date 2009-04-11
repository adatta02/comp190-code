<?php use_helper("Form"); ?>
<?php use_helper("JavascriptBase"); ?>

<div id="internal-notes-div">
  <br/>
  
  <div>
    <a href="<?php echo url_for("job_view_notes", array("slug" => $job->getSlug())) ?>">
      <small><?php echo $job->getNumberRevisions(); ?> revisions</small>
    </a>
  </div>
  
  <br/>
  <?php echo $job->getNotes(); ?>
</div>

<div id="internal-notes-edit" style="display: none">
  <form name="internal-notes-form" id="internal-notes-form" 
      action="<?php echo url_for("job_edit", array("form" => 'internal', "job_id" => $job->getId())); ?>"
       method="post">
    <?php echo input_hidden_tag("job_id", $job->getId()); ?>
    <?php echo textarea_tag("internal-edit", $job->getNotes(), array("rows" => 20, "cols" => 50)); ?>
    <?php echo button_to_function("Update", "saveInternalNotes()"); ?>
  </form>
</div>