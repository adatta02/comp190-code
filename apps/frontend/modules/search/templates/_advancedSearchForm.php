<script type="text/javascript">
  $(document).ready( function(){
  
    if($("#advancedsearch_has_photo").val().length){
      $("#advancedsearch_has_photo").attr("readonly", true);
    }
  
    if($("#advancedsearch_has_client").val().length){
      $("#advancedsearch_has_client").attr("readonly", true);
    }
  
    $("#advancedsearch_has_photo").autocomplete('<?php
				echo url_for ( "@photographer_autocomplete" )?>', $.extend({}, {
      dataType: 'json',
      parse:    function(data) {
                  var parsed = [];
                  var obj;
                  for(var i=0; i < data.length; i++){
                    obj = new Object();
                    obj.data = [data[i].name + " &lt;" + data[i].email + "&gt", data[i].id];
                    obj.value = data[i].name;
                    obj.result = data[i].name;
                    parsed.push(obj);
                  }
                  return parsed;
      }}, {width: 300}))
    .result(function(event, data) { 
      $("#advancedsearch_photo_id").val(data[1]);
      $("#advancedsearch_has_photo").attr("readonly", true); 
     });
    
    $("#advancedsearch_has_client").autocomplete('<?php
				echo url_for ( "@client_autocomplete" )?>', $.extend({}, {
      dataType: 'json',
      parse:    function(data) {
                  var parsed = [];
                  var obj;
                  for(var i=0; i < data.length; i++){
                    obj = new Object();
                    obj.data = [data[i].name + " &lt;" + data[i].email + "&gt", data[i].id];
                    obj.value = data[i].name;
                    obj.result = data[i].name;
                    parsed.push(obj);
                  }
                  return parsed;
      }}, {width: 300}))
    .result(function(event, data) { 
      $("#advancedsearch_client_id").val(data[1]); 
      $("#advancedsearch_has_client").attr("readonly", true);
     });
  });
  
  function clearPhoto(){
    $("#advancedsearch_has_photo").attr("readonly", false);
    $("#advancedsearch_photo_id").val("");
    $("#advancedsearch_has_photo").val("");
  }
  
  function clearClient(){
    $("#advancedsearch_has_client").attr("readonly", false);
    $("#advancedsearch_client_id").val("");
    $("#advancedsearch_has_client").val("");
  }
  
  function jumpToPage(page){
    $("#advancedsearch_page").val(page);
    $("#advanced_search_form").submit(); 
  }
  
  function inverSort(){
    
    if($("#advancedsearch_sort_direction").val() == 0){
      $("#advancedsearch_sort_direction").val(1);
      $("#sort-image").attr("src", "<?php echo image_path("arrow_down.png"); ?>");
    }else{
      $("#advancedsearch_sort_direction").val(0);
      $("#sort-image").attr("src", "<?php echo image_path("arrow_up.png"); ?>");
    }
    
  }
  
</script>

<h2>Advanced search</h2>
<div id="advanced-search-form">
    <?php
				echo form_tag ( "advanced_search_render", array("id" => "advanced_search_form"));
				?>
    <table>
      <?php
						echo $form ["status_id"]->renderRow ();
						?>
      
      <tr>
		<th>Due date range:</th>
		<td><?php
		echo $form ["due_date_start"]->render ();
		?> to <?php
		echo $form ["due_date_end"]->render ();
		?></td>
	</tr>

	<tr>
		<th>Shoot date range:</th>
		<td><?php
		echo $form ["shoot_date_start"]->render ();
		?> to <?php
		echo $form ["shoot_date_end"]->render ();
		?></td>
	</tr>
  
  <tr>
   <th>With Photographer</th>
   <td><?php echo $form["has_photo"]->render() . " " . link_to_function(image_tag("pencil.png", array("class" => "plus-img")), "clearPhoto()"); ?></td>
  </tr>
  
  <tr>
   <th>With Client</th>
   <td><?php echo $form["has_client"]->render() . " " . link_to_function(image_tag("pencil.png", array("class" => "plus-img")), "clearClient()"); ?></td>
  </tr>
  
  <tr>
   <th>Sort By</th>
   <td><?php 
        echo $form["sort"]->render();
        $sortImage = ($form["sort_direction"]->getValue() ? "arrow_down.png" : "arrow_up.png");
        echo link_to_function(image_tag($sortImage, array("class" => "plus-img", "id" => "sort-image")), "inverSort()");?> </td>
  </tr>
  
</table>
  
		<?php
				echo $form->renderHiddenFields ();
				echo submit_tag ( "Search" );
				?>
    </form>
</div>