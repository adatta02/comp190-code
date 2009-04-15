<?php include_component ( "static", "topmenu", array("moveToSkip" => null, "noMenu" => true) ); ?>
<?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => null, 
                                "viewingCurrent" => null) ); ?>

<div id="list-container">
  <h2>Advanced search</h2>
  <div id="advanced-search-form">
    <?php echo form_tag("advanced_search"); ?>
    <table>
      <?php echo $form["status_id"]->renderRow(); ?>
      
      <tr>
        <th>Due date range:</th>
        <td><?php echo $form["due_date_start"]->render(); ?> to <?php echo $form["due_date_end"]->render(); ?></td>
      </tr>
      
      <tr>
        <th>Shoot date range:</th>
        <td><?php echo $form["shoot_date_start"]->render(); ?> to <?php echo $form["shoot_date_end"]->render(); ?></td>
      </tr>
      
      <?php echo $form["has_photo"]->renderRow(); ?>
      <?php echo $form["has_client"]->renderRow(); ?>
    </table>
    
    <?php echo submit_tag("Search"); ?>
    
    </form>
  </div>
</div>