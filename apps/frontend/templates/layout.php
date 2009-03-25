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

    <?php include_stylesheets() ?>

</head>
<body>

<div id="header">

<div id="title">
    <div id="logo"></div>  
    <h3>University Photography Management</h3>
</div>
<br/><br/>
<div id="top-menu">
<br/>
  <div id="left-top-menu"></div>
  <?php include_component ( "static", "topmenu" ); ?>
  <div id="right-top-menu"></div>
</div>
</div>

<div id="menu">
	      <?php
							include_component ( "static", "shortcuts" );
							?>
	    </div>


<div id="content">
      <?php
						echo $sf_content?>
    </div>

</body>
</html>
