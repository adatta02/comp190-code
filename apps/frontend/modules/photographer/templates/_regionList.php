<?php use_helper("JavascriptBase"); ?>
<table> 
  <?php
   foreach ($photographer->getPhotographerRegions() as $pr): ?>
   <tr>
     <th><?php echo $pr->getAddress(); ?></th>
     <th><?php echo link_to_function("Delete", 
                      "deleteLocation(" . $pr->getId() . ", '" . $pr->getAddress() . "')") ?></th>
    </tr>  
  <?php endforeach; ?>
</table>