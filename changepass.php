<?php
 include('cookie.php');
 include('logged.php');
?>
<html>
<head>
	<title>Password Change</title>
	<link REL=StyleSheet HREF="style.css" TYPE="text/css">
<script language="JavaScript">
<!--
function validate_form() {
  validity = true; // assume valid
 
      if (!check_empty(document.form.oldpassword.value))
        { validity = false; alert('The Old Password field has been left empty. Please correct this before submitting your order.'); }

  else if (!check_empty(document.form.password1.value))
        { validity = false; alert('The Password field has been left empty. Please correct this before submitting your order.'); }

  else if (!check_empty(document.form.password2.value))
        { validity = false; alert('The Password field has been left empty. Please correct this before submitting your order.'); }

  else if (document.form.password1.value != document.form.password2.value )
       { validity = false; alert('Both the Passwords should be same'); }

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

<?php
 include('config.inc');

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

if ($ID = $_GET['ID'])
 ;
else
 $ID = $_POST['ID'];

if ($_POST['submit'])
{
 $oldpassword = $_POST['oldpassword'];
 $password1 = $_POST['password1'];
 $password2 = $_POST['password2'];

$result =  mysqli_query($db_connect,"SELECT userPassword FROM candidate WHERE candidateID = '$ID'");

  $row = mysqli_fetch_row($result);
 
  if (($oldpassword != $row[0]) || ($password1 != $password2) || (!$password1) || (!$password2)) 
  {
        $flag = 1;
  }

  if($flag == 1)
  {
     if ($password1 != $password2)
     {
      $message = "<br>The two passwords do not match!";
      $message .= "<br>Please try again...<br>\n";
     }
     else if ($oldpassword != $row[0])
     {
      $message = "<br>Sorry the old password didnt match<br>";
     }
     else 
     {
     $message = "<br>There is some problem..., please try another<br>\n";
     }
  }
  else
  {
     $query = " UPDATE candidate SET 
                  userPassword = '$password1'
                WHERE candidateID = '$ID'";
     $result = mysqli_query($db_connect,$query);

print ("<center>
<hr size=\"1\" color=\"#c0c0c0\" width=\"75%\" align=\"center\">
<font face=\"arial\" size=\"2\"><i><strong><font face=\"arial\" color=\"#999999\" size=\"4\"> Profile Updated<br> </font></strong></i></font> 
<hr size=\"1\" color=\"#c0c0c0\" width=\"75%\" align=\"center\"><BR><BR>
Your Password has been changed sucessfully </center>");

     exit;
   }
}
?>
<center>
<font face="arial" size="2"><i><strong><font face="arial" color="#999999" size="4">Change Password <br> </font></strong></i></font> 

<hr size="1" color="#c0c0c0" width="75%" align="center">
<hr size="1" width="60%" noshade>
<br>

<?php
 if ($message)
   print ("<font color=RED>$message</font>"); 
?>

<center>
 <form name=form action="changepass.php" method="post" onsubmit="return validate_form()">
         <table>
          <tr>
           <td class=label align="right">Old password: </td>
           <td><input type="password" name="oldpassword" /></td>
          </tr>
          <tr>
           <td class=label align="right">New password: </td>
           <td><input type="password" name="password1" /></td>
          </tr>

          <tr>
           <td class=label align="right">Confirm new password: </td>
           <td><input type="password" name="password2" /></td>
          </tr>
          <tr>
           <td>
	     <input type="hidden" name="ID" value=<?php print("$ID") ?> />
             <input type="submit" name="submit" value="Submit!" /></td>
          </tr>
         </table>

         </form>

</center>
</body>
</html>
