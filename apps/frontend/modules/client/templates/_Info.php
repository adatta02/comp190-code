<?php use_helper("PMRender"); ?>
<?php use_helper("Url"); ?>
<?php use_helper("JavascriptBase"); ?>

<table width="100%" border="0" id="info-table">
  <tr>
    <td width="20%">Name</td>
    <td width="80%"><?php echo $client->getName(); ?></td>
  </tr>
  <tr>
    <td>Department</td>
    <td><?php echo $client->getDepartment(); ?></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><?php echo $client->getAddress() ?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?php echo $client->getEmail() ?></td>
  </tr>
  <tr>
    <td>Phone</td>
    <td><?php echo $client->getPhone(); ?></td>
  </tr>
</table>

<form id="info-form"
       action="<?php echo url_for("client_edit", array("form" => 'info', "client_id" => $client->getId())); ?>"
       method="post">
<table id="info-edit" style="display: none">
  <?php echo $InfoForm["name"]->renderRow(); ?>
  <?php echo $InfoForm["department"]->renderRow(); ?>
  <?php echo $InfoForm["address"]->renderRow(); ?>
  <?php echo $InfoForm["email"]->renderRow(); ?>
  <?php echo $InfoForm["phone"]->renderRow(); ?>
  <tr><td><?php echo button_to_function("Save", "saveClientInfo()"); ?>
  <?php echo $InfoForm->renderHiddenFields(); ?>
  </td></tr>
</table>
</form>
