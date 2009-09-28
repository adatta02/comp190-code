<?php use_helper("JavascriptBase"); ?>
<script type="text/javascript">
  ProjectManager.diffNotesUrl = "<?php echo url_for("job_diff_notes"); ?>";
</script>
<div class="span-6">
  <?php include_component ( "static", "shortcuts", 
                          array("sortedBy" => null, 
                                "viewingCurrent" => null,
                                "noSort" => true) ); ?>
</div>

<div class="span-17 last">
  <div id="content-container" class="box">
  	<div id="now-viewing">
  	    Viewing job #<?php echo $job->getId(); ?> notes
  	    <?php echo image_tag("loading.gif", array("id" => "ajax-loading")); ?> 
  	</div>
  	
  	<div id="revision-list">
  	
  	<?php echo button_to_function("View old revision", "diffNotes(" . $job->getId() . ")"); ?>
  	
  	 <table class="job-table" width="100%">
  	   <?php foreach($pager->getResults() as $jn): ?>
  	      <tr>
  	       <td><?php echo radiobutton_tag("diff-select", $jn->getId(), false); ?></td>
  	       <td><?php echo $jn->getRevision(); ?></td>
  	       <td><?php echo $jn->getCreatedAt(); ?></td>
  	       <td><?php echo substr($jn->getNotes(), 0, 20); ?>...</td>
  	       <td><?php echo $jn->getUserName(); ?></td>
  	      </tr>
  	   <?php endforeach; ?>
  	 </table>
  	</div>
  	
  	<h3>Current:</h3>
  	<div id="current-note"><?php echo $job->getNotes(); ?></div>
  	
  	<h3>Previous:</h3>
  	<div id="diff-result"></div>
  	
  </div>
</div>
