<?php
include('config.inc');
$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

$result =  mysqli_query($db_connect,"SELECT stime,sdata,activeid,status from active");
$n = 0;
while($re = mysqli_fetch_row($result))
     {
       $stime = $re[0];  
       $sdate = $re[1]; 
       $id = $re[2];
       $stat = $re[3];

$e_stime  = explode(":",$stime);
$e_sdate = explode("-",$sdate);
// Calculate login time stamp here
$hour = $e_stime[0];
$min = $e_stime[1];
$sec = $e_stime[2];
$year = $e_sdate[0];
$mon = $e_sdate[1];
$day = $e_sdate[2];
$log_timestamp = mktime($hour,$min,$sec,$mon,$day,$year);

// Calculate current time stamp here
  
$c_hour = date("H");   //Current Hour
$c_min = date("i");    //Current Minute
$c_sec = date("s");    //Current Second
$c_mon = date("m");    //Current Month
$c_day = date("d");    //Current Day
$c_year = date("Y");
$cur_timestamp = mktime($c_hour,$c_min,$c_sec,$c_mon,$c_day,$c_year);

// Calculate the diffference

$diff = $cur_timestamp - $log_timestamp;

if($stat == 'loggedin')
{
if($diff >= 86400)
{
$resultn =  mysqli_query($db_connect,"UPDATE active set ndate = CURDATE(), ntime=now(), status='loggedout' WHERE activeid='$id'");
$n = $n + 1;
}
}
}
print<<<AAA
<center>
<br>
<br><br><br>
<font color=FF0000 size=3>
AAA;
if($n > 0)
{
print<<<BBB
Users Logged in for more than 24 hours have been logged off<br>
Number of Users Logged Off: $n<br>
BBB;
}
else
{
print<<<CCC
No user found loggedin for more than 24 hours
CCC;
}
print<<<KKK
</font>
</center>
KKK;
?>
