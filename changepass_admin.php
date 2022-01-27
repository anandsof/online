<?php
include('config.inc');
$ID = $_GET['ID'];
$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

function changepass($headline,$uname,$pass)
{
print<<<GGG
<html>
<head>
<title>Password Change</title>
<link REL=StyleSheet HREF="style.css" TYPE="text/css">
<script language="JavaScript">
<!--
function validate_form() {
  validity = true; // assume valid
  if (!check_empty(document.form.password1.value))
        { validity = false; alert('The Password field has been left empty. Please correct this before submitting your order.'); }

  else if (!check_empty(document.form.password2.value))
        { validity = false; alert('The Password field has been left empty. Please correct this before submitting your order.'); }

  else if (document.form.password1.value != document.form.password2.value )
       { validity = false; alert('Both the Passwords should be same'); 
}
return validity;
}

function check_empty(text) {
  return (text.length > 0); // returns false if empty
}

// -->
  </script>
</head>
<body>
<BR>
<BR>

<center>
<font face="arial" size="2"><i><strong><font face="arial" color="#999999" size="4">Change User Password <br> </font></strong></i></font> 
<hr size="1" color="#c0c0c0" width="75%" align="center">
<hr size="1" width="60%" noshade>
<br>
<center>$headline</center>
<center>
 <form name=form action="changepass_admin.php" method="post" onsubmit="return validate_form()">
         <table>
          <tr>
           <td class=label align="right">Username:</td>
<td><select name="username">
<option selected>$uname
GGG;
include('config.inc');
$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

$result =  mysqli_query($db_connect,"SELECT userName from candidate ORDER BY userName ASC");
while ($row = mysqli_fetch_row($result))
{
print<<<AAA
<option>$row[0]
AAA;
}
print<<<GGG1
</select></td>
         </tr>
          <tr>
           <td class=label align="right">New password:</td>
           <td><input type="password" name="password1"></td>
          </tr>
          <tr>
           <td class=label align="right">Confirm New password: </td>
           <td><input type="password" name="password2"></td>
          </tr>
          <tr>
          <td></td>
           <td align="right">
         <input type="submit" name="submit" value="Submit!"></td>
          </tr>
          </table>
         </form>
</center>
</body>
</html>
GGG1;
}

if($submit)
{
$usname = $_POST['username'];
$password = $_POST['password1'];
if(!$usname)
{
$headline = "<b>Please select a username</b>";
changepass($headline,$uname,$pass);
exit;
}
$result =  mysqli_query($db_connect,"UPDATE candidate SET userPassword='$password'  WHERE userName='$usname'");
$headline = "<b>The password for user with username $usname has been changed</b>";
changepass($headline,$uname,$pass);
}
else
{
changepass($headline,$uname,$pass);
exit;
}
?>