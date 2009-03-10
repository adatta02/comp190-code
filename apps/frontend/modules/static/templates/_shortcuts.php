<div id="sort-by">
Sort By: [sort choices]
</div>
<h3>Shortcuts</h3>
<ul id="menu-list">
<?php foreach($states as $s): ?>
  <li><?php echo link_to($s->__toString(), "job_list_by", $s); ?></li>
<?php endforeach; ?>
</ul>