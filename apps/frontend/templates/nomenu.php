<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
  </head>
  <body>
    
    <div class="header">
      <div class="container">
        <h2>Tufts University Photography Management</h2>
      </div>
      
    </div>
    
    <div class="header-spacer">
      <?php if($sf_user->isAuthenticated()): ?>
        <div class="container user-banner">
            Logged in as <?php echo $sf_user->getUsername(); ?>
            | <?php echo link_to("Logout", "sf_guard_signout"); ?>
        </div>
      <?php endif; ?>
    </div>
    
    <div class="container body">
      <?php echo $sf_content ?>
    </div>
    
  </body>
</html>
