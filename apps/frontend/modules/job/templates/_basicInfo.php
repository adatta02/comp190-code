<?php use_helper("PMRender"); ?>
<?php use_helper("Url"); ?>
<table width="100%" border="0">
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
    <td>Shoot Date</td>
    <td><?php echo $job->getPrettyShootDate() ?></td>
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