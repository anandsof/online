<?php
include('logged.php');
?>
<html>
<head>
<title>Edit Profile</title>
<link REL=StyleSheet HREF="style.css" TYPE="text/css">
    	
</head>
<body>
<?php
 include('config.inc');

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);
 if ($candidateID = $_GET['candidateID'])
 {

 $result =  mysqli_query($db_connect,"SELECT * FROM candidate WHERE candidateID ='$candidateID'");
 $row = mysqli_fetch_row($result);

 $candidateID = $row[0]; 
 $firstName = $row[3];
 $lastName = $row[4];
 $email = $row[5];
  $Inforeceipt = $row[26];

 if($Inforeceipt == "yes")
 {
 $offerbox = "checked" ;
 }
 else
 {
 $offerbox = "" ;
 }
     
}
if ($_POST['action'] == "edit")
{
 $candidateID=$_POST['candidateID'];
 $offerbox = $_POST['offerbox'];

 if($offerbox)
 {
 $inforeceipt="yes";
 }
 else
 {
 $inforeceipt="no";
 }
 
$query = "UPDATE candidate SET Inforeceipt='$inforeceipt' WHERE candidateID = '$candidateID'";
$result = mysqli_query($db_connect,$query);
print ("<center><br><br><br><br><br><br>
This Profile has been updated successfully </center>");
print<<<CCF
<center>
<a href="editsubscription.php">Back</a>
</center>
CCF;
exit;
}

?>
<center>
<font face="arial" size="2"><i><strong><font face="arial" color="#999999" size="4">Edit Candidate Profile<br> </font></strong></i></font> 

<hr size="1" color="#c0c0c0" width="75%" align="center">
<hr size="1" width="60%" noshade>
<br>
<form action="editsubscrip.php" name="form" method="post" >

<?php 
print("<font color=RED>$message</font>\n");
print <<< PROFILE
<table>
<tr>

       <td class=label  align="right">First Name </td>
       <td><input name="firstName" type="text" value="$firstName"></td>
</tr>
<tr>
       <td class=label  align="right">Last Name </td>
       <td><input name="lastName" type="text" value="$lastName"></td>

</tr>
<tr>
       <td class=label  align="right">E-mail </td>
       <td><input name="email" type="text" value="$email" size='35'></td>
</tr>
PROFILE;
      
?>
</table><br><br>
<table>
<tr>
<td class=label align="right"><font size="1">Please check the box to receive special offers and other useful information to your email address:</font></td>
<td><input name="offerbox" type="checkbox" <?php echo $offerbox ?>></td>
</tr>
</table>
<input name="action" type="hidden" value="edit">
<input name="candidateID" type="hidden" value=<?php print("$candidateID") ?>>
<input name="ID" type="hidden" value=<?php print("$ID") ?>>
<input type="submit" name="submit" value="Save Change">
</form>
</center>
</body>
</html>
