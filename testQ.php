
<?php

 include('config.inc');
 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);
$ID = 5;

$result = ("select groupid from exam,examPermissions where 
examPermissions.examid = exam.examid and candidateID='$ID' ");
  $res = mysqli_query($db_connect,$result);
$row = mysqli_fetch_row($res);
    $gp = $row[0]; 
  while($row = mysqli_fetch_row($res)) 
    $gp .= ",".$row[0];

print("GP = $gp");

$result = ("select candidate.candidateID, candidate.userName, candidate.firstName, candidate.lastName, candidate.date, candidate.admin  from candidate, candidateGroup where candidateGroup.candidateID = candidate.candidateID  and candidateGroup.groupid in ('$gp') ");
 $query = mysqli_query($db_connect,$result);

while ($row = mysqli_fetch_row($query))
 print ("ROW $row[0]");


?>
