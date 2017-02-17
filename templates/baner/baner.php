<?php
 //if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
// {
//   $ip=$_SERVER['HTTP_CLIENT_IP'];
// }
// elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
// {
//  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
// }
// else
// {
//   $ip=$_SERVER['REMOTE_ADDR'];
// }

 echo "<div id=\"ja-container\">";
  echo "<div id=\"main clearfix\">";
   echo "<div id=\"ja-main\"\ style=\"\width:70%\">";  
   echo "<div class=\"inner clearfix\">";
    echo "<div id=\"nivoslider\" class=\"nivoSlider\" style=\"width: 707px; height: 514px\">";
     echo "<a href=\"\" target=\"_blank\"><img src=\"images/comandir-3.jpg\" /></a>";
     echo "<a href=\"\" target=\"_blank\"><img src=\"images/Comandir-promo-bf.jpg\" /></a>";
     echo "<a href=\"\" target=\"_blank\"><img src=\"images/comandir-20dp.jpg\" /></a>";
     echo "<img src=\"images/comandir-v3.jpg\" />";
     echo "<a href=\"\" target=\"_blank\"><img src=\"images/comandir-mk.jpg\" /></a>";
     echo "<a href=\"\" target=\"_blank\"><img src=\"images/comandir_podarok.jpg\" /></a>";
     echo "<a href=\"\" target=\"_blank\"><img src=\"images/comandir-rass.jpg\" /></a>";
     echo "<a href=\"\"><img src=\"images/Comandir-halva.jpg\" /></a>";
    echo "</div>";
   echo "</div>";
   echo "</div>";
  echo "</div>";  
echo "</div>";
?>
<script type="text/javascript">
    jQuery(window).load(function() {
        jQuery('#nivoslider').nivoSlider({pauseTime: 8000,effect:'fade'});
    });
    </script>