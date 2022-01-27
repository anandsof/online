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
  if(!$admin)
  {
  $admin = $_GET['admin'];
  }
if($group != "All")
 $g = "and groups.groupid=$group";


if($fieldn = $_GET['fieldn']);

 if($fieldn)
 {
 if($fieldn != last)
 {
 #$result .= "and candidate.candidateID >= $fieldn";
 $cndid = $fieldn;
 }
 }
 if($fieldn == last)
 {
 $resnn = mysqli_query($db_connect,"SELECT candidateID FROM candidate");
 $count = 1;
 while ($rownn = mysqli_fetch_row($resnn))
 {
 if($count == 31)
 {
 $fieldn = $rownn[0]; 
 $count = 0;
 }
 $count = $count + 1;
 }
 $fieldn = $fieldn + 1;
  #$result .= "and candidate.candidateID >= $fieldn";
 $cndid = $fieldn;
 }
 


if(!$fieldn)
{
$fieldn = 1;
$prev = 0;
$cndid = 1;
}
$j = $fieldn;



  if ($admin)
    $result = ("select distinct candidate.candidateID, candidate.userName, candidate.firstName, candidate.lastName, candidate.date, candidate.admin  from candidate, candidateGroup, groups where candidate.candidateID >= $cndid and candidate.candidateID = candidateGroup.candidateID and candidateGroup.groupid = groups.groupid $g");
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


#print("$result<br>");
if(!$ID)
{
$ID = 1;
}
print <<< MAIN
<table width="100%" cellspacing="1" cellpadding="5" border=1><tr>
 <td class="header" bgcolor="#EEEEEE" colspan="9"><center>Users</center></td>
</tr>
<tr>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="usermine.php?ID=$ID&amp;sortOrder=candidateID&amp;direction=$new_direction&cid=$cid&group=$group$list&fieldn=$fieldn">User ID </a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="usermine.php?ID=$ID&amp;sortOrder=userName&amp;direction=$new_direction&cid=$cid&group=$group$list&fieldn=$fieldn">User Name</a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="usermine.php?ID=$ID&amp;sortOrder=firstName&amp;direction=$new_direction&cid=$cid&group=$group$list&fieldn=$fieldn">Name </a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small">User's Group</span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="usermine.php?ID=$ID&amp;sortOrder=date&amp;direction=$new_direction&cid=$cid&group=$group$list&fieldn=$fieldn">Date </a></span></th>
<th  valign="top" bgcolor="#EEEEEE"><span class="small"><a href="usermine.php?ID=$ID&amp;sortOrder=admin&amp;direction=$new_direction&cid=$cid&group=$group$list&fieldn=$fieldn">Admin </a></span></th>
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

#print("$result<br>");

$i = 1; 

#print("$result");
while ($row = mysqli_fetch_row($query))
{
$a[$i] = $row[0];
$b[$i] = $row[1];
$c[$i] = $row[2];
$d[$i] = $row[3];
$e[$i] = $row[4];
$f[$i] = $row[5];
$h[$i] = $row[6];
$flag = 1;
if($row[5] == 1)
 $admin_n[$i] = 'Yes';
else 
 $admin_n[$i] = 'No';

 $groupName[$i] = "";
 $gquery = mysqli_query($db_connect,"SELECT groupName FROM candidateGroup natural join groups where candidateID='$row[0]'");
 $grow = mysqli_fetch_row($gquery);
   $groupName[$i] = $grow[0];
 while ($grow = mysqli_fetch_row($gquery))
   $groupName[$i] .= ", ".$grow[0];
$i = $i + 1;
}
$i = 1;

for($i=1; $i<=30; $i++)
{
if($a[$i])
{
print <<< VIEW
<tr>
<td valign="top"><span class="small">$a[$i]</span></td>
<td valign="top"><span class="small"><a href="viewResults.php?ID=$a[$i]">$b[$i]</a></span></td>
<td valign="top"><span class="small">$b[$i] $c[$i]</span></td>
<td valign="top"><span class="small">$groupName[$i]</span></td>
<td valign="top"><span class="small">$e[$i]</span></td>
<td valign="top"><span class="small">$admin_n[$i]</span></td>
<td valign="top"><span class="small"><a href="$edit?candidateID=$a[$i]&ID=$ID"><img src='pencil.gif' alt='view this result' border='0'>Edit</a></span></td>
<td valign="top">
VIEW;
if($a[$i] != 1)
{
 if ($editGroup == 0 && $editExam == 1) ;
 else {
print <<< VIEW
<span class="small"><a onclick="return confirmSubmit()" href="usermine.php?action=delete&candidateID=$a[$i]&ID=$ID&group=$group"><img src='trashcan.gif' alt='Delete this Exam' border='0'></a></span>
VIEW;
      } // For Power users not to delete users
}
print <<< VIEW
</td>
</tr>
VIEW;
}
}
if($a[$i])
{
$fielda = $a[$i];
}
if ($flag != 1)
 print ("<tr><td colspan=9> No results found try again </td></tr>");

print <<< VIEW
<tr>
<td colspan="9"><a href="searchUsermine.php?ID=$ID"><< Back To Search</a></td>
</tr>
VIEW;

?>

</table>
<br><br>
<?php
 $hlink ="usermine.php?admin=1";
 if($user)
 {
 $hlink = $hlink."&$user=".$user; 
 }
 if($group)
 {
 $hlink = $hlink."&group=".$group; 
 }
 if(candidateID)
 {
 $hlink = $hlink."&candidateID=".$candidateID; 
 }
 if($date)
 {
 $hlink = $hlink."&date=".$date; 
 }
 if($userName)
 {
 $hlink = $hlink."&userName=".$userName; 
 }
 if($firstName)
 {
 $hlink = $hlink."&firstName=".$firstName; 
 }
 if($lastName)
 {
 $hlink = $hlink."&lastName=".$lastName; 
 }
 if($email)
 {
 $hlink = $hlink."&email=".$email; 
 }
 if($address)
 {
 $hlink = $hlink."&address=".$address; 
 }
 if($city)
 {
 $hlink = $hlink."&city=".$city; 
 }
 if($state)
 {
 $hlink = $hlink."&state=".$state; 
 }
 if($postCode)
 {
 $hlink = $hlink."&postCode=".$postCode; 
 }
 if($country)
 {
 $hlink = $hlink."&country=".$country; 
 }
 if($homePhone)
 {
 $hlink = $hlink."&homePhone=".$homePhone; 
 }
 if($workPhone)
 {
 $hlink = $hlink."&workPhone=".$workPhone; 
 }
 if($mobilePhone)
 {
 $hlink = $hlink."&mobilePhone=".$mobilePhone; 
 }
 if($fax)
 {
 $hlink = $hlink."&fax=".$fax; 
 }
 if($company)
 {
 $hlink = $hlink."&company=".$company; 
 }
 if($title)
 {
 $hlink = $hlink."&title=".$title; 
 }
print("<center>");

$nquery = mysqli_query($db_connect,"SELECT candidateID FROM candidate WHERE candidateID < $fieldn ORDER BY candidateID DESC");

$i = 1;
while ($row1 = mysqli_fetch_row($nquery))
{
if($i == 31)
{
if(!$prev)
{
$prev = $row1[0];
}
last;
}
$i = $i + 1;
}
if($prev)
{
print<<<GG
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="$hlink&fieldn=1&ID=1&direction=$direction&sortorder=$sortOrder">First</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="$hlink&fieldn=$prev&ID=1&direction=$direction&sortorder=$sortOrder">Previous</a>
GG;
}
if($fielda)
{
print<<<OOO
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="$hlink&fieldn=$fielda&ID=1&direction=$direction&sortorder=$sortOrder">Next</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="$hlink&fieldn=last&ID=1&direction=$direction&sortorder=$sortOrder">Last</a>
</center>
OOO;
}
else
{
print("</center>");
}
?>
</body>
</html>
