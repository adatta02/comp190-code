<div id="login-container">
	<div id="box">
	   <div id='choices'>
	     <span class='link'><?php echo link_to("Request a Job", "@job_create"); ?> </span>
	     <br/><br/>
	     <span class='desc'>Request a photographer for your event or publication.</span>
	     <br/><br/>
	     <span class='link'>
	         <?php echo link_to("View Jobs", "@job_welcome"); ?>
	     </span>
	     <br/><br/>
	     <span class='desc'>View and edit requests, create and assign photographers, manage emails.</span>
	     <br/><br/>
	     <span class='link'><?php echo link_to("View Photos", "@view_photos"); ?></span>
	     <br/><br/>
	     <span class='desc'>View photos from your projects and jobs. </span>
	     <br/><br/>
	     <?php if($sf_user->isAuthenticated()): ?>
	       <span class='link'>
	         <?php echo link_to("Logout", "sf_guard_signout"); ?>
	       </span>
	     <?php endif; ?>
	   </div>
	</div>
</div>