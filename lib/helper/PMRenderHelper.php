<?php

function getJobDetails( $job ){
$str = <<<EOF
----------------------------------------------
Job #: {$job->getId()}
Event: {$job->getEvent()}
Date: {$job->getDate("n/j/Y")} {$job->getStartTime()} to {$job->getEndTime()}

Location:
{$job->getStreet()}
{$job->getCity()}, {$job->getState()} {$job->getZip()}

Contact Name: {$job->getContactName()}
Contact Email: {$job->getContactEmail()}
Contact Phone: {$job->getContactPhone()}

EOF;

return $str;
}

function GoogleMapsInclude() {
	$key = sfConfig::get ( "app_gmap_key" );
	return '<script 
          src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=' . $key . '"
	        type="text/javascript"></script>';
}



function renderLog($log, $classNum) {
	?>
<div class="job-list-item-<?php
	echo $classNum?>">
<table class="job-table" width="100%">
	<col width="32%"></col>
	<col width="36%"></col>
	<col width="32%"></col>
	<tr>
		<td><?php
	echo $log->getWhen ( "F j, Y" );
	?></td>
		<td><?php
	echo $log->getMessageType ()->getType ();
	?></td>
		<td><?php
	echo $log->getMessage ();
	?></td>
		<td><?php
	echo $log->getUser ()->getUserName ();
	?></td>
	</tr>
	<tr>
		<td></td>
	</tr>
</table>
</div>
<?php
}

function renderClientRow($client, $classNum) {
  ?>
  <tr>
    <td>
      <?php echo link_to ( $client->getName (), "client_view", $client );?>
      [<?php echo mail_to ( $client->getEmail (), $client->getEmail () ); ?>]
    </td>
    <td><?php echo $client->getPhone (); ?></td>
    <td><?php echo link_to ( $client->getNumberOfJobs (), 
                  "client_view_jobs", array ("slug" => $client->getSlug () ) ); ?></td>
  </tr>
  <?php
}

function renderClient($client, $classNum) {
	?>
<div class="job-list-item-<?php
	echo $classNum?>">
<table class="job-table" width="100%">
	<col width="32%"></col>
	<col width="36%"></col>
	<col width="32%"></col>

	<tr>
		<td><?php
	echo link_to ( $client->getName (), "client_view", $client );
	?></td>
		<td><?php
	echo mail_to ( $client->getEmail (), $client->getEmail () );
	?></td>
	</tr>
	<tr>
		<td><?php
	echo $client->getDepartment ()?></td>
		<td><?php
	echo $client->getPhone ();
	?></td>
		<td align="center"><?php
	echo link_to ( $client->getNumberOfJobs () . " jobs", "client_view_jobs", array ("slug" => $client->getSlug () ) );
	?>
        
	
	</tr>
</table>
</div>
<?php
}

function renderPhotographerRow($photographer, $classNum) {
  ?>
  <tr>
    <td>
      <?php echo link_to ( $photographer->getName (), "photographer_view", $photographer ); ?>
      [<?php echo mail_to ( $photographer->getEmail (), $photographer->getEmail () ); ?>]
    </td>
    <td><?php echo $photographer->getPhone (); ?></td>
    <td><?php echo $photographer->getAffiliation ()?></td>
    <td><?php echo link_to ( $photographer->getNumberOfJobs (), 
                    "photographer_view_jobs", $photographer )?></td>
  </tr>
  <?php
}

function renderPhotographer($photographer, $classNum) {
	?>
<div class="job-list-item-<?php
	echo $classNum?>">
<table class="job-table" width="100%">
	<col width="32%"></col>
	<col width="36%"></col>
	<col width="32%"></col>
	<tr>
		<td><?php
	echo link_to ( $photographer->getName (), "photographer_view", $photographer );
	?></td>
		<td><?php
	echo mail_to ( $photographer->getEmail (), $photographer->getEmail () );
	?></td>
	</tr>
	<tr>
		<td><?php
	echo $photographer->getAffiliation ()?></td>
		<td><?php
	echo $photographer->getPhone ();
	?></td>
		<td align="center"><?php
	echo link_to ( $photographer->getNumberOfJobs () . " jobs", "photographer_view_jobs", $photographer )?></td>
	</tr>
</table>
</div>
<?php
}
 
function renderPublication($pub, $classNum) {
  ?>
<li class="job-list-item-<?php echo $classNum ?>">
    <?php echo $pub->getName(); ?>
  
    <a href="#" onclick="editPub(<?php echo $pub->getId()?>, '<?php echo $pub->getName()?>'); return false;">
      <?php echo image_tag("pencil.png", array("class" => "delete-img")); ?>
    </a>
    |
    <a href="#" onclick="deletePub(<?php echo $pub->getId()?>); return false;">
      <?php echo image_tag("delete.png", array("class" => "delete-img")); ?>
    </a>
    
</li>
<?php
}

function renderProjectTable( $project, $classNum ){
  ?>
    <tr>
      <td><?php echo $project->getName(); ?></td>
      <td><?php echo link_to ( $project->getNumberOfJobs(), "project_view", $project ); ?></td>
    </tr>
  <?php
}

function renderProject($project, $classNum) {
	?>
<div class="job-list-item-<?php
	echo $classNum?>">
<table class="job-table" width="100%">
	<tr>
		<td>
  	       <?php
	echo link_to ( $project->getName (), "project_view", $project );
	?>
  	     </td>
	</tr>
	<tr>
		<td>Contains <?php
	echo $project->getNumberOfJobs ();
	?> jobs</td>
	</tr>
</table>
</div>
<?php
}

function renderTagList($job) {
	$tags = $job->getTags ();
	
	foreach ( $tags as $key => $val ) {
		if(sfContext::getInstance()->getUser()->hasCredential("admin")){
		  echo "<span class='job-tag'>" . 
		    link_to ( $key, "job_listby_tag", array ("slug" => $key ) ) . 
		          " <a onclick='javascript:removeJobTag(\"" . $job->getId () . "\", \"" . $key . "\");' href='#'>" . 
		    image_tag ( "delete.png", array ("class" => "delete-img" ) ) . "</a></span>";
		}else{
			echo "<span class='job-tag'>" . $key . "</span>";
		}
	}

}

function renderJobListViewTableClient( $job, $class, $canAdd ){
  
  $showRoute = "clientview_job_show";
  $borderStyle = strtolower(str_replace(" ", "_", $job->getStatus ()->getState ())) . "_bordered";
?>
    <tr>
      <td class="<?php echo $borderStyle; ?>"><?php echo checkbox_tag ( 'job-' . $job->getId (), $job->getId(), 0, 
                                    array ("class" => "job-check" ) );?></td>
      <td class="<?php echo $borderStyle; ?>">
        <?php echo link_to ( $job->getId (), $showRoute, $job ); ?></td>
      <td class="<?php echo $borderStyle; ?>">
        <?php renderTagList ( $job ); ?></td>
      <td>
        <?php echo $job->getEvent(); ?>
      </td>
      <td>
       <?php 
       $clients = $job->getClients(); 
        if(count($clients) == 1){ 
          $n = array_pop($clients); echo $n;
        }else if(count($clients) > 1){
          $names = array();
          foreach( $clients as $n ){ $names[] = $n->__toString(); }
          echo "<span class='tooltip' title='" 
                . join(", ", $names) . "'>" . count( $clients ) . "</span>";
        }else{
          echo "-";
        }?>
      </td>
      <td>
      <?php
       $photogs = $job->getPhotographers ();
       if (count ( $photogs ) == 1) :
         $i = array_pop( $photogs );
         $name = truncate_text($i->getName(), "16"); 
         echo link_to ( $name, "photographer_view_jobs", $i );
       elseif (count ( $photogs ) == 0) :
          echo "-";
        else:
          echo count ( $photogs ) . " Assigned";
       endif;
      ?>
      </td>
      <td>
        <?php echo $job->getDate ( "n/j/Y" ) ?>
      </td>
      <?php if(sfContext::getInstance()->getUser()->hasCredential("client")): ?>
        <td><?php echo link_to_function( "Add me as client", "addClient(" . $job->getId() . ")"); ?></td>
     <?php endif; ?>
    </tr>
  <?php
}

function renderClientJobListView($job, $classNum, $canAdd) {
	?>
  <div class="job-list-item-<?php echo $classNum?>">
	  <?php
		$sTime = $job->getStartTime ();
		$eTime = $job->getEndTime ();
		$sTime = substr ( $sTime, - 8, 5 );
		$eTime = substr ( $eTime, - 8, 5 );
		?>
    <table class="job-table" width="100%">
			<col width="33%"></col>
			<col width="33%"></col>
	    <tr>
	     <td>
	       <?php if(sfContext::getInstance()->getUser()->hasCredential("client")): ?>
		       <?php if(JobClientPeer::isOwner($job->getId(), 
		                 sfContext::getInstance()->getUser()->getProfile()->getId())): ?>
		         Job <?php echo link_to($job->getId(), "clientview_job_show", $job); ?>
		       <?php else: ?>
		         Job <?php echo $job->getId (); ?>
		       <?php endif; ?>
	       <?php endif; ?>
	       
	      <?php if(sfContext::getInstance()->getUser()->hasCredential("photographer")): ?>
           <?php if(JobPhotographerPeer::isOwner($job->getId(), 
                     sfContext::getInstance()->getUser()->getProfile()->getId())): ?>
             Job <?php echo link_to($job->getId(), "clientview_job_show", $job); ?>
           <?php else: ?>
             Job <?php echo $job->getId (); ?>
           <?php endif; ?>
        <?php endif; ?>
	       
	     </td>
		   <td><?php echo $job->getEvent ();?></td>
		   
		   <?php if($canAdd && sfContext::getInstance()->getUser()->hasCredential("client")): ?>
		    <td><?php echo link_to_function("Add me as client", "addClient(" . $job->getId() . ")"); ?></td>
		   <?php endif; ?>
		   <td><?php 
		        if ($job->getProjectId ()) {
		          $title = $job->getProject ()->getName ();
		          $title = (substr ( $title, 0, 30 ) == $title) ? $title : substr ( $title, 0, 30 ) . "...";
		          echo "In " . $job->getProject ();
	          }?></td>
	     </tr>
	     <tr>
	 	   <td><?php echo $job->getDate ( "F j, Y" ) . " " . $sTime . " - " . $eTime?> </td>
	 	   <td><?php 
	 	     $clients = $job->getClients();
	 	     if(count($clients) == 0){
	 	     	echo "No Clients";
	 	     }else{
	 	     	echo "For ";
	 	     	foreach($clients as $c){
	 	       echo $c->getName() . " ";		
	 	     	}
	 	     }
	 	     
	 	   ?></td> 
       <?php
	       $photogs = $job->getPhotographers ();
	       if (count ( $photogs ) == 1) :
		        foreach ( $photogs as $i ):
			    ?>
           <td>
           <?php echo $i . " "; ?>
           </td>
        <?php endforeach; ?>
        <?php endif; ?>
        
	      <?php if(count($photogs) == 0): ?>
           <td> <?php echo "No Photographer"; ?> </td>
        <?php endif; ?>
	      
        <?php if(count($photogs) > 1): ?>
           <td> <?php echo count ( $photogs ) . " Photographers"; ?> </td>
       <?php endif; ?>
        </tr>
</table>
</div>
<?php
}

function renderJobListViewTable($job, $classNum, $renderStatus = false){
  $showRoute = "job_show";
  
  if( sfContext::getInstance()->getUser()->hasCredential("client") ){
    $showRoute = "clientview_job_show";
  }
  
  $borderStyle = strtolower(str_replace(" ", "_", $job->getStatus ()->getState ())) . "_bordered";
  
  
?>
    <tr>
      <td class="<?php echo $borderStyle; ?>"><?php echo checkbox_tag ( 'job-' . $job->getId (), $job->getId(), 0, 
                                    array ("class" => "job-check" ) );?></td>
      <td class="<?php echo $borderStyle; ?>">
        <?php echo link_to ( $job->getId (), $showRoute, $job ); ?></td>
      <td class="<?php echo $borderStyle; ?>">
        <?php renderTagList ( $job ); ?></td>
      <td>
        <?php echo $job->getEvent(); ?>
      
        <?php
          if ($job->getProjectId ()) {
            echo "[";
            $title = truncate_text($job->getProject ()->getName (), 10);
            if( $title == $job->getProject ()->getName () ){
              echo link_to ( $title, "project_view", $job->getProject () );
            }else{
              $titleLong = str_replace('"', "'", $job->getProject ()->getName ());
              echo link_to ( $title, "project_view", 
                  $job->getProject (), 
                  array("class" => "tooltip", "title" => $titleLong));
            }
            echo "]";
        }
      ?>
      </td>
      <td>
        <?php echo ($job->getEstimate()+$job->getProcessing()); ?>
      </td>
      <td>
       <?php 
       $clients = $job->getClients(); 
        if(count($clients) == 1){ 
          $n = array_pop($clients); echo $n;
        }else if(count($clients) > 1){
          $names = array();
          foreach( $clients as $n ){ $names[] = $n->__toString(); }
          echo "<span class='tooltip' title='" 
                . join(", ", $names) . "'>" . count( $clients ) . "</span>";
        }else{
          echo "-";
        }?>
      </td>
      <td>
      <?php
       $photogs = $job->getPhotographers ();
       if (count ( $photogs ) == 1) :
         $i = array_pop( $photogs );
         $name = truncate_text($i->getName(), "16"); 
         echo link_to ( $name, "photographer_view_jobs", $i );
       elseif (count ( $photogs ) == 0) :
          echo "-";
        else:
          echo count ( $photogs ) . " Assigned";
       endif;
      ?>
      </td>
      <td>
        <?php echo $job->getDate ( "n/j/Y" ) ?>
      </td>
    </tr>
<?php
}

function renderJobListView($job, $classNum, $renderStatus = false) {
	?>
<div class="job-list-item-<?php
	echo $classNum?>">
	<?php
	$sTime = $job->getStartTime ();
	$eTime = $job->getEndTime ();
	$sTime = substr ( $sTime, - 8, 5 );
	$eTime = substr ( $eTime, - 8, 5 );
	?>
	<table class="job-table" width="100%">
	<tr>
		<td style="width: 200px"><?php echo checkbox_tag ( 'job-' . $job->getId (), $job->getId (), 0, array ("class" => "job-check" ) );?> 
		    Job #<?php echo link_to ( $job->getId (), "job_show", $job ); ?></td>
		
		<td style="width: 250px"><small>Event:</small> <?php echo ( truncate_text($job->getEvent(), 24) == $job->getEvent () ) 
		            ? $job->getEvent () : "<span class='tooltip' title=\"" . str_replace('"', "'", $job->getEvent()) . "\">" . truncate_text($job->getEvent(), 30) . "<span>";?></td>
				
		<td style="width: 250px">       
		  <?php
			if ($job->getProjectId ()) {
				$title = truncate_text($job->getProject ()->getName (), 24);
				if( $title == $job->getProject ()->getName () ){
				  echo "<small>Project:</small> " . link_to ( $title, "project_view", $job->getProject () );
				}else{
					echo "<small>Project:</small> <span class='tooltip' title=\"" . 
					         str_replace('"', "'", $job->getProject ()->getName ()) . "\">" . link_to ( $title, "project_view", $job->getProject () ) . "</span>";
					
				}
			}
	   ?> 
    </td>
    
    <td style="width: 250px">
      <?php if ($renderStatus) : ?><small>Status:</small> <?php echo $job->getStatus ()->getState (); ?><?php endif; ?>
    </td>
    
	</tr>
	<tr>
		<td><?php echo $job->getDate ( "n/j/Y" ) . " " . $sTime . " - " . $eTime?></td>
	  <td><small>Tags:</small> <?php renderTagList ( $job ); ?></td>
    <?php
	     $photogs = $job->getPhotographers ();
	     if (count ( $photogs ) == 1) :
	       $i = array_pop( $photogs );
		 ?>
		    <td><small>Photographer:</small> <?php $name = truncate_text($i->getName(), "16"); echo link_to ( $name, "photographer_view_jobs", $i ) . " "; ?></td>
			<?php elseif (count ( $photogs ) == 0) : ?>
			    <td><small>Photographer:</small> None</td>
		  <?php else : ?>
		      <td><small>Photographer:</small> <?php echo count ( $photogs ); ?> Assigned</td>
	    <?php endif; ?>
	    
	   <td><?php $clients = $job->getClients(); ?>
	     <small>Client:</small>  
	     <?php if(count($clients) == 1){ 
	     	       $n = array_pop($clients); echo $n;
	           }else if(count($clients) > 1){
	             echo count( $clients );
             }else{
               echo "None";
             }?>
	   </td>
	</tr>
</table>
</div>
<?php
}
?>
