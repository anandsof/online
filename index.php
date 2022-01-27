<?php
  session_start();
  $name = 'userName';
  $value = $_POST['userName'];
  $_SESSION['userName']= "$value";
  #session_register($name);
  $cookie = base64_encode(serialize($value));
  setcookie($name, $cookie, time()+43200);
  
  ?>
<html>
<head>
  <title>certExams - Online Test</title>
  <meta name="author" content="Ravishankar Bhatia">
 <meta name="copyright" content="Anandsoft.com">
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
		passwindow=window.open(filename, 'PasswordReminder', 'status=1,width=400,height=300,scrollbars=yes,resizable=yes')
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

 $nar_usname = $userName;
 $result =  mysqli_query($db_connect,"SELECT candidateID,userName,userPassword,admin FROM candidate WHERE Userstat='active'");
  while ($row = mysqli_fetch_row($result))
  {
  if (($userName == $row[1]) && ($password == $row[2]))
      {
        $flag = 1;
        $ID = $row[0];
        $admin = $row[3];
      }
  }

$notactive = 0;

 $resultn =  mysqli_query($db_connect,"SELECT candidateID,userName,userPassword,admin FROM candidate");
  while ($rown = mysqli_fetch_row($resultn))
  {
  if (($userName == $rown[1]) && ($password == $rown[2]))
      {
        $flagn = 1;
        $ID = $rown[0];
        $admin = $rown[3];
      }
  }

if(($flag == 0) && ($flagn == 1))
{
$notactive = 1;
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
     if($notactive == 1)
     { 
     $message .= "Please activate your account by logging into your mailbox.\n";
     }
     else
     {
      $message .= "Invalid User Name or Password\n";
     }      
     }
 }
else 
{
  $result =  mysqli_query($db_connect,"SELECT candidateID FROM candidate WHERE sdate <= CURDATE() AND edate >= CURDATE() AND candidateID = '$ID'  OR (sdate = 0 AND edate = 0 AND candidateID = '$ID')");
  if($row = mysqli_fetch_row($result))
 	$fg = 1;
   if($fg == 1)
   {
      $userName = $_SESSION['userName'];
      $_SESSION['userName'] = $userName;
      $message = $userName;
      $ipaddress_now = $_SERVER["REMOTE_ADDR"];
      $result =  mysqli_query($db_connect,"SELECT * FROM active WHERE userName = '$userName'");
      $resultnn = mysqli_query($db_connect,"SELECT lnumber FROM plogins WHERE userName = '$userName'");
   $resnn = mysqli_fetch_row($resultnn);
   $pnol = $resnn[0];
#print $pnol;
      if($res = mysqli_fetch_row($result))
      {
//$resultn =  mysqli_query("SELECT ipaddress FROM active WHERE userName = '$userName'");
$resultn =  mysqli_query($db_connect,"SELECT * FROM active WHERE userName = '$userName' AND sdata =CURDATE() AND status='loggedin'");
  
     $g = 1;
//$result1 =  mysqli_query("DELETE FROM active WHERE userName = '$userName'");
while($resn = mysqli_fetch_row($resultn))
     {
       $ipaddress_in_table = $resn[0];  
       $g = $g + 1;
     } 
     //splits the variable into chunks of array seperated by .
   
     $ippart = explode(".", $ipaddress_in_table);
     $ippartn = explode(".", $ipaddress_now);
                    
     //print("1 : $ippart[0]<br>"); 
     //print("2 : $ippart[1]<br>"); 
     //print("3 : $ippart[2]<br>"); 
     //print("4 : $ippart[3]<br>"); 
     $half_ip_table = "$ippart[2]."."$ippart[3]";
     $half_ip_now = "$ippartn[2]."."$ippartn[3]";
// if($half_ip_table != $half_ip_now)
//    {
//      $differentlogin = 1;
//    }
//    if($differentlogin)
//    {
//print("<center><font size=\"3\" color = \"FF0000\">Status : User Already Logged In <br>You are trying to login from multiple machines which is not allowed<br>or probably you have not logged out last time.Make sure you logout before you close the browser.</font></center>"); 
//exit; 
//    }  

if(!$pnol)
{
$pnol = 1;
}
if($g > $pnol)
{
print("<br><br><br><br><br><center><font size=\"3\" color = \"FF0000\">Status : You are already logged in for permitted number of times<br><a href=\"logout_old_entries.php?user_name=$nar_usname\">Logout old Entries</a></font></center>");
exit; 
    }
if($g > 100)
{
print("<center><font size=\"3\" color = \"FF0000\">Status : User Already Logged In <br>You are trying to login from same machine multiple times which is not allowed<br>or probably you have not logged out last time.Make sure you logout before you close the browser.</font></center>");
exit; 
    }
}
//     print("tab:$half_ip_table<br>");
//     print("now:$half_ip_now<br>"); 
         
//     $c_hour = date("H");    //Current Hour
//     $c_min = date("i");    //Current Minute
//     $c_sec = date("s");    //Current Second
//     $c_mon = date("m");    //Current Month
//     $c_day = date("d");    //Current Day
//     $c_year = date("Y");
$sess_id = session_id();     
//$login_time = mktime($c_hour,$c_min,$c_sec,$c_mon,$c_day,$c_year);
$result =  mysqli_query($db_connect,"INSERT INTO active (activeid, userName, value, stime,ipaddress,sdata,status) VALUES('','$userName','$sess_id',now(),'$ipaddress_now',CURDATE(),'loggedin')");
//$res =  mysqli_query("SELECT MAX(activeid) FROM active WHERE userName ='$userName'");
//while($re = mysqli_fetch_row($res))
  //   {
  //     $activeid = $re[0];  
  //   }
  //session_start();
  //$name = '$activeid';
  //session_register($name);
  //$cookie = base64_encode(serialize($value));
  //setcookie($name, $cookie, time()+7200);
    $message = " <script language=\"JavaScript\">
    <!--
      location.href=\"admin_index.php?ID=$ID&uname=$userName\";
     // -->
     </script>"; 
}
  else
   {
     $message = "Your subscription period has expired\n<BR>Contact Admin\n";
    }
}

/*else if (!$admin)
   $message = " <script language=\"JavaScript\">
    <!--
      location.href=\"ewn_index.php?ID=$ID\";
     // -->
  </script>"; */

 }

?>
<div align="center">
<center>
<table style="width: 800;">
  <tbody>
<tr>
<td>
 <center><B><BIG><BIG>MEMBER'S LOGIN AREA</BIG></BIG></B></center>
</td>
<td>
</td>
</tr>
<tr><td>
      <p>You will need to login before you can take any tests. If you do not have an account, you can register by clicking <a
 href="profile.php">here</a>.</p>
      </td></tr>
    <tr>
      <td valign="top">
      <form name="form" method="post" action="index.php" onsubmit="return checkfields()">
        <div class="menu">
        <center><b>Log in</b></center>
        <br><center>
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
        <p><input type="text" name="userName" value="$userName"  maxlength="20"></p>
	</td>
  </tr>
  <tr>
	<td align="right">Password:</td>
	<td> 				
        <p><input type="password" name="password" value="$password" maxlength="20">
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
</center>
        </div>
      </form>
      </td>
 
    </tr>
  </tbody>
</table>
</center>
</div>
<div align="center">
  <center>
  <table border="0" cellpadding="0" cellspacing="0" width="800">
    <tr>
      <td width="100%" colspan="8" align="left"><font face="Verdana" size="5">Available
        Online Exams:</font></td>
    </tr>
    <tr>
      <td width="13%" align="center"><font size="2" face="Verdana"><a href="http://www.certexams.com/comptia/a+/a+core1-exam-details.htm" target="_blank">A+ Core 1</a></font></td>
      <td width="12%" align="center"><font size="2" face="Verdana"><a href="http://www.certexams.com/comptia/a+/a+core2-exam-details.htm" target="_blank">A+ Core 2</a></font></td>
      <td width="13%" align="center"><font size="2" face="Verdana"><a href="http://www.certexams.com/comptia/net+/online-exam-details.htm" target="_blank">Network+</a></font></td>
      <td width="12%" align="center"><font size="2" face="Verdana"><a href="http://www.certexams.com/comptia/security+/online-exam-details.htm" target="_blank">Security+</a></font></td>
      </tr>
      <tr>
      <td><br></td><td><br></td>
<td><br></td>
<td><br></td>

</tr>
      <tr>
      <td width="13%" align="center"><font size="2" face="Verdana"><a href="http://www.certexams.com/comptia/server+/online-exam-details.htm" target="_blank">Server+</a></font></td>
      <td width="12%" align="center"><font size="2" face="Verdana"><a href="http://www.certexams.com/cisco/ccna/exam-details.htm" target="_blank">CCNA</a></font></td>
      <td width="13%" align="center"><font size="2" face="Verdana"><a href="http://www.certexams.com/JuniperSim/exam-details.htm" target="_blank">JNCIA-Junos</a></font></td>
      <td width="12%" align="center"><font size="2" face="Verdana"><a href="http://www.certexams.com/pmp/exam-details.htm" target="_blank">PMP</a></font></td>
    
      </tr>
    
  </table>
  </center>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>

<br>
<!-- <br>
<p align="right"><font color=BLACK>&copy; anandsoft.com</font></p> -->
</body>
</html>
