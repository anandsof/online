<?php
 include('cookie.php');
?>
<html>
<head>
 <title>certExams</title>
 <meta name="author" content="Ravishankar Bhatia" />

<link REL=StyleSheet HREF="myStyle.css" TYPE="text/css">
</head>

<body>
<BR>
<BR>

<?php

 include('config.inc');
 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);
?>

<center>
<table width="75%" cellspacing="1" cellpadding="5" border=1><tr>
 <td class="header" bgcolor="#EEEEEE" colspan="3">
	<center>Active Users</center>
</td>
</tr>

<tr>
<tr>
<th  valign="top" bgcolor="#EEEEEE"><span class="small">Candidate ID</span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small">User Name</span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small">Name</span></th>
</tr>

<?php

$query = mysqli_query($db_connect,"SELECT candidateID, candidate.userName, firstName, lastName FROM active, candidate WHERE candidate.userName = active.userName AND active.status='loggedin'");

while ($row = mysqli_fetch_row($query))
{
print <<< VIEW
<tr>
<td valign="top"><span class="small">$row[0]</span></td>
<td valign="top"><span class="small">$row[1]</span></td>
<td valign="top"><span class="small">$row[2] $row[3]</span></td>
</tr>
VIEW;
}
?>
</table>
</center>
<BR><BR>

</body>
</html>
