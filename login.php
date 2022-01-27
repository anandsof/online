<?php
 include('cookie.php');
?>
<html>
<head>
  <meta http-equiv="CONTENT-TYPE" content="text/html; charset=utf-8">
  <title>Online-test</title>
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
    // -->
    
  </script>
<link REL=StyleSheet HREF="style.css" TYPE="text/css">
</head>
<body>

<?php
 include('config.inc');

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

 $userName = "";
 $password = "";
 $message = "Enter your User Name and Password, and click OK";
 
 if ($_POST['action'] == "login")
 {

 $flag = 0;
 $userName = $_POST['userName'];
 $password = $_POST['password'];

 $result =  mysqli_query($db_connect,"SELECT candidateID,userName,userPassword FROM candidate WHERE Userstat='active'");

  while ($row = mysqli_fetch_row($result))
  {
    
  if (($userName == $row[1]) && ($password == $row[2]))
      {
        $flag = 1;
        $ID = $row[0];
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
     $message = "<br>Login failed<br>\n";
     $message .= "User Name or Password miss matched, Please try again...\n";
     }
 }
else 
   $message = " <script language=\"JavaScript\">
    <!--
      location.href=\"takeTest.php?ID=$ID\";
     // -->
  </script>";
 }
?>


<form name="form" action="login.php" method="post" onsubmit="return checkfields()"> <BR><BR><BR><BR>	
  <center>
  <table width="450" border="4" bordercolor="silver" cellpadding="2"
 cellspacing="0" rules="none">
    <tr bgcolor="Silver">
	<td colspan="3" width="541"> 				
        <font face="Arial, Geneva">Authentication</font> 
	</td>
    </tr>
    <tr>
	<td colspan="2" width="533" align="center">
<?php 
print("<font color=RED>$message</font>\n");
print <<< LOGIN
	<br><br></td>
   </tr>
   <tr>
	<td width="176" align="right">
            User Name:</td>
	<td width="353"> 
        <p><input type="text" name="userName" size="19" value="$userName"  maxlength="20"></p>
	</td>
  </tr>
  <tr>
	<td width="176" align="right">Password:
	<td width="353"> 				
        <p><input type="password" name="password" value="$password" size="19" maxlength="20">
        </p>
LOGIN;
mysqli_close($db_connect);

?>

	</td>
  </tr>
  <tr>
        <td colspan="2" width="533"> 				
        <div align="center"> 					
        <p>
          <input name="action" type="hidden" value="login">
             <input type="submit" value=" OK ">
	</p> </div>
	</td>
  </tr>
 </table>
 </center>
</form>
</body>
</html>
