<?php
 include('cookie.php');
if($action = $_GET['action']);
?>
<html>
<head>
<script LANGUAGE="JavaScript">
<!--
function confirmSubmit()
	{
	 var agree=confirm("Are you sure you wish to delete this question? This action cannot be undone.");
	 if (agree)
	  return true ;
	 else
	  return false ;
	}
// -->
</SCRIPT>
<link REL=StyleSheet HREF="style.css" TYPE="text/css">
</head>
<body>

<div align="right"><small><a href="javascript:onclick=parent.resizeFrame('0,*')">Change Screen Layout</a><BR><small>(click for fullscreen and click again for normal screen)</small></small></div>

<?php
 include('config.inc');
  $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

 if ($examid = $_POST['examid'])
  ;
 else
  $examid = $_GET['examid'];
 
  $action = $_GET['action'];
  $id = $_GET['id'];
  
  if ($action == 'delete')
  {
   $query = "UPDATE question SET used = 0 WHERE questionid = '$id'";
   $result = mysqli_query($db_connect,$query);

   $query = mysqli_query($db_connect,"select COUNT(*) from question where examid='$examid' and used = 1");
   $row = mysqli_fetch_row($query);
   $count = $row[0];
 $query = mysqli_query($db_connect,"select questions from exam where examid='$examid'");  
   $row = mysqli_fetch_row($query);
   $cques = $row[0];
   if ($cques > $count)
   {
   $query = "UPDATE exam SET questions = '$count' WHERE examid = '$examid'";
   $result = mysqli_query($db_connect,$query);
   }
  }
?>

<!-- Start of the top selection -->

<table width='100%' border='0'>
<form action='editTest.php?action=show' method='POST'>
<tr>
<td align='right' bgcolor='#dfdfdf'>Category: </td>
<td><select name='category'> 
    <option value='ALL'>SHOW ALL  

   <?php
      $res =  mysqli_query($db_connect,"SELECT DISTINCT category FROM question WHERE examid='$examid' ");
      while($cat = mysqli_fetch_row($res))
	{
//        if($cat[0] != 'None') 
	$cat[0] = stripslashes($cat[0]);
	    print("<option value=\"$cat[0]\">$cat[0]");  
	}
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

<?php

// To show the questions

if($action == "show")
{
 if ($category = $_POST['category']) ;
 else  $category = $_GET['category'];
 if ($type = $_POST['type']);
 else $type = $_GET['type'];

  $query = "select * from question where examid = '$examid' and used = 1";

 if($nextqid = $_GET['nextqid'])
 {
   $query .= " and questionid > $nextqid";
   $sno = $_GET['sno'];
 }
 $serno = $sno + 1;

 $previd = $nextqid;
 $category = addslashes($category);

 if ($category != 'ALL') 
   $query .= " and category = '$category' ";
 if ($type != 'ALL') 
   $query .= " and type = '$type' ";

 $query .= " order by questionid";

  #print("$query<br>");
 
  $result = mysqli_query($db_connect,$query);

 print ("<table width=\"100%\" border=\"0\" cellspacing=\"0\" bgcolor=\"#efefef\">");
if(!$sno)
{
$sno = 0;
}
$qno = 1;
  while ($row = mysqli_fetch_row($result))
  {
 if($qno <= 25)
 {
  $sno++;
  print("<tr><td colspan=\"3\" width=\"100%\" bgcolor=\"#ffffd7\">
     <big><b>$sno</b></big>
   <a href=\"editQuestion.php?action=edit&id=$row[0]&examid=$examid&type=$row[14]\"><img src=\"edit.gif\" alt=\"Edit question\" border=\"0\" align=\"center\">Edit Question</a> 
    <a onclick=\"return confirmSubmit()\" href=\"editTest.php?action=delete&id=$row[0]&examid=$examid\"><img src=\"trashcan.gif\" alt=\"Delete quesion from database\" border=\"0\">Delete Question</a>
   </td></tr> <tr> <td valign=\"top\" width=\"4%\"></td>");

	$row[1] = stripslashes($row[1]);

   print("<td colspan=\"2\" width=\"92%\"> $row[1] </td> </tr>");


  for ($col = 2, $a = 'a' ; $col <= 7 ; $col++,$a++)
  {
   
   if ($row[$col])
   {
    print ("<tr><td width=\"4%\"></td><td width=\"2%\"></td><td width=\"92%\">");
	$row[$col] = stripslashes($row[$col]);
  if($row[14] == 'dd') 
  {
   $match = explode("-1-1-1-",$row[$col]);
	$match[0] = stripslashes($match[0]);
	$match[1] = stripslashes($match[1]);
    print ("$match[0]<BR><b>Correct Match: $match[1]</b>");
  }
  else if($row[14] == 'mcm')
    print ("<input name=\"\" type=\"checkbox\" value=$col>$a) $row[$col]");
  else
    print ("<input name=\"\" type=\"radio\" value = $col >$a) $row[$col]");
    print ("</td></tr>");
   }
  }
	$row[8] = stripslashes($row[8]);
 if($row[14] != 'dd')
  print ("<tr><td width=\"4%\"></td><td width=\"2%\"></td><td width=\"92%\"><b> Correct Answer: $row[8]</b></td></tr>");

}
$qno = $qno + 1;
if($qno == 26)
{
$nextqid = $row[0];
}
}

if(!mysqli_num_rows($result))
{
 print("<tr><td width=\"4%\"></td><td width=\"2%\"></td><td width=\"92%\"><font color=RED> No Result Found, Try to search another </font></td></tr>");
}
 print("<tr bgcolor=\"#ffffd7\"><td width=\"4%\"></td><td width=\"2%\"></td><td width=\"92%\"><a href=\"createTest.php?examid=$examid\">Back To Selection</a></td></tr>");
 print ("</Table>");

}  /* End of show */



#print("serno --- $serno<br>previd-------$previd<br>nextqid--------$nextqid");

if($serno > 25)
{

$query11 = "select questionid from question where examid = '$examid' and used = 1";

 if($previd)
 {
   $query11 .= " and questionid < $previd";
   $snop = $sno - 50;
 }

 $category = addslashes($category);

 if ($category != 'ALL') 
   $query11 .= " and category = '$category' ";
 if ($type != 'ALL') 
   $query11 .= " and type = '$type' ";

 $query11 .= " order by questionid DESC";
 $result11 = mysqli_query($db_connect,$query11);

 $i = 1;
 while ($row11 = mysqli_fetch_row($result11))
 {
  if($i == 24)
  {
   $prev = $row11[0];
   last;
  }
  $i = $i + 1;
  }    
$prev = $prev - 1;
}
print("<center>");
if($prev)
{
print<<<AAA
<a href="editTest.php?&sno=$snop&action=show&category=$category&type=$type&nextqid=$prev&examid=$examid">Previous</a>
AAA;
}
if($qno >= 25)
{
print<<<AAA
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="editTest.php?&sno=$sno&action=show&category=$category&type=$type&nextqid=$nextqid&examid=$examid">Next</a>
AAA;
}
print("</center>");
?>

</body>
</html>
