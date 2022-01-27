<?php
$ipaddress = $_SERVER["REMOTE_ADDR"];
include('config.inc');
$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);
$result =  mysqli_query($db_connect,"INSERT INTO Guests (sno,ipaddress,logintime,logindate) VALUES('','$ipaddress',now(),CURDATE())");
?>