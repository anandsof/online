<?php
$username = $_GET['user_name'];
include('config.inc');
$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);
$resultnn =  mysqli_query($db_connect,"SELECT lnumber FROM plogins WHERE userName = '$username'");
$resnn = mysqli_fetch_row($resultnn);
if($resnn[0])
{
print("");
$resultk = mysqli_query($db_connect,"SELECT activeid FROM active WHERE userName='$username' AND status='loggedin'");
$i = 0;
while($reskk = mysqli_fetch_row($resultk))
{
$values[$i] = $reskk[0];
$i = $i + 1;
}
$longactive = min($values); 

$result =  mysqli_query($db_connect,"UPDATE active SET status='loggedout'  WHERE activeid ='$longactive'");
}
else
{
$result =  mysqli_query($db_connect,"UPDATE active SET status='loggedout'  WHERE userName='$username'");
}
print<<<AAA
<b><font color="RED"><center><big><big><big>Old entries logged off</big></big></big></font></b><br><br><br> you will be re directed to relogin again with in a few seconds</center>
AAA;
print<<<AAA1
<script language="javascript">
location.href="index.php";
</script>
AAA1;
?>