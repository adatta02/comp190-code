<div id="menu">
	
	<?php
	 $noSort = (isset($noSort) ? $noSort : false);  
	 if(!$noSort): ?>
	<div id="sort-by">
	 <div id="sort-by-sub">
	   Sort By: 
	  <a href="javascript:invertSort()">
	   <?php echo image_tag("arrow_rotate_clockwise.png", array("class" => "img_link")); ?>
	  </a>
	 </div>
	 <?php echo select_tag("sort-by-options", options_for_select($sortBy, $sortedBy)); ?>
	</div>
	<?php endif; ?>
	
	<h3>Shortcuts</h3>
	<ul id="menu-list">
	<?php foreach($states as $s): ?>
	 <?php if($s->getState() == $viewingCurrent): ?>
	   <li><strong><?php echo $s ?></strong></li>
	 <?php else: ?>
	  <li><?php echo link_to($s, "job_list_by", $s); ?></li>
	 <?php endif; ?>
	 
	<?php endforeach; ?>
	</ul>
	
	<hr/>
	
	<ul id="middle-menu">
	 <li><?php echo link_to("View Photos", "@view_photos"); ?></li>
	 <li><?php echo link_to("View Projects", "project_list"); ?></li>
	 <li><?php echo link_to("View Photographers", "photographer_list"); ?></li>
	 <li><?php echo link_to("Search Photographers", "photographer_search_location"); ?></li>
	 <li><?php echo link_to("View Clients", "client_list"); ?></li>
	 <li><?php echo link_to("View Calendar", "calendar_view"); ?></li>
	 <li><?php echo link_to("View Log", "view_log"); ?></li>
	</ul>
	
	<hr/>
	
	<ul id="menu-bottom">
	  <li><?php echo link_to("Request Job", "job_create"); ?></li>
	 <li> <a href="http://photo.tufts.edu/?pid=24&c=21">FAQ </a></li>
	  <li><?php echo link_to("Logout", "sf_guard_signout"); ?></li>
	</ul>
</div>
