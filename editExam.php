<?php
 include('cookie.php');
?>
<html>
<head>
	<title>Edit Exam</title>
<link REL=StyleSheet HREF="style.css" TYPE="text/css">
</head>
<body>

<?php
 include('config.inc');

 $examid = $_GET['examid'];

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

  $result =  mysqli_query($db_connect,"SELECT * FROM exam WHERE examid = '$examid'");
  $row = mysqli_fetch_row($result);

$result_s =  mysqli_query($db_connect,"SELECT * FROM serial_prefixes WHERE examid = '$examid'");
$row_s = mysqli_fetch_row($result_s);
print <<< ENDEDIT

<h3>Edit $row[1]</h3>
<form action="createTest.php" method="post">
<table>

<tr>
       <td align='right' bgcolor='#dfdfdf'>Group ID:</td>
       <td><input name="gpid" type="text" value="$row_s[3]" size='5'></td>
</tr>

<tr>
       <td align='right' bgcolor='#dfdfdf'>Serial Prefix: </td>
       <td><input name="prefix" type="text" value="$row_s[2]" size='25'></td>
</tr>

<tr>
       <td align='right' bgcolor='#dfdfdf'>Exam Title: </td>
       <td><input name="title" type="text" value="$row[1]" size='50'></td>
</tr>

<tr>
      <td align='right' bgcolor='#dfdfdf'>Exam Title On Question Page: </td>
      <td><input name="etitleqpage" type="text" value="$row[13]" size='50'></td>
</tr>



<tr>
       <td align='right' valign='top' bgcolor='#dfdfdf'>Exam ID: </td>
       <td><input name="id" type="text" value="$row[2]" size='20'></td>
</tr>
<tr>
       <td align='right' valign='top' bgcolor='#dfdfdf'>Version: </td>
       <td><input name="version" type="text" value="$row[3]" size='20'></td>
</tr>

<tr>
       <td align='right' valign='top' bgcolor='#dfdfdf'>Exam Instructions: </td>

       <td><textarea name="instructions" rows=4 cols=60 >$row[4]</textarea></td>
</tr>
<tr>
       <td align='right' valign='top' bgcolor='#dfdfdf'>&nbsp; </td>
       <td><input name="action" type="hidden" value="edit">
 <input name="examid" type="hidden" value="$examid">
 <input name="gropid" type="hidden" value="$row[12]">
	   <input type="submit" name="submit" value="Save Changes"> <BR><font color=RED><small> (After clicking on this button you can Add/View/Edit all the Questions belonging to this Exam) </small></font></td>
</tr>
<tr>
       <td align='right' valign='top' bgcolor='#dfdfdf'>&nbsp; </td>
       <td> <a href="javascript:history.go(-1)"><< back</a></td>
</tr>
</table>
</form>
ENDEDIT;

?>
</body>
</html>
