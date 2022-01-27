<?php
session_start();
 $name = 'userName';
 $value = $_POST['userName'];
  session_register($name);
  $cookie = base64_encode(serialize($value));
  setcookie($name, $cookie, time()+3600);
?>

<html>
<head>
  <title>brains@work - Online Test</title>
  <meta name="author" content="Ravishankar Bhatia">

 <link REL=StyleSheet HREF="myStyle.css" TYPE="text/css">	

 <script language="JavaScript">
    <!--
    function checkfields() {
       validity = true; // assume valid
       if (document.form.userName.value == "")
       { validity = false; alert('Please enter your User Name.'); }
       else if (document.form.password.value == "")
       { validity = false; alert('Please enter your Password.'); }
    return validity;
    }

	function NewWindow(filename)
	{
		passwindow=window.open(filename, 'PasswordReminder', 'status=1,width=400,height=270')
	}
    // -->
  </script>

</head>
<body>

<?php
 include('config.inc');

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

 $userName = "";
 $password = "";
 $message = "Existing users Enter your User Name and Password to Log in";
 
 if ($_POST['action'] == "login")
 {
 $flag = 0;
 $userName = $_POST['userName'];
 $password = $_POST['password'];

 $result =  mysqli_query($db_connect,"SELECT candidateID,userName,userPassword,admin FROM candidate");

  while ($row = mysqli_fetch_row($result))
  {
    
  if (($userName == $row[1]) && ($password == $row[2]))
      {
        $flag = 1;
        $ID = $row[0];
        $admin = $row[3];
      }
  }

 if($flag == 0)
 {
     if (!$password)
     {
      $message = "<br>Please complete all the text boxes<br>";
      $message .= "<br>Please try again...<br>\n";
     }
     else if (!$userName)
     {
      $message = "<br>Please complete all the text boxes<br>";
     }
     else 
     {
     $message = "Login failed<br>\n";
     $message .= "Invalid User Name or Password\n";
     }
 }
else 
{

    $message = " <script language=\"JavaScript\">
    <!--
      location.href=\"admin_index.php?ID=$ID\";
     // -->
     </script>";
}

/* else if (!$admin)
   $message = " <script language=\"JavaScript\">
    <!--
      location.href=\"ewn_index.php?ID=$ID\";
     // -->
  </script>"; */

 }

?>

<table style="width: 100%;">
  <tbody>
    <tr>
      <td
 style="text-align: center; background-color: rgb(214, 235, 255);"><big
 style="font-weight: bold; font-style: italic;"><big><big><big><big><big>brains@work</big></big></big></big></big></big><br>
      </td>
      <td valign="bottom"> <br>
      </td>
    </tr>
    <tr>
      <td width="35%" valign="top">
      <form name="form" method="post" action="mainTest.php" onsubmit="return checkfields()">
        <div class="menu">
        <center><b>Log in</b></center>
        <br>
        <table>
          <tbody>
	<tr>
	  <td colspan = 2>
<?php 
print("<font color=RED>$message</font>\n");
print <<< LOGIN
	</td>
   </tr>
   <tr>
	<td align="right">User Name:</td>
	<td> 
        <p><input type="text" name="userName" value="$userName"  maxlength="10"></p>
	</td>
  </tr>
  <tr>
	<td align="right">Password:</td>
	<td> 				
        <p><input type="password" name="password" value="$password" maxlength="10">
        </p>
         </td>
   </tr>
 <tr>
   <td colspan=2><center>
<input name="action" type="hidden" value="login">
             <input type="submit" value=" OK ">    <a href="JavaScript:NewWindow('forgotPassword.php')">Forgot your password?</a></center>
   </td>
  </tr>
LOGIN;
mysqli_close($db_connect);

?>

          </tbody>
        </table>
        </div>
      </form>
      </td>
 <td width="75%" align="left" valign="top">
      <div class="form">
      <p>brains@work is a online testing application.  You will need to
login before you can take any tests.</p>
      <p>If you do not have an account, you can register <a
 href="profile.php">by clicking on this link</a>.</p>
      </div>
      </td>
    </tr>
  </tbody>
</table>
<br>
<br>
</body>
</html>
