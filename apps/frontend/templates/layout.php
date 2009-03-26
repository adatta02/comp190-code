<?php use_helper("Form"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <?php
				include_http_metas ()?>
    <?php
				include_metas ()?>
    <?php
				include_title ()?>
    <link rel="shortcut icon" href="/favicon.ico" />
</head>
<body>

<div id="header">
  <div id="logo"><?php echo image_tag("tufts_logo.jpg"); ?></div>
  <div id="title">University Photography Management</div>
</div>

<div class="clear"></div>

<div id="content">
  <?php echo $sf_content?>
</div>

</body>
</html>
