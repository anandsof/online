
<html>
<head>
	<title>Instructions</title>

<style>body {font-family: Verdana,Arial,Helvetica; font-size: smaller; color: #000000; margin-right: 10%;}
td {font-family: Verdana,Arial,Helvetica; font-size: smaller; color: #000000}
th {font-family: Verdana,Arial,Helvetica; font-size: smaller; color: #000000}
A:link {text-decoration: none; color:#0000a0}
A:visited {text-decoration: none;}
A:hover {text-decoration: underline;color:#ff0000}
td.label  { color: #000000; background: #f4f4f4 }
body.navframe {font-family: Verdana,Arial,Helvetica; font-size: smaller; color: #000000; background: #ffffd7}
</style>
 <script language="JavaScript">
<!--
function closeWindow() {
   window.close()
}
//-->
  </script>

</head>
<body>

<?php
include('config.inc');

 $ID = $_GET['id'];

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

  $result =  mysqli_query($db_connect,"SELECT title,id,instructions,time FROM exam WHERE examID='$ID'");
  $row = mysqli_fetch_row($result);
  $title = $row[0];
  $id = $row[1];
  $instructions = $row[2];
  $time = $row[3];
print <<< INSTRUCTIONS
<h3><u>$title</u></h3>
<b>Exam ID: $id</b><br>
<b>Instructions: </b>
<br>$instructions<br><br>
<b>Time Limit: $time minutes </b><BR>
INSTRUCTIONS;
?>
<p align="right"><small><a href="javascript:closeWindow()">Close this
window</a></small></p>
</body>
</html>
