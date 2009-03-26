<div id="menu">
	<div id="sort-by">
	Sort By: <?php echo select_tag("sort-by", $sortBy); ?>
	</div>
	
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
	
	<ul id="menu-bottom">
	  <li><?php echo link_to("Request Job", "job_create"); ?></li>
	  <li><?php echo link_to("Logout", "sf_guard_signout"); ?></li>
	</ul>
</div>