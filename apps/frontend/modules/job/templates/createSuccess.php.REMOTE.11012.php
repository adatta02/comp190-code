
<?php echo include_javascripts_for_form($form); ?>
<?php echo include_stylesheets_for_form($form); ?>
 
<h2>Request a photographer:</h2>
 
<form action="<?php echo url_for('@job_create') ?>" method="POST">
  <div>
<h3><?php echo $form->renderGlobalErrors(); ?></h3>
<h3>Client</h3>
   <table>
   <tr><?php echo $form["name"]->renderRow(); ?> </tr>
   <tr><?php echo $form["department"]->renderRow(); ?> </tr>
   <tr><?php echo $form["address"]->renderRow(); ?> </tr>
   <tr><?php echo $form["email"]->renderRow(); ?> </tr>
   <tr><?php echo $form["phone"]->renderRow(); ?> </tr>
    <tr><?php echo $form["acct_num"]->renderRow(); ?> </tr>
    <tr><?php echo $form["dept_id"]->renderRow(); ?> </tr>
  </table>
<h3> Shoot </h3>
<table>
    <tr><?php echo $form["publication_id"]->renderRow(); ?> </tr>
    <tr><?php echo $form["event"]->renderRow(); ?> </tr>
    <tr><?php echo $form["project_id"]->renderRow(); ?> </tr>

    <tr><?php echo $form["date"]->renderRow(); ?> </tr>
    <tr><td></td><td><small>If time is TDB leave blank</small></td></tr>
    <tr><?php echo $form["start_time"]->renderRow(); ?> </tr>
    <tr><?php echo $form["end_time"]->renderRow(); ?> </tr>
 
    <tr><?php echo $form["street"]->renderRow(); ?> </tr>
    <tr><?php echo $form["city"]->renderRow(); ?></tr>
    <tr><td><?php echo $form["state"]->renderRow(); ?> </td>
    <td><?php echo $form["zip"]->renderRow(); ?> </td></tr>

    <tr><?php echo $form["due_date"]->renderRow(); ?> </tr>
    <tr><?php echo $form["notes"]->renderRow(); ?> </tr>
</table>
 
<h3>Shoot Contact </h3>
<table>
    <tr><?php echo $form["contact_name"]->renderRow(); ?> </tr>
    <tr><?php echo $form["contact_email"]->renderRow(); ?> </tr>
    <tr><?php echo $form["contact_phone"]->renderRow(); ?> </tr>
</table>
<br/>
    <input type="submit" value="submit" />
    <?php echo $form->renderHiddenFields(); ?>
  </div>
</form>

