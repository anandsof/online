<?php
 include('cookie.php');
?>
<html>
<head>
	<title>Exam Builder</title>
<link REL=StyleSheet HREF="style.css" TYPE="text/css">
</head>
<body>
<h3>Add a New Exam</h3>
<form action="createTest.php" method="post"  onSubmit="validate();return returnVal;">

<?php

 include('config.inc');
 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);
 
  $ID = $_GET['ID'];

?>

<table>
<tr>
       <td align='right' bgcolor='#dfdfdf'>Exam Title: </td>
       <td><input name="title" type="text" value="" size='50'></td>
</tr>
<tr>
       <td align='right' valign='top' bgcolor='#dfdfdf'>Exam ID: </td>
       <td><input name="id" type="text" size='20'></td>
</tr>
<tr>
       <td align='right' valign='top' bgcolor='#dfdfdf'>Version: </td>
       <td><input name="version" type="text" size='20'></td>
</tr>

<tr>
       <td align='right' bgcolor='#dfdfdf'>Exam Group: </td>
       <td>
 <select name='groupName'> 
<?php

// check wheather admin or not
   $result =  ("select admin from candidate where candidateID = '$ID'");
   $query = mysqli_query($db_connect,$result);
   $grow = mysqli_fetch_row($query);
   $admin = $grow[0];

  if($admin == 1)
     $result = ("select * from groups");
  else
     $result =  ("select groups.groupid, groupName from groups,groupPermissions where groups.groupid = groupPermissions.groupid and candidateID = '$ID'");
  $query = mysqli_query($db_connect,$result);
  while ( $grow = mysqli_fetch_row($query))
    print ("\n<option $sch value=$grow[0]>$grow[1]");

?>
</select>
</td>
</tr>

<tr>
       <td align='right' valign='top' bgcolor='#dfdfdf'>Exam Instructions: </td>

       <td><textarea name="instructions" rows=4 cols=60 ></textarea></td>
</tr>
<tr>
       <td align='right' valign='top' bgcolor='#dfdfdf'>&nbsp; </td>
       <td><input name="action" type="hidden" value="new">
	   <input name="candidateID" type="hidden" value="<?php print("$ID")?>">
	   <input type="submit" name="submit" value="Create Exam"></td>
</tr>

</table>


</form>


</body>
</html>
