<?php use_helper("Form"); ?>

<?php $noSort = (isset($noSort) ? $noSort : false); if(!$noSort): ?>
  <div class="box">
      <label for="sort-by-options">Sort By:</label>
      <?php echo select_tag("sort-by-options", options_for_select($sortBy, $sortedBy)); ?> 
	     <a href="javascript:invertSort()">
	       <?php echo image_tag("arrow_rotate_clockwise.png", array("class" => "img_link")); ?>
	     </a>
  </div>
  
  <hr class="space" />
<?php endif; ?>

<div class="box">
  <h3>Job Shortcuts</h3>
	 <ul class="listless shortcuts">
	   <li>
	     <?php if($viewingCurrent == "Active"): ?>
	       <strong>Active Jobs</strong>
	     <?php else: ?>
	       <?php echo link_to("Active Jobs", "job_welcome"); ?>
	     <?php endif; ?>
	   </li>
	   <?php foreach($states as $s): ?>
	     <?php if($s->getState() == $viewingCurrent): ?>
	       <li><strong><?php echo $s ?></strong></li>
	     <?php else: ?>
	       <li><?php echo link_to($s, "job_list_by", $s); ?></li>
	     <?php endif; ?>
	   <?php endforeach; ?>
	</ul>
</div>

<hr class="space" />

<div class="box">
  <h3>View</h3>
  <ul class="listless shortcuts">
    <li><?php echo link_to("Photos", "@view_photos"); ?></li>
	   <li><?php echo link_to("Projects", "project_list"); ?></li>
	   <li><?php echo link_to("Photographers", "photographer_list"); ?></li>
     <li><?php echo link_to("Clients", "client_list"); ?></li>
     <li><?php echo link_to("Calendar", "calendar_view"); ?></li>
     <li><?php echo link_to("Publications", "manage_publications"); ?></li>
     <li><?php echo link_to("Log", "view_log"); ?></li>
     <li><?php echo link_to("Search Photographers", "photographer_search_location"); ?></li>
	</ul>
</div>

<hr class="space" />

<div class="box">
  <ul class="listless shortcuts">
    <li><?php echo link_to("Request Job", "job_create"); ?></li>
	  <li><a href="http://photo.tufts.edu/?pid=24&c=21">FAQ </a></li>
	  <li><?php echo link_to("Logout", "sf_guard_signout"); ?></li>
	</ul>
</div>