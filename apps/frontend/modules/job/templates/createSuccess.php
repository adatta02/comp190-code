
<?php echo include_javascripts_for_form($form); ?>
<?php echo include_stylesheets_for_form($form); ?>
 
<div class="span-6">
<?php 

if($sf_user->hasCredential("admin")){

  include_component ( "static", "shortcuts",
                          array("sortedBy" => JobPeer::DATE,
                                "noSort" => true,
                                "viewingCurrent" => null) );
}else{
  
	include_component ( "static", "userShortcuts",
                          array("sortedBy" => JobPeer::DATE,
                                "viewingCurrent" => null,
                                "noSort" => false) ); 
}
?>
</div>

<div class="span-17 box last">
  <h2>Request a photographer:</h2>
  <p class="marked-required">(*) Required</p>
  
  <?php if($form->renderGlobalErrors()): ?>
    <div class="error"><?php echo $form->renderGlobalErrors(); ?></div>
  <?php endif; ?>

  <?php if($attachForm->renderGlobalErrors()): ?>
    <div class="error"><?php echo $attachForm->renderGlobalErrors(); ?></div>
  <?php endif; ?>
  
  <?php if(!$isAdmin): ?>
      <table id="client-table" class="form-td">
      </table>
  <?php endif; ?>
   
    
  <form 
    action="<?php echo url_for('@job_create') ?>" 
    method="POST" enctype="multipart/form-data">
  
  <div class="span-12 bordered-right" style="overflow: hidden">
  
    <h3>Client Name</h3>
      
    <table>
      <tbody>
              
        <?php if(!$isAdmin): ?>
           <tr><?php echo $form["name"]->renderRow( ); ?></tr>
           <tr><?php echo $form["department"]->renderRow( ); ?></tr>
           <tr><?php echo $form["address"]->renderRow( ); ?></tr>
           <tr><?php echo $form["email"]->renderRow( ); ?></tr>
           <tr><?php echo $form["phone"]->renderRow( ); ?></tr>
           <tr><?php echo $form["acct_num"]->renderRow( ); ?></tr>
           <tr><?php echo $form["dept_id"]->renderRow( ); ?></tr>
        <?php else: ?>
          <?php echo $form["name"]->renderRow(); ?>
        <?php endif; ?>
        
      </tbody>
    </table>
    
    <hr class="border-bottom" />
    
    <h3>Shoot Contact</h3>
    <table>
      <tbody>
        <tr>
          <td>
          <?php if(!$isAdmin): ?>
            Same as client? 
              <?php echo checkbox_tag("copy-client-info", 1, 0, 
                          array("onclick" => "javascript:copyClient();")); ?>
          <?php endif; ?>
          </td>
        </tr>
        
        <tr><?php echo $form["contact_name"]->renderRow(); ?></tr>
        <tr><?php echo $form["contact_email"]->renderRow(); ?></tr>
        <tr><?php echo $form["contact_phone"]->renderRow(); ?></tr>
      
      </tbody>
    </table>
    
    <hr class="border-bottom" />
    
    <h3>Shoot Details</h3>
      <table>
        <tr><?php echo $form["publication_id"]->renderRow(); ?></tr>
        <tr><?php echo $form["event"]->renderRow(); ?></tr>
        <tr><?php echo $form["project_id"]->renderRow(); ?></tr>
        <tr><?php echo $form["date"]->renderRow(); ?></tr>
        <tr><td></td><td><small>If time is TBD leave blank</small></td></tr>
        <tr><?php echo $form["start_time"]->renderRow(); ?> </tr>
        <tr><?php echo $form["end_time"]->renderRow(); ?> </tr>
        <tr><?php echo $form["street"]->renderRow(); ?></tr>
        <tr><?php echo $form["city"]->renderRow(); ?></tr>
        <tr><td><?php echo $form["state"]->renderRow(); ?></td>
        <td><?php echo $form["zip"]->renderRow(); ?> </td></tr>
        <tr><?php echo $form["due_date"]->renderRow(); ?> </tr>
      </table>
  </div>

  <div class="span-11 last">
    <h3>Photography Instructions</h3>

    <table>
      <tbody>
        <?php echo $form["photo_type"]->renderRow(); ?>
      </tbody>
    </table>
    
    <p>
      <?php echo $form["ques1"]->renderLabel(); ?> <br />
      <?php echo $form["ques1"]->render(); ?>
      <?php if( $form["ques1"]->hasError()): ?>
        <p class="error"><?php echo $form["ques1"]->renderError(); ?></p>
      <?php endif; ?>
    </p>
    
    <p>
      <?php echo $form["ques2"]->renderLabel(); ?> <br />
      <?php echo $form["ques2"]->render(); ?>
      <?php if( $form["ques2"]->hasError()): ?>
        <p class="error"><?php echo $form["ques2"]->renderError(); ?></p>
      <?php endif; ?>
    </p>

    <p>
      <?php echo $form["ques3"]->renderLabel(); ?> <br />
      <?php echo $form["ques3"]->render(); ?>
      <?php if( $form["ques3"]->hasError()): ?>
        <p class="error"><?php echo $form["ques3"]->renderError(); ?></p>
      <?php endif; ?>
    </p>
    
  </div>

  <div class="span-15">
    <h3>Attach Files:</h3>
    <?php echo $form->renderHiddenFields(); ?>
    
    <table>
      <tbody>
      <tr>
        <td><?php echo $attachForm["file_0"]->render( array("align" => "right", "onchange" => "javascript:showFileInput(1)") ); ?></td>
      </tr>
      <tr>
        <td><?php echo $attachForm["file_1"]->render( array("align" => "right", "style" => "display: none", "onchange" => "javascript:showFileInput(2)") ); ?></td>
      </tr>
      <tr>
        <td><?php echo $attachForm["file_2"]->render( array("align" => "right", "style" => "display: none", "onchange" => "javascript:showFileInput(3)") ); ?></td>
      </tr>
      <tr>
        <td><?php echo $attachForm["file_3"]->render( array("align" => "right", "style" => "display: none", "onchange" => "javascript:showFileInput(4)") ); ?></td>
      </tr>
      <tr>
        <td><?php echo $attachForm["file_4"]->render( array("align" => "right", "style" => "display: none") ); ?></td>
      </tr>
      <tr>
        <td><input type="submit" value="Submit" /></td>
      </tr>
      </tbody>
    </table>
  </form>
  
  </div>
</div>


<script type="text/javascript">

function showFileInput(id){
  $("#jobattach_file_" + id).show();
}

<?php if($isAdmin): ?>
    $(document).ready( function(){ 
    $("#requestjob_name")
    .autocomplete('<?php
        echo url_for ( "@client_autocomplete" )?>', $.extend({}, {
      dataType: 'json',
      parse:    function(data) {
                  var parsed = [];
                  var obj;
                  for(var i=0; i < data.length; i++){
                    obj = new Object();
                    obj.data = [data[i].name + " &lt;" + data[i].email + "&gt", data[i].id];
                    obj.value = data[i].name;
                    obj.result = data[i].name;
                    parsed.push(obj);
                  }
                  return parsed;
      }}, {width: 300}))
    .result(function(event, data) { $("#requestjob_clientId").val(data[1]); });
   });
<?php endif; ?>

   function editInfo(){
    var res = confirm("Are you sure you want to edit? The changes will be saved in our database.");
    if(res){
      $("#client-table input").each(function(){ $(this).attr("readonly", false); });
    }
   }
</script>