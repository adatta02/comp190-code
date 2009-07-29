
<?php echo include_javascripts_for_form($form); ?>
<?php echo include_stylesheets_for_form($form); ?>
 
<?php include_component ( "static", "topmenu",
                          array("moveToSkip" => null, "noMenu" => true) ); ?>
<?php include_component ( "static", "shortcuts",
                          array("sortedBy" => JobPeer::DATE,
                                "noSort" => true,
                                "viewingCurrent" => null) ); ?>
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
<div id="list-container">
  <h2>Request a photographer:</h2>
  &nbsp;<font color='red'>Required *</font>
  <h3><?php echo $form->renderGlobalErrors(); ?></h3>
  <h3><?php echo $attachForm->renderGlobalErrors(); ?></h3>
  
  <form action="<?php echo url_for('@job_create') ?>" method="POST" enctype="multipart/form-data">
  
  <table id="formTable" cellspacing="4">
    <tr valign="top">
    
    <td class="form-td">
      <h3>Client</h3>
      
      <?php if($isReadonly): ?>
        <small><a href="#" onclick="javascript:editInfo(); return false;">Edit my information</a></small>
      <?php endif; ?>
      
      <?php if(!$isAdmin): ?>
	    <table id="client-table" class="form-td">
			   <tr><?php echo $form["name"]->renderRow(array("readonly" => $isReadonly)); ?></tr>
			   <tr><?php echo $form["department"]->renderRow(array("readonly" => $isReadonly)); ?></tr>
			   <tr><?php echo $form["address"]->renderRow(array("readonly" => $isReadonly)); ?></tr>
			   <tr><?php echo $form["email"]->renderRow(array("readonly" => $isReadonly)); ?></tr>
			   <tr><?php echo $form["phone"]->renderRow(array("readonly" => $isReadonly)); ?></tr>
			   <tr><?php echo $form["acct_num"]->renderRow(array("readonly" => $isReadonly)); ?></tr>
			   <tr><?php echo $form["dept_id"]->renderRow(array("readonly" => $isReadonly)); ?></tr>
	    </table>
    <?php else: ?>
      <?php echo $form["name"]->render(); ?>
    <?php endif; ?>
    
    </td>
    
  <td class="form-td-right">
  
    <h3>Shoot Contact</h3>
    
    <?php if(!$isAdmin): ?>
      <span>Same as client? <?php echo checkbox_tag("copy-client-info", 1, 0, array("onclick" => "javascript:copyClient();")); ?></span>
    <?php endif; ?>
    
    <table>
	    <tr><?php echo $form["contact_name"]->renderRow(); ?></tr>
	    <tr><?php echo $form["contact_email"]->renderRow(); ?></tr>
	    <tr><?php echo $form["contact_phone"]->renderRow(); ?></tr>
    </table>
    
  </td>
  
</tr>

<tr valign="top">
  <td class="form-td">
    <h3>Shoot</h3>
    <table>
		    <tr><?php echo $form["publication_id"]->renderRow(); ?> </tr>
		    <tr><?php echo $form["event"]->renderRow(); ?></tr>
		    <tr><?php echo $form["project_id"]->renderRow(); ?> </tr>
	      <tr><?php echo $form["date"]->renderRow(); ?> </tr>
	      <tr><td></td><td><small>If time is TBD leave blank</small></td></tr>
		    <tr><?php echo $form["start_time"]->renderRow(); ?> </tr>
		    <tr><?php echo $form["end_time"]->renderRow(); ?> </tr>
		    <tr><?php echo $form["street"]->renderRow(); ?></tr>
		    <tr><?php echo $form["city"]->renderRow(); ?></tr>
		    <tr><td><?php echo $form["state"]->renderRow(); ?></td>
		    <td><?php echo $form["zip"]->renderRow(); ?> </td></tr>
		    <tr><?php echo $form["due_date"]->renderRow(); ?> </tr>
      </table>
    </td>
  <td>
  
<table cellpadding="5" class="form-td-right">
    <tr><td><h3>Photography</h3></td></tr>
    <tr><?php echo $form["photo_type"]->renderRow(); ?> </tr>
    <tr><?php echo $form["ques1"]->renderRow(); ?> </tr>
    <tr><?php echo $form["ques2"]->renderRow(); ?> </tr>
    <tr><?php echo $form["ques3"]->renderRow(); ?> </tr>
</table>

</td>
</tr>

</table>

<table style="margin-left: 20px"><tbody>
<tr>
  <td>Attach Files:</td>
</tr>
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
</tbody></table>

  <input type="submit" value="submit" />
  <?php echo $form->renderHiddenFields(); ?>
</form>

  </div>
</div>
