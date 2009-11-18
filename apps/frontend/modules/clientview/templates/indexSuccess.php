<?php use_helper("PMRender"); ?>

<script type="text/javascript">
  ProjectManager.sortUrls = <?php echo $sortUrlJson; ?>;
  ProjectManager.currentKey = "<?php echo $sortedBy; ?>";
  ProjectManager.isInverted = <?php echo ($invert ? 1 : 0) ?>;
</script>

<div class="span-6">
  <?php include_component ( "static", "userShortcuts",
                          array("sortedBy" => $sortedBy,
                                "viewingCurrent" => null,
                                "noSort" => false) ); ?>
</div>

<div class="span-17 last job-container">
  <div class="box" id="content-container">
  
    <div id="now-viewing">Viewing <?php echo ($own ? "My Jobs" : "All Jobs") ?></div>
    
    <div id="server-msg"></div>

    <table>
      <tbody>
        <tr>
          <th></th>
          <th>ID</th>
          <th>Tags</th>
          <th>Event</th>
          <th>Client</th>
          <th>Photographer</th>
          <th>Date</th>
          <th></th>
        </tr>

    <?php
    $count = 0;
    foreach($pager->getResults() as $i){
      renderJobListViewTableClient($i, (($count % 2 == 0) ? "1" : "2"), !$own);
      $count += 1;
    }
    ?>
  
    </tbody>
 </table>
    <?php include_component("static", 
                        "pager", 
                         array("pager" => $pager, 
                               "url" => "client_myjobs_own",
                               "params" => array("own" => $own, "all" => $all))); ?>

  </div>
</div>

<script type="text/javascript">
  activateMouseOvers();
  
  function addClient(jobId){
    var res = confirm("Are you sure you want to be added as a client?");
    if(res){
      $("#server-msg").load('<?php echo url_for("@request_add_job")?>', {id: jobId});
    }
  }
</script>