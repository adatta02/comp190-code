<div class="info-header">
  Attachments 
  <?php echo link_to_function(image_tag("add.png", 
                              array("class" => "plus-img")), 
                              "$('#attachment-form').show();"); ?>
</div>

<?php if(count($attachments) == 0): ?>
  This job has no attachments.
<?php else: ?>
<table>
<tr>
  <th>User</th>
  <th>File Name</th>
</tr>
<?php foreach($attachments as $as): ?>
  <tr>
    <td><?php echo $as->getUser()->getUserName(); ?></td>
    <td><?php echo link_to($as->getOriginalFileName(), 
                            "/uploads/" . $as->getFileName(), array("target" => "_new")); ?></td>
  </tr>    	
<?php endforeach; ?>
</table>
<?php endif; ?>

<div id="attachment-form" style="display: none">
  <form action="<?php echo url_for('job_add_attachment') ?>" 
        method="POST" enctype="multipart/form-data">
	<table>
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
	</table>
  <input name="jobId" type="hidden" value="<?php echo $job->getId();  ?>" />
	<input type="submit" value="Save" />
	</form>
</div>

<script type="text/javascript">
function showFileInput(id){
  $("#jobattach_file_" + id).show();
}
</script>