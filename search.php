<?php
 //include('cookie.php');
?>
<html>
<head>
 <title>brains@work</title>
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
<body >
<BR>
<BR>

<?php

 include('config.inc');
 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

  if($ID = $_GET['ID'])
    ;
  else
    $ID = $_POST['ID'];
 
  $action = $_GET['action'];
  $scoreid = $_GET['scoreid'];
  
  if ($action == 'delete')
  {
   $query = "delete from scores where scoreid = '$scoreid'";
   $result = mysqli_query($db_connect,$query);
   $query = "delete from test where scoreid = '$scoreid'";
   $result = mysqli_query($db_connect,$query);
  }

  $res = mysqli_query($db_connect,"select groupid from exam,examPermissions where examPermissions.examid = exam.examid and candidateID='$ID' ");
  $row = mysqli_fetch_row($res);
    $gp = $row[0]; 
  while($row = mysqli_fetch_row($res)) 
    $gp .= ", ".$row[0];

 $result =  mysqli_query($db_connect,"SELECT admin FROM candidate WHERE candidateID = '$ID'");
  $row = mysqli_fetch_row($result);
  $admin = $row[0];

if($admin)
   $result =  ("select distinct exam.title,scores.marks,maxMarks,scores.date,scores.time,scores.scoreid,userName from scores,exam,candidate,test where scores.examid = exam.examid and scores.candidateID=candidate.candidateID and test.scoreid = scores.scoreid ");
else
   $result = ("select distinct exam.title,scores.marks,maxMarks,scores.date,scores.time,scores.scoreid,userName from scores, exam, test, candidate, candidateGroup where candidateGroup.candidateID = candidate.candidateID  and candidateGroup.groupid in ($gp) and scores.examid = exam.examid and scores.candidateID=candidate.candidateID and test.scoreid = scores.scoreid ");


 if($examid = $_POST['exam']) ; else $examid = $_GET['exam'];
 if($date = $_POST['date']) ; else $date = $_GET['date'];
 if($userName = $_POST['userName']) ; else $userName = $_GET['userName'];
 if($firstName = $_POST['firstName']) ; else $firstName = $_GET['firstName'];
 if($lastName = $_POST['lastName']) ; else $lastName = $_GET['lastName'];
 if($email = $_POST['email']) ; else $email = $_GET['email'];
 if($address = $_POST['address']) ; else $address = $_GET['address'];
 if($city = $_POST['city']) ; else $city = $_GET['city'];
 if($state = $_POST['state']) ; else $state = $_GET['state'];
 if($postCode = $_POST['postCode']) ; else $postCode = $_GET['postCode'];
 if($country = $_POST['country']) ; else $country = $_GET['country'];
 if($homePhone = $_POST['homePhone']) ; else $homePhone = $_GET['homePhone'];
 if($workPhone = $_POST['workPhone']) ; else $workPhone = $_GET['workPhone'];
 if($mobilePhone = $_POST['mobilePhone']) ; else $mobilePhone = $_GET['mobilePhone'];
 if($fax = $_POST['fax']) ; else $fax = $_GET['fax'];
 if($company = $_POST['company']) ; else $company = $_GET['company'];
 if($title = $_POST['title']) ; else $title = $_GET['title'];

if ($examid == 'All')
  $examid = "";

$list = "";

   if ($examid)     { $result .= "and scores.examid = '$examid' ";
			$list .= "&exam=$examid"; }
   if ($date)       { $result .= "and scores.date = '$date' "; 
			$list .= "&date=$date "; }
   if ($userName)   { $result .= "and candidate.userName = '$userName'"; 
			$list .= "&userName=$userName"; }
   if ($firstName)  { $result .= "and candidate.firstName = '$firstName'"; 
			$list .= "&firstName=$firstName"; }
   if ($lastName)   { $result .= "and candidate.lastName = '$lastName'"; 
			$list .= "&lastName=$lastName"; }
   if ($email)      { $result .= "and candidate.email = '$email'"; 
			$list .= "&email=$email"; }
   if ($address)    { $result .= "and candidate.address = '$address'"; 
			$list .= "&address=$address"; }
   if ($city)       { $result .= "and candidate.city = '$city'"; 
			$list .= "&city=$city"; }
   if ($state)      { $result .= "and candidate.state = '$state'"; 
			$list .= "&state=$state";  }
   if ($postCode)   { $result .= "and candidate.postCode = '$postCode'";
			$list .= "&postCode=$postCode"; }
   if ($country)    { $result .= "and candidate.country = '$country'"; 
			$list .= "&country=$country"; }
   if ($homePhone)  { $result .= "and candidate.homePhone = '$homePhone'"; 
			$list .= "&homePhone=$homePhone"; }
   if ($workPhone)  { $result .= "and candidate.workPhone = '$workPhone'";
			$list .= "&workPhone=$workPhone"; }
   if ($mobilePhone){ $result .= "and candidate.mobilePhone='$mobilePhone'";
			$list .= "&mobilePhone=$mobilePhone";}
   if ($fax)        { $result .= "and candidate.fax = '$fax'";
			$list .= "&fax=$fax"; }
   if ($company)    { $result .= "and candidate.company = '$company'";
			$list .= "&company=$company"; }
   if ($title)      { $result .= "and candidate.title = '$title'"; 
			$list .= "&title=$title"; }


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
 <td class="header" bgcolor="#EEEEEE" colspan="8"><center>Test Results</center></td>
</tr>
<tr>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="search.php?ID=$ID&amp;sortOrder=userName&amp;direction=$new_direction$list">User Name </a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="search.php?ID=$ID&amp;sortOrder=examid&amp;direction=$new_direction$list">Test name</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="search.php?ID=$ID&amp;sortOrder=marks&amp;direction=$new_direction$list">Marks scored</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="search.php?ID=$ID&amp;sortOrder=maxMarks&amp;direction=$new_direction$list">Marks possible</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="search.php?ID=$ID&amp;sortOrder=per&amp;direction=$new_direction$list">Score</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="search.php?ID=$ID&amp;sortOrder=date&amp;direction=$new_direction$list">Date & Time taken</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small">View answers</span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small">Delete</span></th>
</tr>

MAIN;

   $sortOrder = $_GET['sortOrder'];

    if ($sortOrder == "examid")
    {
        $sortOrder = 'scores.examid';
    }
   if ($sortOrder == "userName")
    {
        $sortOrder = 'candidate.userName';
    }
   if (($sortOrder == "date") || (empty($sortOrder)))
   {
     $sortOrder = 'scores.date';
   }
   if ($sortOrder == 'per')
   {
     $sortOrder = '(scores.marks*100/maxMarks)';
   }
   $result .= " ORDER BY $sortOrder $direction";


  $query = mysqli_query($db_connect,$result);

while ($row = mysqli_fetch_row($query))
{
$flag = 1;
$per = round(($row[1]/$row[2])*100);

print <<< VIEW
<tr>
<td valign="top"><span class="small">$row[6]</span></td>
<td valign="top"><span class="small">$row[0]</span></td>
<td valign="top"><span class="small">$row[1]</span></td>
<td valign="top"><span class="small">$row[2]</span></td>
<td valign="top"><span class="small">$per%</span></td>
<td valign="top"><span class="small">$row[3]<BR>$row[4]</span></td>
<td valign="top"><span class="small"><a href="viewResult.php?scoreid=$row[5]"><img src='magnify.gif' alt='view this result' border='0'>View</a></span></td>
<td valign="top"><span class="small"><a onclick="return confirmSubmit()" href="search.php?action=delete&ID=$ID&scoreid=$row[5]"><img src='trashcan.gif' alt='Delete this Exam' border='0'></a></span></td>
</tr>
VIEW;
}

if ($flag != 1)
 print ("<tr><td colspan=8> No results found try again </td></tr>");

?>
<tr>
<td colspan="8"><a href="searchResult.php?ID=<?php print("$ID") ?>"><< Back To Search</a></td>
</tr>
</table>
<br><br>
</body>
</html>
