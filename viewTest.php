<?php
 include('cookie.php');
?>
<html>
<head>
 <title>certExams - Online Test</title>
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
  $examid = $_GET['examid'];
  $ID = $_GET['ID'];
  
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
     $result =  ("SELECT * FROM exam ");
  else
     $result =  ("SELECT exam.examid, exam.title, exam.id, exam.version, exam.instructions, exam.date, exam.questions, exam.startDate, exam.endDate, exam.time, exam.passingScore, exam.active, exam.groupid FROM exam,candidate,examPermissions WHERE candidate.editExam = 1 AND candidate.candidateID = examPermissions.candidateID AND examPermissions.examid = exam.examid AND candidate.candidateID = '$ID'  ");


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

<table width="100%" cellspacing="1" cellpadding="5" border=1><tr>
 <td class="header" bgcolor="#EEEEEE" colspan="10"><center>Exam settings</center></td>
</tr>
<tr>
<tr>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="viewTest.php?sortOrder=examName&amp;direction=$new_direction&ID=$ID">Exam Name</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="viewTest.php?sortOrder=examGroup&amp;direction=$new_direction&ID=$ID">Exam Group</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="viewTest.php?sortOrder=questions&amp;direction=$new_direction&ID=$ID">No. of Questions</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="viewTest.php?sortOrder=startDate&amp;direction=$new_direction&ID=$ID">Start Date</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="viewTest.php?sortOrder=endDate&amp;direction=$new_direction&ID=$ID">End Date</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="viewTest.php?sortOrder=examTime&amp;direction=$new_direction&ID=$ID">Exam Time</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="viewTest.php?sortOrder=passingMarks&amp;direction=$new_direction&ID=$ID">Passing Score</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="viewTest.php?sortOrder=active&amp;direction=$new_direction&ID=$ID">Exam Active</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small">Edit</span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small">Delete</span></th>
</tr>
MAIN;


    $sortOrder = $_GET['sortOrder'];

    if (($sortOrder == "examName") || (empty($sortOrder)))
    {
        $sortOrder = 'exam.title';
    }
   if ($sortOrder == "examGroup")
    {
        $sortOrder = 'exam.groupid';
    }
   if ($sortOrder == "questions")
    {
        $sortOrder = 'exam.questions';
    }
   if ($sortOrder == "startDate")
    {
        $sortOrder = 'exam.startDate';
    }
   if ($sortOrder == "endDate")
    {
        $sortOrder = 'exam.endDate';
    }
   if ($sortOrder == "examTime")
    {
        $sortOrder = 'exam.time';
    }
   if ($sortOrder == "passingMarks")
    {
        $sortOrder = 'exam.passingScore';
    }
   if ($sortOrder == "active")
    {
        $sortOrder = 'exam.active';
    }

   $result .= " ORDER BY $sortOrder $direction"; 


  $query = mysqli_query($db_connect,$result);

while ($row = mysqli_fetch_row($query))
{
$flag = 1;
 $gr =mysqli_query($db_connect,"select groupName from groups where groupid = '$row[12]'");
 $grow = mysqli_fetch_row($gr);
 if ($groupName = $grow[0]);
 else  $groupName =" ";
print <<< VIEW
<tr>
<td valign="top"><span class="small">$row[1]</span></td>
<td valign="top"><span class="small">$groupName</span></td>
<td valign="top"><span class="small">$row[6]</span></td>
<td valign="top"><span class="small">$row[7]</span></td>
<td valign="top"><span class="small">$row[8]</span></td>
<td valign="top"><span class="small">$row[9] mins</span></td>
<td valign="top"><span class="small">$row[10]</span></td>
<td valign="top"><span class="small">$row[11]</span></td>
<td valign="top"><span class="small"><a href="edit1.php?examid=$row[0]&ID=$ID"><img src='pencil.gif' alt='view this result' border='0'>Edit</a></span></td>
<td valign="top"><span class="small"><a onclick="return confirmSubmit()" href="viewTest.php?action=delete&examid=$row[0]&ID=$ID"><img src='trashcan.gif' alt='Delete this Exam' border='0'></a></span></td>
</tr>
VIEW;
}

if ($flag != 1)
 print ("<tr><td colspan=10> No results found </td></tr>");
?>

</table>
<BR><BR>

</body>
</html>
