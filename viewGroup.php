<?php
 include('cookie.php');
?>
<html>
<head>
 <title>brains@work</title>
 <meta name="author" content="Ravishankar Bhatia" />
<script language="JavaScript">	

function confirmSubmit()
{
	 var agree=confirm("Are you sure you want to delete this result? This action cannot be undone.");
 if (agree)
  return true ;
 else
  return false ;
}
</script>

<link REL=StyleSheet HREF="myStyle.css" TYPE="text/css">
</head>

<body>
<BR>
<BR>

<?php

 include('config.inc');
 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

  $action = $_GET['action'];
  $groupid = $_GET['groupid'];
  $message = $_GET['message'];
  
  if ($action == 'delete')
  {
   $query = "delete from groups where groupid = '$groupid'";
   $result = mysqli_query($db_connect,$query);
   $message = "Deletion of Group done Successfully";
  }

  $resultTemp = "select * from groups ";
  //$result =  mysqli_query($db_connect,"select * from groups ");

 $direction = $_GET['direction'];

 if (!isSet($direction))
 {
  $direction = 'ASC';
  $new_direction = 'DESC';
 }

 if ($direction == 'ASC')
   $new_direction = 'DESC';
 else
   $new_direction = 'ASC'; 



print <<< MAIN
<font color=green>$message</font>
<table width="100%" cellspacing="1" cellpadding="5" border=1><tr>
 <td class="header" bgcolor="#EEEEEE" colspan="4"><center>Groups</center>
</td>
</tr>
<tr>
<tr>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="viewGroup.php?sortOrder=groupid&amp;direction=$new_direction">Group ID</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="viewGroup.php?sortOrder=groupName&amp;direction=$new_direction">Group Name</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small">Edit</span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small">Delete</span></th>
</tr>
MAIN;


    $sortOrder = $_GET['sortOrder'];

    if (($sortOrder == "groupName") || (empty($sortOrder)))
    {
        $sortOrder = 'groups.groupName';
    }
    if ($sortOrder == "groupid")
    {
        $sortOrder = 'groups.groupid';
    }
    $resultTemp = $resultTemp . " ORDER BY $sortOrder $direction";
   //$result .= " ORDER BY $sortOrder $direction"; 

  $query = mysqli_query($db_connect,$resultTemp);

while ($row = mysqli_fetch_row($query))
{
$flag = 1;
print <<< VIEW
<tr>
<td valign="top"><span class="small">$row[0]</span></td>
<td valign="top"><span class="small">$row[1]</span></td>
<td valign="top"><span class="small"><a href="addGroup.php?groupid=$row[0]&action=edit"><img src='pencil.gif' alt='view this result' border='0'>Edit</a></span></td>
<td valign="top"><span class="small"><a onclick="return confirmSubmit()" href="viewGroup.php?action=delete&groupid=$row[0]"><img src='trashcan.gif' alt='Delete this Exam' border='0'></a></span></td>
</tr>
VIEW;
}

if ($flag != 1)
 print ("<tr><td colspan=4> No results found </td></tr>");
?>

</table>
<BR><BR>

</body>
</html>
