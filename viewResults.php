<?php
 include('cookie.php');
include('logged.php');
?>
<html>
<head>
 <title>brains@work</title>
  <meta name="author" content="Ravishankar Bhatia" />
<link REL=StyleSheet HREF="myStyle.css" TYPE="text/css">
</head>
<body >
<BR>
<BR>

<?php
 include('config.inc');

 $ID = $_GET['ID'];
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

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

print <<< MAIN
<table width="100%" cellspacing="1" cellpadding="5" border=1><tr>
 <td class="header" bgcolor="#EEEEEE" colspan="6"><center>Test Results</center></td>
</tr>
<tr>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="viewResults.php?ID=$ID&amp;sortOrder=examid&amp;direction=$new_direction">Test name</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="viewResults.php?ID=$ID&amp;sortOrder=marks&amp;direction=$new_direction">Marks scored</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="viewResults.php?ID=$ID&amp;sortOrder=maxMarks&amp;direction=$new_direction">Marks possible</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="viewResults.php?ID=$ID&amp;sortOrder=per&amp;direction=$new_direction">Score</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="viewResults.php?ID=$ID&amp;sortOrder=date&amp;direction=$new_direction">Date & Time taken</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small">View answers</span></th>
</tr>

MAIN;

 $sortOrder = $_GET['sortOrder'];

    if ($sortOrder == "examid")
    {
        $sortOrder = 'scores.examid';
    }
   if (($sortOrder == "date") || (empty($sortOrder)))
   {
     $sortOrder = 'scores.date,scores.time';
   }
   if ($sortOrder == 'per')
   {
     $sortOrder = '(scores.marks*100/maxMarks)';
   }

  $result =  mysqli_query($db_connect,"DELETE FROM scores WHERE candidateID='$ID' AND maxMarks=0 ");

  $result = (" select distinct title,scores.marks,maxMarks,scores.date,scores.time,scores.scoreid from scores,exam,test where scores.examid = exam.examid and test.scoreid = scores.scoreid and candidateID='$ID' ");

    $result .= " ORDER BY $sortOrder $direction";

  $query = mysqli_query($db_connect,$result);

  while ($row = mysqli_fetch_row($query))
  {

$per = round(($row[1]/$row[2])*100);

print <<< VIEW
<tr>
<td valign="top"><span class="small">$row[0]</span></td>
<td valign="top"><span class="small">$row[1]</span></td>
<td valign="top"><span class="small">$row[2]</span></td>
<td valign="top"><span class="small">$per%</span></td>
<td valign="top"><span class="small">$row[3]<BR>$row[4]</span></td>
<td valign="top"><span class="small"><a href="viewResult.php?scoreid=$row[5]">View</a></span></td>
</tr>
VIEW;

}

?>

</table>
<br><br>
</body>
</html>
