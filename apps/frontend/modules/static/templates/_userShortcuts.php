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
	<?php if(sfContext::getInstance()->getUser()->hasCredential("client")): ?>
	 <li><?php echo link_to("All Jobs", "client_myjobs_own", array("all" => true)); ?></li>
		<li><?php echo link_to("My Jobs", "client_myjobs_own", array("own" => true)); ?></li>
	<?php endif; ?>
	
	<?php if(sfContext::getInstance()->getUser()->hasCredential("photographer")): ?>
	 <li><?php echo link_to("My Jobs", "client_myjobs_own"); ?></li>
	<?php endif; ?>
	
	</ul>
	
	<hr/>
		
	<ul id="menu-bottom">
	  <li><?php echo link_to("Request Job", "job_create"); ?></li>
	  <li><a target="_new" href="http://photo.tufts.edu/?pid=24&c=21">FAQ </a></li>
	  <li><?php echo link_to("View Photos", "@view_photos"); ?></li>
	  <li><?php echo link_to("Logout", "sf_guard_signout"); ?></li>
	</ul>
</div>
