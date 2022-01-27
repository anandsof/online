<html>
<head>
 <title>certExams</title>
 <meta name="author" content="Ravishankar Bhatia" />

<link REL=StyleSheet HREF="myStyle.css" TYPE="text/css">
</head>
<body>
<BR>
<BR>
<center>
<table width="100%" cellspacing="1" cellpadding="5" border=1><tr>
 <td class="header" bgcolor="#EEEEEE" colspan="20">
	<center>Guests Log</center>
</td>
</tr>
<tr>
<tr>
<th  valign="top" bgcolor="#EEEEEE"><span class="small">ID</span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small">Ipaddress</span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small">Login Date</span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small">Login Time</span></th>
</tr>

<?php
include('config.inc');
 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);
$query = mysqli_query($db_connect,"SELECT * FROM Guests");
$i = 0 ;
$no_of_rows = 10;
$start = $_GET['start'];
$query1 = mysqli_query($db_connect,"SELECT MAX(sno) from Guests");
while ($row1 = mysqli_fetch_row($query1))
{
$max = $row1[0];
}
while ($row = mysqli_fetch_row($query))
{
$start1 = $row[0];
if($start1 >= $start)
{ 
$i = $i + 1;
if($i <= $no_of_rows)
{
if(!$row[0])
{
$row[0] = '-';
}
if(!$row[1])
{
$row[1] = '-';
}
if(!$row[2])
{
$row[2] = '-';
}
if(!$row[3])
{
$row[3] = '-';
}
print <<< VIEW
<tr>
<td valign="top" align="center"><span class="small">$row[0]</span></td>
<td valign="top" align="center"><span class="small">$row[1]</span></td>
<td valign="top" align="center"><span class="small">$row[3]</span></td>
<td valign="top" align="center"><span class="small">$row[2]</span></td>
</tr>
VIEW;
$flag = $row[0];
}
}
if($i > $no_of_rows)
{
break;
}
}
if($flag < $max)
{
$next = 1;
$previous = $start1 - 20;
}
else
{
$previous = $start1 - 10;
}
if($previous < 1)
{
$previous = 0;
}
$tens = $max % 10;
if($tens == 0)
{
$last = $max - 10;
$last = $last + 1;
}
else
{
$last = $max - $tens;
$last = $last + 1;
#$tens = $max / 10;
#$last = $tens * 10;
}
if($previous)
{
print<<<JJJ
</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<<<a href="guestslog.php?start=1">First</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<<a href="guestslog.php?start=$previous">Previous</a>
JJJ;
}
if($next)
{
print<<<DD
</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="guestslog.php?start=$start1">Next</a>>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="guestslog.php?start=$last">Last</a>>>
DD;
}
else
{
print<<<DD
</table>
DD;
}
?>
</center>
<BR><BR>
</body>
</html>




