<?php use_helper("PMRender"); ?>
<?php use_helper("Url"); ?>
<?php use_helper("JavascriptBase"); ?>

<table width="100%" border="0" id="basic-info-table">
  <tr>
    <td width="20%">Event</td>
    <td width="80%"><?php echo $job->getEvent(); ?></td>
  </tr>
  <tr>
    <td>Status</td>
    <td><?php echo $job->getStatus()->getState(); ?></td>
  </tr>
  <tr>
    <td>Shoot Type</td>
    <td><?php echo $job->getPhotoType() ?></td>
  </tr>
  <tr>
    <td class="shoot-datetime">Shoot Date</td>
    <td class="shoot-datetime"><?php echo $job->getPrettyShootDate() ?></td>
  </tr>
  <tr>
    <td>Due Date</td>
    <td><?php echo $job->getDueDate("F j, Y"); ?></td>
  </tr>
  <tr>
    <td>Created At</td>
    <td><?php echo $job->getCreatedAt("F j, Y"); ?></td>
  </tr>
  <tr>
    <td>Contact</td>
    <td><?php echo mail_to($job->getContactEmail(), $job->getContactName()) . " &lt;" . $job->getContactEmail(); ?>&gt;</td>
  </tr>
  <tr>
    <td>Contact Phone</td>
    <td><?php echo $job->getContactPhone() ?></td>
  </tr>
  <tr>
    <td>Publication</td>
    <td>
          <?php if($job->getPublication()) 
                  echo $job->getPublication()->getName();
                else
                  echo "None"; 
          ?>
       </td>
  </tr>
  <tr>
    <td>Tags <a href="" onclick="$('#add-tag').show(); return false;">
            <?php echo image_tag("add.png", array("class" => "plus-img")); ?></a></td>
    <td>
      <?php renderTagList($job); ?>
   </td>
  </tr>
  <tr>
    <td>
      <span id="add-tag" style="display: none">
        Tag <?php echo input_tag("add-tag-val"); ?> 
        <?php echo button_to_function("Add", "addJobTag(" . $job->getId() . ")") ?>
     </span>
    </td>
  </tr>
</table>

<form id="basic-info-form"
       action="<?php echo url_for("job_edit", array("form" => 'basic', "job_id" => $job->getId())); ?>"
       method="post">
<table id="basic-info-edit" style="display: none">
  <?php echo $basicInfoForm["event"]->renderRow(); ?>
  <?php echo $basicInfoForm["status_id"]->renderRow(); ?>
  <?php echo $basicInfoForm["publication_id"]->renderRow(); ?>
  <?php echo $basicInfoForm["date"]->renderRow(); ?>
  <?php echo $basicInfoForm["start_time"]->renderRow(array("size" => 7)); ?>
  <?php echo $basicInfoForm["end_time"]->renderRow(array("size" => 7)); ?>
  <?php echo $basicInfoForm["due_date"]->renderRow(); ?>
  <?php echo $basicInfoForm["contact_name"]->renderRow(); ?>
  <?php echo $basicInfoForm["contact_email"]->renderRow(); ?>
  <?php echo $basicInfoForm["contact_phone"]->renderRow(); ?>
  <tr><td><?php echo button_to_function("Save", "saveBasicInfo()"); ?>
  <?php echo $basicInfoForm->renderHiddenFields(); ?>
  </td></tr>
</table>
</form>
