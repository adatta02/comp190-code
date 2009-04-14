<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
  </head>
  <body>
    
    <div id="header">
      <?php echo image_tag("title.jpg", array("style" => "height: 50px;margin-top:20px;margin-bottom:20px;margin-left:260px;")); ?>
    </div>
    
    <div id="content">
      <?php echo $sf_content ?>
    </div>
    
  </body>
</html>
