<?php
 //include('cookie.php');
?>
<html>
<head>
 <title>certExam</title>
  <meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Cache-Control" content="no-cache" />
  <meta http-equiv="Content-Type" content="text/html" />
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
  $candidateID = $_GET['candidateID'];
  
  if ($action == 'delete')
  {
   $result = mysqli_query($db_connect,"select scoreid from scores where candidateID = '$candidateID'");
   while($row = mysqli_fetch_row($result))
   {
   $scoreid = $row[0];
   $query = "delete from test where scoreid = '$scoreid'";
   $result1 = mysqli_query($db_connect,$query);
   }
   $query = "delete from scores where candidateID = '$candidateID'";
   $result = mysqli_query($db_connect,$query);
 
   $query = "delete from candidateGroup where candidateID = '$candidateID'";
   $result = mysqli_query($db_connect,$query);

   $query = "delete from examPermissions where candidateID = '$candidateID'";
   $result = mysqli_query($db_connect,$query);

   $query = "delete from groupPermissions where candidateID = '$candidateID'";
   $result = mysqli_query($db_connect,$query);

   $query = "delete from candidate where candidateID = '$candidateID'";
   $result = mysqli_query($db_connect,$query);
  
   $candidateID = "";
  }

 $res = mysqli_query($db_connect,"select editGroup, editExam, admin from candidate where candidateID='$ID' ");
	$row = mysqli_fetch_row($res);
		$editGroup = $row[0];
		$editExam = $row[1];
		$adminControl = $row[2];

   if ($adminControl == 1 || ($editGroup == 0 && $editExam == 1))
	$edit = "editProfile.php";
   else
	$edit = "editUserGroup.php";

  if ($editGroup == 0 && $editExam == 1)
	$res = mysqli_query($db_connect,"select groupid from exam,examPermissions where examPermissions.examid = exam.examid and candidateID='$ID' ");

   else
	$res = mysqli_query($db_connect,"select groupid from groupPermissions where candidateID='$ID' ");

  $row = mysqli_fetch_row($res);
    $gp = $row[0]; 
  while($row = mysqli_fetch_row($res)) 
    $gp .= ", ".$row[0];

 $result =  mysqli_query($db_connect,"SELECT admin FROM candidate WHERE candidateID = '$ID'");
  $row = mysqli_fetch_row($result);
  $admin = $row[0];

if($group != "All")
 $g = "and groups.groupid=$group";

  if ($admin)
    $result = ("select distinct candidate.candidateID, candidate.userName, candidate.firstName, candidate.lastName, candidate.date, candidate.admin  from candidate, candidateGroup, groups where candidate.candidateID > 0 and candidate.candidateID = candidateGroup.candidateID and candidateGroup.groupid = groups.groupid $g");
  else
  {
 if($group == "All")
  $g = " candidateGroup.groupid in ($gp) ";
 else
  $g = " candidateGroup.groupid=$group ";

    $result = ("select distinct candidate.candidateID, candidate.userName, candidate.firstName, candidate.lastName, candidate.date, candidate.admin  from candidate, candidateGroup, groups where candidateGroup.candidateID = candidate.candidateID  and  $g");
  }

 if($user = $_POST['user']) ; else $user = $_GET['user'];
 if($candidateID = $_POST['candidateID']) ; else $candidateID = $_GET['candidateID'];

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



if ($user == 'All')
  $user = "";

$list = "";

   if ($user)     { $result .= "and candidate.admin = 1 "; 
		      $list .= "&user=1"; }
   if ($candidateID){ $result .= "and candidate.candidateID='$candidateID'";
		      $list .= "&candidateID=$candidateID"; }
   if ($date)       { $result .= "and candidate.date = '$date' "; 
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
 <td class="header" bgcolor="#EEEEEE" colspan="9"><center>Users</center></td>
</tr>
<tr>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="user.php?ID=$ID&amp;sortOrder=candidateID&amp;direction=$new_direction&cid=$cid&group=$group$list">User ID </a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="user.php?ID=$ID&amp;sortOrder=userName&amp;direction=$new_direction&cid=$cid&group=$group$list">User Name</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="user.php?ID=$ID&amp;sortOrder=firstName&amp;direction=$new_direction&cid=$cid&group=$group$list">Name </a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small">User's Group</span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="user.php?ID=$ID&amp;sortOrder=date&amp;direction=$new_direction&cid=$cid&group=$group$list">Date </a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="user.php?ID=$ID&amp;sortOrder=admin&amp;direction=$new_direction&cid=$cid&group=$group$list">Admin </a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small">Edit user</span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small">Delete</span></th>
</tr>

MAIN;

   $sortOrder = $_GET['sortOrder'];

    if ($sortOrder == "candidateID")
    {
        $sortOrder = 'candidate.candidateID';
    }
   if ($sortOrder == "userName")
    {
        $sortOrder = 'candidate.userName';
    }
   if ($sortOrder == "firstName")
    {
        $sortOrder = 'candidate.firstName';
    }
   if ($sortOrder == "admin")
    {
        $sortOrder = 'candidate.admin';
    }
   if (($sortOrder == "date") || (empty($sortOrder)))
   {
     $sortOrder = 'candidate.date';
   }
   $result .= " ORDER BY $sortOrder $direction";


  $query = mysqli_query($db_connect,$result);

while ($row = mysqli_fetch_row($query))
{
$flag = 1;
if($row[5] == 1)
 $admin = 'Yes';
else 
 $admin = 'No';

 $groupName = "";
 $gquery = mysqli_query($db_connect,"SELECT groupName FROM candidateGroup natural join groups where candidateID='$row[0]'");
 $grow = mysqli_fetch_row($gquery);
   $groupName = $grow[0];
 while ($grow = mysqli_fetch_row($gquery))
   $groupName .= ", ".$grow[0];

print <<< VIEW
<tr>
<td valign="top"><span class="small">$row[0]</span></td>
<td valign="top"><span class="small"><a href="viewResults.php?ID=$row[0]">$row[1]</a></span></td>
<td valign="top"><span class="small">$row[2] $row[3]</span></td>
<td valign="top"><span class="small">$groupName</span></td>
<td valign="top"><span class="small">$row[4]</span></td>
<td valign="top"><span class="small">$admin</span></td>
<td valign="top"><span class="small"><a href="$edit?candidateID=$row[0]&ID=$ID"><img src='pencil.gif' alt='view this result' border='0'>Edit</a></span></td>
<td valign="top">
VIEW;
if($row[0] != 1)
{
 if ($editGroup == 0 && $editExam == 1) ;
 else {
print <<< VIEW
<span class="small"><a onclick="return confirmSubmit()" href="user.php?action=delete&candidateID=$row[0]&ID=$ID&group=$group"><img src='trashcan.gif' alt='Delete this Exam' border='0'></a></span>
VIEW;
      } // For Power users not to delete users
}
print <<< VIEW
</td>
</tr>
VIEW;
}

if ($flag != 1)
 print ("<tr><td colspan=9> No results found try again </td></tr>");

print <<< VIEW
<tr>
<td colspan="9"><a href="searchUser.php?ID=$ID"><< Back To Search</a></td>
</tr>
VIEW;
?>

</table>
<br><br>
</body>
</html>
