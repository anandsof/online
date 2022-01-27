<?php
 include('cookie.php');
?>
<html>
<head>
<title>certExams - Online Test</title>

<link REL=StyleSheet HREF="myStyle.css" TYPE="text/css">	

</head>
<body>

<?php
include('config.inc');

 $ID = $_GET['ID'];

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

  $result =  mysqli_query($db_connect,"SELECT firstName,lastName,admin,editGroup,editExam FROM candidate WHERE candidateID='$ID'");
  $row = mysqli_fetch_row($result);
  $firstName = $row[0];
  $lastName = $row[1];
  $admin = $row[2];
  $editGroup = $row[3];
  $editExam = $row[4];
  $cid = $ID;
?>  

<table width="200">

  <tr>
   <td valign="top">
 <div class="menu">

<?php
$uname = $_GET['uname'];
print <<< THIS
<center><b>Hello $firstName $lastName </b></center><br>
<a href="takeTest.php?ID=$ID" target=main>Take test<br></a>
<a href="editProfile.php?candidateID=$ID" target=main>Edit profile<br></a>
<a href="changepass.php?ID=$ID" target=main>Change password<br></a>
<a href="viewResults.php?ID=$ID" target=main>View test results<br></a>
<a href="javascript:onclick=clickparent()">Log out<br></a>
<script LANGUAGE="JavaScript">
<!-- Begin
function clickparent()
{
window.top.location.href="logout.php?uname=$uname";
}
//  End -->
</script>
THIS;
if ( $admin || $editExam || $editGroup)
  print("\n<hr size=\"1\" noshade=\"noshade\">\n
<center><span class=\"small\"><b>Examination</b></span></center>");

if ($admin || $editGroup)
  print ("\n<a href=\"createExam.php?ID=$ID\" target=main>Create Test and Questions<br></a>\n");

if ($admin || $editExam || $editGroup)
  print("<a href=\"viewExam.php?ID=$ID\" target=main>View Test and  Add/Edit Questions<br></a>\n");

if ($admin)
  print("<a href=\"addUser.php?ID=$ID\" target=main>Add User<br></a>\n
");

if ($editGroup)
  print("<a href=\"addUserGroup.php?ID=$ID\" target=main>Add User<br></a>\n
");

if ($admin)
  print("<a href=\"addGroup.php?ID=$ID\" target=main>Add group<br></a>
");

if ($admin || $editExam || $editGroup)
  print("<a href=\"addImage.php?ID=$ID\" target=main>Add Images<br></a>");

if ($admin)
  print("<a href=\"databaseBackup.php?ID=$ID\" target=main>Database Backup & Restore<br></a>");

if ($editGroup)
  print("<a href=\"examBackup.php?ID=$ID\" target=main>Exam Backup & Restore<br></a>");

if ($admin || $editExam || $editGroup)
   print("\n<hr size=\"1\" noshade=\"noshade\">\n<center><span class=\"small\"><b>View/Editing</b></span></center>\n");

if ( $admin || $editGroup)
   print("\n<a href=\"viewTest.php?ID=$ID\" target=main>Exam settings</a><br>\n");

if ($admin || $editExam || $editGroup)
  print("\n<a href=\"searchUser.php?ID=$ID\" target=main>View/Edit users</a><br>\n");

if ($admin)
  print("\n<a href=\"editsubscription.php?ID=$ID\" target=main>Edit subscription</a><br>\n");


if ($admin || $editExam || $editGroup)
  print("\n<a href=\"changepass_admin.php?ID=$ID\" target=main>Change User Password</a><br>\n");

if ($admin || $editExam || $editGroup)
  print("<a href=\"searchResult.php?ID=$ID\" target=main>View all test results</a><br>");

if ($admin)
  print("<a href=\"viewGroup.php?ID=$ID\" target=main>View/Edit groups</a><br>");

if ($admin)
  print("<a href=\"viewActiveUser.php?ID=$ID\" target=main>View Active Users</a><br>");
if ($admin)
  print("<a href=\"morethan24.php?ID=$ID\" target=main>Logoff Old Entries</a><br>");
if ($admin)
  print("<a href=\"filewrite.php\" target=main>Generate Serial No.</a><br>");
if ($admin)
  print("<a href=\"accesslog.php\" target=main>Access Log</a><br>");
if ($admin)
  print("<a href=\"news_mailer.php?ID=$ID\" target=main>Mail News</a><br>");
if ($admin)
  print("<a href=\"guestslog.php?ID=$ID\" target=main>View GuestLog</a><br>");
if ($admin)
  print("<a href=\"clearguestlog.php?ID=$ID\" target=main>Clear GuestLog</a><br>");
?>
</div>
</td>
  </tr>
<?php
if (!$admin && !$editExam && !$editGroup)
{ 
?>
<!--
<tr>
 <td valign="top">
 <div class="menu">
<?php
  print("<a href=\"highScore.php?ID=$ID\" target=main>Highest Scorers</a><br>");
  print("<a href=\"NoReg.php?ID=$ID\" target=main>Number Of registrants</a><br>");
?>
</div>
</td>
  </tr>
-->
<?php 
}
?>
 </table>

</body>
</html>


