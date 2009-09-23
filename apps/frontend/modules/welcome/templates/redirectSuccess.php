<div class="span-12">

	<div class="box welcome-container">
	  
	 <dl class="boxed-links">
	   <dt><?php echo link_to("Request a Job", "@job_create"); ?></dt>
	     <dd>Request a photographer for your event or publication.</dd>
	   <dt>
	   <?php 
	     if($sf_user->hasCredential("admin")){
	       echo link_to("View Jobs", "@job_welcome");
       }elseif ($sf_user->hasCredential("client")){
         echo link_to("View Jobs", "client_myjobs_own", array("own" => "true"));
       }elseif($sf_user->hasCredential("photographer")){
         echo link_to("View Jobs", "client_myjobs_own");
       } 
     ?>
     </dt>
       <dd>View and edit requests, create and assign photographers, manage emails.</dd>
     <dt><?php echo link_to("View Photos", "@view_photos"); ?></dt>
      <dd>View photos from your projects and jobs.</dd>
	 </dl>
	 
	</div>
	
</div>