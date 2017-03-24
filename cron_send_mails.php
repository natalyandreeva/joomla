<?php



$dbh = mysqli_connect('localhost', 'onlinez1_zaim', 'http://online-zaim.kz/');

if ($dbh) {
    mysqli_select_db($dbh,"onlinez1_onlinezaim");
    $query1 = "SELECT * from zayavki where send_info=0";
    $result = mysqli_query($dbh, $query1);

   
   
}	

?>