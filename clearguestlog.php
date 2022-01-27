<?php
include('cookie.php');
include('config.inc');
$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);
$result =  mysqli_query($db_connect,"Delete FROM Guests");
print("<br><br><br><br><br><b><center><h2>Guest Log Cleared</h2></center></b>");
?>