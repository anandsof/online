<?php
 include('cookie.php');
?>
<?php
 include('config.inc');

 if ($examid = $_POST['examid'])
  ;
 else
  $examid = $_GET['examid'];

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

 if ($_POST['submit'] == "Create Exam")
 {
   $title = $_POST['title'];
   $id = $_POST['id'];
   $version = $_POST['version'];
   $instructions = $_POST['instructions'];
   $groupName = $_POST['groupName'];
   $candidateID = $_POST['candidateID'];
$prefix = $_POST['prefix'];
  $result =  mysqli_query($db_connect,"SELECT CURDATE()");
  $row = mysqli_fetch_row($result);
  $date = $row[0];
echo "dgdgd";
  $query = "insert into exam (examid,title,id,version,instructions,date,groupid)  VALUES (NULL, '$title', '$id', '$version', '$instructions', '$date', '$groupName')";
  echo $query;
  $result = mysqli_query($db_connect,$query);
  
     $query = mysqli_query($db_connect,"SELECT LAST_INSERT_ID()");
     $row = mysqli_fetch_row($query);
     $examid = $row[0]; 
     $result = mysqli_query($db_connect,"INSERT INTO examPermissions (candidateID, examid) VALUES ('$candidateID','$examid' )");
     $result_sinsert = mysqli_query($db_connect,"INSERT INTO serial_prefixes values('','$examid','$prefix','$groupName')");
 }

// to save the changes

if ($_POST['submit'] == "Save Changes")
 {
   $title = $_POST['title'];
   $id = $_POST['id'];
   $version = $_POST['version'];
   $instructions = $_POST['instructions'];
   $etitleqpage = $_POST['etitleqpage'];
  //done by naresh

  $prefix = $_POST['prefix'];
  $gpid = $_POST['gpid'];
  $resultnaresh = mysqli_query($db_connect,"SELECT prefix from serial_prefixes WHERE examid='$examid'");

  $row_nar = mysqli_fetch_row($resultnaresh);

  if(!$row_nar[0])
  {
   $result_sinsert = mysqli_query($db_connect,"INSERT INTO serial_prefixes values('','$examid','$prefix','$gpid')");
  }
  else
  {
   $result_t = mysqli_query($db_connect,"UPDATE serial_prefixes SET prefix='$prefix', groupid='$gpid' WHERE examid='$examid'"); 
  } 
  $result =  mysqli_query($db_connect,"SELECT CURDATE()");
  $row = mysqli_fetch_row($result);
  $date = $row[0];

  $query = "UPDATE exam SET 
                title = '$title',
                id  = '$id',
                version  = '$version',
                instructions  = '$instructions',
                examtitlequestionpage = '$etitleqpage'
             WHERE examid = '$examid'";
  $result = mysqli_query($db_connect,$query);
 }
?>
<html>
<head>
<title>Online-test</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link REL=StyleSheet HREF="style.css" TYPE="text/css">
</head>
<body>

<div align="right"><small><a href="javascript:onclick=parent.resizeFrame('0,*')"> 
Change Screen Layout</a><BR><small>(click for fullscreen and click again for normal screen)</small></small></div>

<center>
<H1><?php 
$query = mysqli_query($db_connect,"SELECT title FROM exam WHERE examid = '$examid'"); 
$row = mysqli_fetch_row($query);
 print $row[0];  ?><br></H1>
</center>
<table width='100%' border='0'>
<ul>
<tr><td colspan ='2' bgcolor='#dfdfdf'> <h3>Add Questions</h3> </td></tr>
<tr>
<td align='right' bgcolor='#dfdfdf'><li></td>
<td>  <a href="multipleChoiceSingle.php?examid=<?php print $examid;?>"> Multiple choice questions</a><small>(single select)</small></li> </td>
</tr>
<tr>
<td align='right' bgcolor='#dfdfdf'><li></td>
<td>  <a href="multipleChoiceMultiple.php?examid=<?php print $examid;?>"> Multiple choice questions</a><small>(multiple select)</small></li> </td>
</tr>
<tr>
<td align='right' bgcolor='#dfdfdf'><li></td>
<td>  <a href="trueFalse.php?examid=<?php print $examid;?>"> True/False questions</a></li> </td>
</tr>
<tr>
<td align='right' bgcolor='#dfdfdf'><li></td>
<td>  <a href="shortAnswer.php?examid=<?php print $examid;?>"> Essay or Short Answer Question</a></li> </td>
</tr>
<tr>
<td align='right' bgcolor='#dfdfdf'><li></td>
<td>  <a href="dragDrop.php?examid=<?php print $examid;?>"> Match making Questions</a><small>(Drag and Drop)</small></li> </td>
</tr>
</ul>
</table>
<BR>

<table width='100%' border='0'>
<tr><td colspan='2' bgcolor='#dfdfdf'> <h3>Browse Questions</h3> </td></tr>
<form action='editTest.php?action=show' method='POST'>
<tr>
<td align='right' bgcolor='#dfdfdf'>Category: </td>
<td><select name='category'> 
    <option value='ALL'>SHOW ALL  

   <?php
      $res =  mysqli_query($db_connect,"SELECT DISTINCT category FROM question WHERE examid = '$examid'");
      while($cat = mysqli_fetch_row($res))
//      if($cat[0] != 'None') 
	    print("<option value=$cat[0]>$cat[0]");  
   ?>
</select>
</td>
</tr>
<tr>
 <td align='right' bgcolor='#dfdfdf'>Question Type: </td><td>
    <select name='type'>
     <option value='ALL'>SHOW ALL
     <option value='mcs'>Multiple Choice Single Select
     <option value='mcm'>Multiple Choice Multiple Select
     <option value='tf'>True False
     <option value='sa'>Essay or Short Answer
     <option value='dd'>Matching - Drag and Drop
    </select>
</td>
</tr>

  <tr>
    <td bgcolor='#dfdfdf'>&nbsp;</td>
    <td>
<input name="examid" type="hidden" value=<?php print("$examid") ?> >
      <input type='hidden' name="action" value="show">
      <input type='submit' value='Show Questions'></td>
  </tr>
</form>
</table>
 <hr width='100%' align='left'>

<!-- End of the top selection -->



</body>
</html>
