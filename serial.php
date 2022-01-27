<?php

$candid = $_GET['candid'];
$groid = $_GET['groid'];
$prefix = $_GET['prefix'];

function serial_fun($candid,$groid,$prefix)
{
print <<< AAA
<html>
<head>
<title>Serial Number Entry</title>
<link REL=StyleSheet HREF="style.css" TYPE="text/css">
<script language="JavaScript">
<!--
function validate_form() {
  validity = true; // assume valid
  if (document.form.cbox.checked)
  {
  validity = true;
  }
  else
  {
  alert("You need to agree with the terms and conditions.");
  validity = false;
  }
  return validity;
}
-->
</script>
</head>
<body>
<br>
<br>
<center>
<font face="arial" size="2"><i><strong><font face="arial" color="#999999" size="4">Serial Number Entry <br> </font></strong></i></font> 

<hr size="1" color="#c0c0c0" width="75%" align="center">
<hr size="1" width="60%" noshade>
<br>
<center>
<form name=form action="serial.php" method="post" onsubmit="return validate_form()">
         <table>
          <tr>
           <td class=label align="left">Serial No: </td>
           <td align="left"><input type="text" name="serialno"></td>
          </tr>
          <tr>
           <td>
	     <input type="text" name="candid" value="$candid">
             <input type="text" name="groid" value="$groid">
             <input type="text" name="prefix" value="$prefix">
             </td>
          </tr>
     <tr>
     <td><input type="checkbox" name="cbox"></td>
     <td>I agree to the terms and conditions of the <br>licence agreement of the subscription</td>
     </tr>
     <td>
     </td> 
     <td>
     <a href="software_license_agreement.htm" onClick="window.open('software_license_agreement.htm','RIC','width=545,height=400 resizable=no scrollbars=yes'); return false;">Subscription Agreement</a>
     </td>
     </tr>
     <tr>   
     <td></td> 
     <td></td>
     </tr>
     <tr>
     <td></td> 
     <td align="center"><input type="submit" name="submit" value="Submit!"/>
          </td>
          </tr>     
         </table>
         </form>
</center>
</body>
</html>
AAA;
}

function serial_connect($serialno,$candid,$groid,$prefix)
{
include('config_serial.inc');
$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

$result_scheck = mysqli_query($db_connect,"SELECT serial_no,status FROM serial WHERE serial_no = '$serialno'"); 

$row_nar2 = mysqli_fetch_row($result_scheck);


if(($row_nar2[0]) && ($row_nar2[1] != 1))
     {
      include('config.inc');
      $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

$result_sinsert = mysqli_query($db_connect,"INSERT INTO candidateGroup values  ('','$candid','$groid')");

include('config_serial.inc');
$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);
$result_ss = mysqli_query($db_connect,"UPDATE serial SET status = 1 WHERE serial_no='$serialno'");
     print <<< VVV
<center><b><font color="203C70">Full Exam Activated</font></b>
<br><font color="203C70">Thank You!</font></center>
VVV;


     }
     else
     {
       print <<< DDD
<center><b><font color="#203C70">Invalid Serial Number</font><br></b></center>
DDD;
      serial_fun($candid,$groid,$prefix);
      exit;
     } 

}
 if($submit)
 {
 	$candid = $_POST['candid'];
$groid = $_POST['groid'];
$prefix = $_POST['prefix'];

echo $candid;

   include('config.inc');
   $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

   $candid = $_POST['candid'];
   $groid = $_POST['groid'];
   $prefix = $_POST['prefix'];
   $serialno = $_POST['serialno'];
   $ser_fpart = substr($serialno,0,2);

    if($ser_fpart != $prefix)
    {  
      print("<center><b><font color=\"#203C70\">Invalid Serial Number</ 
      font><br></b></center>");
      serial_fun($candid,$groid,$prefix);
      exit;
    }
   $resultnaresh = mysqli_query($db_connect,"SELECT groupid from candidateGroup WHERE 
   candidateID ='$candid' AND groupid='$groid'");
   $row_nar = mysqli_fetch_row($resultnaresh);

    if($row_nar[0])
    {
print <<< FFF
      <script language="javascript">
      alert("Full exams for this group have already been activated");
      location.href="takeTest.php?ID=$candid";
      </script>
FFF;
      exit;
    }
   else
   {
    
       serial_connect($serialno,$candid,$groid,$prefix);
   }
     
}   
else
{
serial_fun($candid,$groid,$prefix);
}
?>
