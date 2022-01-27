<?php
include('config.inc');

$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

$id = $_GET['id'];
$result =  mysqli_query($db_connect,"UPDATE candidate SET Userstat='active'  WHERE candidateID='$id'");

print<<<AAA
<html>
<head>
<title>Account Activation</title>
<link REL=StyleSheet HREF="style.css" TYPE="text/css">
</head>
<body>
<center>
<font face="arial" size="2"><i><strong><font face="arial" color="#999999" size="3"><center>Congratulations</center><br> </font></strong></i></font>
<hr size="1" color="#c0c0c0" width="75%" align="center">
<hr size="1" width="60%" noshade>
<br> 
Your account has been activated
</font>
</center>
</body>
</html>
AAA;
?>