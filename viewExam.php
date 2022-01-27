<?php
 include('cookie.php');
?>
<html>
<head>
	<title>Edit / Delete Exams</title>
	<script language="JavaScript">	
		function confirmSubmit()
	{
	 var agree=confirm("Are you sure you wish to delete this exam? This action cannot be undone. The questions in the database will also be deleted.");
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
<table width="100%" cellspacing="1" cellpadding="5" border=1>
<tr>
 <td class="header" bgcolor="#EEEEEE" colspan="10"><font color=BLUE><center><big><b>Exams</b></big></center></font>
 </td>
</tr>
<tr>
<th  valign="top" align=center width=250 bgcolor="#EEEEEE"><span class="small">Exam Title</span></th>
<th  valign="top" align=center bgcolor="#EEEEEE"><span class="small">Exam ID</span></th>
<th  valign="top" align=center bgcolor="#EEEEEE"><span class="small">Version</span></th>
<th  valign="top" align=center bgcolor="#EEEEEE"><span class="small">Date</span></th>
<th  valign="top" align=center bgcolor="#EEEEEE"><span class="small">Edit</span></th>
<th  valign="top" align=center bgcolor="#EEEEEE"><span class="small">Delete Exam</span></th>

</tr>

<?php
include('config.inc');

 $examid = $_GET['examid'];
 $action = $_GET['action'];
 $ID = $_GET['ID'];

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

// Exam to be deleted 
 if ($action == 'delete')
 {
   $query = "select questionid from question where examid = '$examid'";
   $result = mysqli_query($db_connect,$query);
   while($row = mysqli_fetch_row($result))
   {
	$query1 = "delete from images where questionid = '$row[0]'";
	$result1 = mysqli_query($db_connect,$query1);
   }	
   $query = "delete from question where examid = '$examid'";
   $result = mysqli_query($db_connect,$query);
   $query = "delete from exam where examid = '$examid'";
   $result = mysqli_query($db_connect,$query);
 }

  $result =  mysqli_query($db_connect,"SELECT admin FROM candidate WHERE candidateID = '$ID'");
  $row = mysqli_fetch_row($result);
  $admin = $row[0];

  if ($admin)
     $result =  mysqli_query($db_connect,"SELECT examid,title,id,version,date FROM exam ORDER BY examid");
  else
     $result =  mysqli_query($db_connect,"SELECT exam.examid,exam.title,id,version,exam.date FROM exam,candidate,examPermissions WHERE candidate.editExam = 1 AND candidate.candidateID = examPermissions.candidateID AND examPermissions.examid = exam.examid AND candidate.candidateID = '$ID' ORDER BY examid");

  while($row = mysqli_fetch_row($result))
  {
print <<< ENDVIEW
<tr>
<td valign="top"><span class="small">$row[1]</span></td>
<td valign="top"><span class="small">$row[2]</span></td>
<td valign="top"><span class="small">$row[3]</span></td>
<td valign="top"><span class="small">$row[4]</span></td>
<td valign="top"><span class="small"><a href='editExam.php?examid=$row[0]'> Edit</a></span></td>
<td valign="top"><span class="small"><a onclick="return confirmSubmit()" href='viewExam.php?examid=$row[0]&action=delete'><img src='trashcan.gif' alt='Delete this Exam' border='0'></a></span></td>
</tr>
ENDVIEW;
  }
?>

</table> 
</body>
</html>
