<h2>Request a photographer:</h2>

<?php echo form_tag_for($form, '@project') ?>
  <div>
    <?php echo $form["event"]->renderRow(); ?> <br/>
    <?php echo $form["start_time"]->renderRow(); ?> <br/>
    <?php echo $form["end_time"]->renderRow(); ?> <br/>
    <?php echo $form["due_date"]->renderRow(); ?> <br/>
    <?php echo $form["publication_id"]->renderRow(); ?> <br/>
    <?php echo $form["street"]->renderRow(); ?> <br/>
    <?php echo $form["city"]->renderRow(); ?> <br/>
    <?php echo $form["state"]->renderRow(); ?> <br/>
    <?php echo $form["zip"]->renderRow(); ?> <br/>
    <?php echo $form["contact_name"]->renderRow(); ?> <br/>
    <?php echo $form["contact_email"]->renderRow(); ?> <br/>
    <?php echo $form["contact_phone"]->renderRow(); ?> <br/>
    <input type="submit" value="submit" />
    <?php echo $form->renderHiddenFields(); ?>
  </div>
</form>