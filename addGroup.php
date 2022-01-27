<?php
 include('cookie.php');
?>
<?php
 include('config.inc');

  $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

  if ($action = $_GET['action'])
   ;
  else
    $action = $_POST['action'];

  if ( $action == "edit")
  {
   $groupid = $_GET['groupid'];
   $result = mysqli_query($db_connect,"select * from groups where groupid = '$groupid'");
   $row = mysqli_fetch_row($result);
   $groupName = $row[1];
   $message = "Edit a group";
  }
  else if( $action == "doit")
  {
   $groupid = $_POST['groupid'];
	  if (($groupName = $_POST['groupName']) && ($groupid = $_POST['groupid']))
	  {
	   $result =  mysqli_query($db_connect,"update groups set groupName = '$groupName' where groupid = '$groupid' ");

   header('Location: '."viewGroup.php?message=Updation Done Sucessfully ");
 exit;
 	 }
  }

  else
  {
   $groupName = "";
   $message = "Add a group";
	  if ($groupName = $_POST['groupName'])
	  {
	   $result =  mysqli_query($db_connect,"insert into groups (groupid, groupName) 	values (NULL , '$groupName')");

   header('Location: '."viewGroup.php?message=Addition of Group Done Sucessfully");
 exit;
 	 }
  }

?>

<html>
<head>
 <title>certExams - online Test</title>
  <meta name="author" content="Ravishankar Bhatia">
 <meta name="copyright" content="Anandsoft.com">
 <link REL=StyleSheet HREF="myStyle.css" TYPE="text/css">	
</head>
<body>
<br> 
<center><h3><?php print("$message") ?></h3></center>
<center>
<div class="menu">
<form name= form method="post" action="addGroup.php">
<table>
<tr>
<td>
Enter a group name: <input type="text" name="groupName" value="<?php print("$groupName") ?>">
</td>
</tr>
<tr>
<td>

<?php
 if ($action == "edit")
  print ("\n<input type=\"hidden\" name=\"action\" value=\"doit\">\n");
  print ("\n<input type=\"hidden\" name=\"groupid\" value=\"$groupid\">\n");
?>

<input type="submit" name="submit" value="Submit!">
</td>
</tr>
</table>
</form>
</div>
</center>
<br><br>
</body>
</html>
