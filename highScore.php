<?php
 include('cookie.php');
?>
<html>
<head>
<title>certExams - Online Test</title>

<link REL=StyleSheet HREF="myStyle.css" TYPE="text/css">	

</head>
<body>
<br><br>
<table width="100%" cellspacing="1" cellpadding="5" border=1><tr>
 <td class="header" bgcolor="#EEEEEE" colspan="5"><center>Highest Scorers</center></td>
</tr>
<tr>
<th valign="top" bgcolor="#EEEEEE"><span class="small">Name</span></th>
<th valign="top" bgcolor="#EEEEEE"><span class="small">Test Name</span></th>
<th valign="top" bgcolor="#EEEEEE"><span class="small">Test ID & ver</span></th>
<th valign="top" bgcolor="#EEEEEE"><span class="small">Score</span></th>
<th valign="top" bgcolor="#EEEEEE"><span class="small">Date & Time taken</span></th>
</tr>


<?php
include('config.inc');

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

$q1 = mysqli_query($db_connect,"SELECT * FROM exam where questions > 0 ");
while ($srow = mysqli_fetch_row($q1))
{
 $examid = $srow[0];
 $title = $srow[1];
 $id = $srow[2];
 $version = $srow[3];
 $questions = $srow[4];

 $query = mysqli_query($db_connect,"select scoreid, scores.candidateID, firstName, lastName, max(marks), scores.date, timetaken, maxMarks from candidate, scores where scores.candidateID = candidate.candidateID and examid = '$examid' group by examid");
 while ($row = mysqli_fetch_row($query))
 {
if($row[7] != 0)
{
$per = round(($row[4]/$row[7])*100);
}
else
{
$per = 0;
} 
print <<< VIEW
<tr>
<td valign="top"><span class="small">$row[2] $row[3]</span></td>
<td valign="top"><span class="small">$title</span></td>
<td valign="top"><span class="small">$id $version</span></td>
<td valign="top"><span class="small">$per%</span></td>
<td valign="top"><span class="small">$row[5]<BR>$row[6]</span></td>
</tr>
VIEW;
 }
}
?>
</table>

</body>
</html>
