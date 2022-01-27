<?php
 include('cookie.php');
?>
<html>
<head>
<title>brains@work - Online Test</title>
<script LANGUAGE="JavaScript">
<!-- Begin
function clickparent()
{
  window.top.location.href = 'mainTest.php';
}
//  End -->
</script>

<link REL=StyleSheet HREF="myStyle.css" TYPE="text/css">	

</head>
<body>

<?php
include('config.inc');

 $ID = $_GET['ID'];

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

  $result =  mysqli_query($db_connect,"SELECT firstName,lastName FROM candidate WHERE candidateID='$ID'");
  $row = mysqli_fetch_row($result);
  $firstName = $row[0];
  $lastName = $row[1];
  $cid = $ID;
?>  

<table width="100%">
  <tr>
   <td
 style="text-align: center; background-color: rgb(214, 235, 255);"><big
 style="font-weight: bold; font-style: italic;"><big><big><big><big><big>brains@work</big></big></big></big></big></big><br>
      </td>
   <td valign="bottom">
   
   </td>
  </tr>
  <tr>
   <td width="25%" valign="top">
 <div class="menu">

<?php
print <<< THIS
<center><b>Hello $firstName $lastName </b></center><br>
<a href="takeTest.php?ID=$ID" target=main>Take test<br></a>
<a href="editProfile.php?ID=$ID" target=main>Edit profile<br></a>
<a href="changepass.php?ID=$ID" target=main>Change password<br></a>
<a href="viewResults.php?ID=$ID" target=main>View test results<br></a>
<a href="javascript:onclick=clickparent()">Log out<br></a>
THIS;
?>

</div>
</td>
<td>
</td>
  </tr>
 </table>

</body>
</html>
