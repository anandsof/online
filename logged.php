<?php
include('config.inc');
$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);
$cookname = $_COOKIE['PHPSESSID'];
#print("cookie value is<br>");
#print("$cookname<br>");
$result = mysqli_query($db_connect,"SELECT status FROM active WHERE value='$cookname' and stime=CurDATE()");
$row = mysqli_fetch_row($result);
#print("status is<br>");
#print("$row[0]<br>");
#print("bye");
if($row[0] == 'loggedout')
{
print<<<AAA
<br><br><br<br><br>
<center><font color="RED">you are logged out <br>Thank you</font></center>
AAA;
exit;
}
?>