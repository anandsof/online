<html>
<head>
  <title>brains@work - Online Test</title>
  <meta name="author" content="Ravishankar Bhatia">

 <link REL=StyleSheet HREF="myStyle.css" TYPE="text/css">	
 <script language="JavaScript">
    <!--
    function checkfields() {
       validity = true; // assume valid
       if (document.form.email.value == "")
       { validity = false; alert('Please enter your Email ID.'); }
    return validity;
    }

	function closeWindow()
	 {
	   window.close()
	 }
    // -->
  </script>

</head>
<body>

<?php
 include('config.inc');

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

 if ($_POST['action'] == "login")
 {
  $flag = 0;
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $userName = $_POST['userName'];
  $email = $_POST['email'];
  $password = "error";
  
  $CId = "";
  $fName = "";
  $lName = "";
  $uName = "";

  $result =  mysqli_query($db_connect,"SELECT candidateID,firstName,lastName,userPassword,email,userName FROM candidate where email = '$email'");

  while ($row = mysqli_fetch_row($result))
  {
  	$CId = $row[0];
  $fName = $row[1];
  $lName = $row[2];
  $uName = $row[5];


  	$password = $row[3];
  
  }

  $mailto = $email;
  $sub = "Your Password: CertExams Online";
if($password == "error")
{
  $body = " \r\n  Error in getting your password. Check your details and resubmit it";
}
else
   $body = "Hello,\n\nYour CertExams.com Online Registration details are given below: \n Candidate ID: $CId\n First Name: $fName \n Last Name: $lName \n User Name: $uName \n E-mail ID: $email \n Your Password: $password \n\nRegards,\n Support team - CertExams.com";

  $extra_header = "From: support@certexams.com\r\nReply-to: support@certexams.com\r\nBounce-to: support@certexams.com\r\n";

  $mailsend = mail($mailto, $sub, $body ,$extra_header);

printf("<br><br> <h2 align=\"center\"> \"Your Password has been sent successfully\" </h2>");

printf("<br> <a href=\"javascript:closeWindow()\"><h3 align=\"center\"> Close This Window </h3></a><br>");
exit;
 }

?>

  <form name="form" method="post" action="forgotPassword.php" onsubmit="return checkfields()"> 
       <div class="menu">
<center>
<big><big><big><big><big>CertExams - User Password Recovery</big></big></big></big></big></big><br>
</center>

        <center><b>Password Recoverer</b></center>
        <br>
        <table width="100%">
          <tbody>
<?php 
print <<< LOGIN

   <tr>
	<td colspan=2><center><font color=GREEN>Enter the details and Submit, your Password will be mailed to you</font></center></td>
  </tr>
  <tr>
	<td align="right">E-mail:</td>
	<td> 
        <p><input type="text" name="email" value=""></p>
	</td>
  </tr>
   <tr>
	<td align="right">First Name:<span style="color:Red">*</span></td>
	<td> 
        <p><input type="text" name="firstName" value=""></p>
	</td>
  </tr>
  <tr>
	<td align="right">Last Name:<span style="color:Red">*</span></td>
	<td> 
        <p><input type="text" name="lastName" value=""></p>
	</td>
  </tr>
  <tr>
	<td align="right">User Name:<span style="color:Red">*</span></td>
	<td> 
        <p><input type="text" name="userName" value=""></p>
	</td>
  </tr>  
  <tr>
	<td align="right"></td>
	<td> 
        <p>Fields marked <span style="color:Red">*</span> are optional</p>
	</td>
  </tr>
 <tr>
   <td colspan=2><center>
<input name="action" type="hidden" value="login">
             <input type="submit" value=" SUBMIT "></center>
   </td>
  </tr>
LOGIN;
?>
          </tbody>
        </table>
</div>
      </form>
</body>
</html>
