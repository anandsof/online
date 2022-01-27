<?php
 include('cookie.php');
?>
<html>
<head>
<title>certExams - Online Test</title>
<script LANGUAGE="JavaScript">

<link REL=StyleSheet HREF="myStyle.css" TYPE="text/css">	

</head>
<body>
<br><br>
<center>
<table width="50%" cellspacing="1" cellpadding="5" border=1><tr>
 <td class="header" bgcolor="#EEEEEE" colspan="2"><center>Number Of Registrants</center></td>
</tr>
<tr>
<th valign="top" bgcolor="#EEEEEE"><span class="small">No. Of Registrants</span></th>
<th valign="top" bgcolor="#EEEEEE"><span class="small">Group Name</span></th>
</tr>


<?php
include('config.inc');

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

 $ID = $_GET['ID'];

 $query = mysqli_query($db_connect,"select groupid from candidateGroup where candidateID = '$ID'");
  $row = mysqli_fetch_row($query);
	$groupid = $row[0];
  while($row = mysqli_fetch_row($query)) 
    $groupid .= ", ".$row[0];


 $query = mysqli_query($db_connect," select count(*), groupName from candidateGroup, groups where candidateGroup.groupid = groups.groupid and groups.groupid in ($groupid) group by groups.groupid");
 while ($row = mysqli_fetch_row($query))
 {

print <<< VIEW
<tr>
<td valign="top" align="center"><span class="small">$row[0]</span></td>
<td valign="top" align="center"><span class="small">$row[1]</span></td>
</tr>
VIEW;
 }

?>
</table>
</center>
</body>
</html>
