
<div id="sort-by">
Sort By: <?php echo select_tag("sort-by", $sortBy); ?>
</div>

<h3>Shortcuts</h3>
<ul id="menu-list">
<?php foreach($states as $s): ?>
  <li><?php echo link_to($s->__toString(), "job_list_by", $s); ?></li>
<?php endforeach; ?>
</ul>

<br/><br/>

<ul id="menu-bottom">
  <li><?php echo link_to("Request Job", "job_create"); ?></li>
  <li><?php echo link_to("Logout", "sf_guard_signout"); ?></li>
</ul>