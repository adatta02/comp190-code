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
	 <?php endif; ?>
	 <?php if(in_array($s->getState(), $showStates)): ?>
	  <li><?php echo link_to($s, "client_myjobs", $s); ?></li>
	 <?php endif; ?>
	 
	<?php endforeach; ?>
	</ul>
	
	<hr/>
		
	<ul id="menu-bottom">
	  <li><?php echo link_to("Request Job", "job_create"); ?></li>
	 <li> <a href="http://photo.tufts.edu/?pid=24&c=21">FAQ </a></li>
	  <li><?php echo link_to("Logout", "sf_guard_signout"); ?></li>
	</ul>
</div>
