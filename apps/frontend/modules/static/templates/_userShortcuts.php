<?php use_helper("Form", "Text", "JavascriptBase"); ?>

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
  <h3>Shortcuts</h3>
  
	 <ul class="listless shortcuts">
	 
	   <?php if(sfContext::getInstance()->getUser()->hasCredential("client")): ?>
	     <li><?php echo link_to("All Jobs", "client_myjobs_own", array("all" => true)); ?></li>
		   <li><?php echo link_to("My Jobs", "client_myjobs_own", array("own" => true)); ?></li>
	   <?php endif; ?>
	
	   <?php if(sfContext::getInstance()->getUser()->hasCredential("photographer")): ?>
	     <li><?php echo link_to("My Jobs", "client_myjobs_own"); ?></li>
	   <?php endif; ?>
	</ul>
</div>
	
<hr class="space" />

<div class="box">
  <h3>Actions</h3>
	<ul class="listless shortcuts">
	  <li><?php echo link_to("Request Job", "job_create"); ?></li>
	  <li><a target="_new" href="http://photo.tufts.edu/?pid=24&c=21">FAQ </a></li>
	  <li><?php echo link_to("View Photos", "@view_photos"); ?></li>
	  <li><?php echo link_to("Logout", "sf_guard_signout"); ?></li>
	</ul>
</div>
