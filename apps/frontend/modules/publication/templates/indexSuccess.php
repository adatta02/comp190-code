<?php include_component ( "static", "topmenu", 
                          array("moveToSkip" => null, "noMenu" => true) ); ?>
<?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => JobPeer::DATE,
                                "noSort" => true,
                                "viewingCurrent" => null) ); ?>
<div id="list-container">
  <div id="now-viewing"> 
    Viewing all publications 
      <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?>
  </div>
  
  <div id="publication-list" style="width: 500px; float: left;">
    <?php include_partial("renderList", array("pager" => $pager)); ?>
  </div>
  
  <div id="add-publication" style="width: 300px; float: left; padding-left: 20px">
    <div style="font-size: 14px; font-weight: bold">Add a publication</div>
    <div>
      <table>
        <tbody>
          <tr>
            <th>Name:</th>
            <td><?php echo input_tag("pub-name"); ?></td>
          </tr>
          <tr>
            <td><?php echo submit_tag("Save", array("onclick" => "savePublication()")); ?></td>
          </tr>
        </tbody>
     </table>
    </div>
       
  <div id="edit-publication" style="display: none; padding-top: 30px">
    <div style="font-size: 14px; font-weight: bold">Edit a publication</div>
    <div>
      <table>
        <tbody>
          <tr>
            <th>Name:</th>
            <td><?php echo input_tag("pub-edit-name"); ?>
                <?php echo input_hidden_tag("pub-edit-id");?>
            </td>
          </tr>
          <tr>
            <td><?php echo submit_tag("Save", array("onclick" => "saveEditPublication()")); ?></td>
          </tr>
        </tbody>
     </table>
    </div>
  </div>
    
  </div>
  
</div>

<script type="text/javascript">

function saveEditPublication(){
	$("#edit-publication").hide();
	   $("#ajax-loading").show();
	    $("#publication-list").load( "<?php echo url_for("add_publication") ?>", 
	        {name: $("#pub-edit-name").val(), id: $("#pub-edit-id").val()}, 
	        function(){ $("#ajax-loading").hide(); } );
}

function savePublication(){
	 $("#ajax-loading").show();
	  $("#publication-list").load( "<?php echo url_for("add_publication") ?>", 
			  {name: $("#pub-name").val()}, function(){ $("#ajax-loading").hide(); } );
}

function deletePub(id){
	var res = confirm("Are you sure you want to delete this publication?");
	if( res ){
		  $("#ajax-loading").show();
	    $("#publication-list").load( "<?php echo url_for("delete_publication") ?>", 
	            {id: id}, function(){ $("#ajax-loading").hide(); } );
	}
}

function editPub(id, name){
	$("#pub-edit-name").val( name );
	$("#pub-edit-id").val( id );
	$("#edit-publication").show();
}

</script>