<?php
//$server = localhost;
//$username = root;
//$password = indian33;
//$database = 'serialdb';


include('config_serial.inc');
$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

$submit = $_POST['submit'];
$filename11 = $_GET['filename'];
if($submit)
{
$filename11 = $_POST['filename11'];
$filename = $_FILES['random_file']['name'];
$uploaddir = '/home/virtual/site180/fst/var/www/html/online/';
$uploadfile = $uploaddir . $filename11;

//upload files here
//print "<pre>";
//if(move_uploaded_file($_FILES['random_file']['tmp_name'], $uploadfile))
//{
//print "File is valid, and was successfully uploaded. ";
//}
//else
//{
//print "Possible file upload attack!  Here's some debugging info:\n";
//print_r($_FILES);
//}
//print "</pre>";

//Read from uploaded file here
if (!$file_handle_r = fopen($uploadfile,"r")) 
{
  echo "Cannot open file"; 
}
else
{
  //print("<br>file open success");
  if (!$file_contents = fread($file_handle_r, filesize($uploadfile)))
  { 
    //echo "Cannot retrieve file contents."; 
  }
  $file_contents_records = explode("\n",$file_contents);
  foreach ($file_contents_records as $value_entire)
  {
  $flag = 0;
 $result = mysqli_query($db_connect,"SELECT serial_no FROM serial");
 while($data = mysqli_fetch_row($result))
 {
   if($value_entire == $data[0])
   {
     print("The Duplicate serial no $value_entire was not written<br>");
     $flag = 1;
   }
 } 
 if($flag != 1)
 {
 if($value_entire != '')
 {
  $result = mysqli_query($db_connect,"INSERT INTO serial values('','$value_entire','')");
 }
 }
 }
}
print("<center><b>The Random Numbers have been Uploaded</b><br>");
print("<a href=\"dbasewrite.php\">Upload Again</a></center>");
//print("$file_handle_r<br>");
//print("$filename<br>");
//print("Message posted");
}

else
{
print<<<ENDL
<br>
<br>
<br>
<br>
<br>
<form enctype="multipart/form-data" name="form" action="dbasewrite.php" method="POST">
<font color="203C70">
<center><b>Random Numbers File Upload</b></center>
<br>
<table align="center" cellspacing=0 cellpadding=0>

<tr>
<td>
<font color="203C70">File Name:</font>
</td>
<td>
<input type="text" size="30" name="filename11" value="$filename11">
</td>
</tr>
<tr>
<td>
</td>
<td align="center">
<!--<input type="hidden" name="MAX_FILE_SIZE" value="30000"/>
-->
<input type="submit" name="submit" value="Upload"/>
</td>
</tr>
</table>
</form>
</font>
ENDL;
}
?>
