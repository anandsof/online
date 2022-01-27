<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
 <title>phpTest</title>
  <meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Cache-Control" content="no-cache" />
  <meta http-equiv="Content-Type" content="text/html" />
  <meta name="author" content="Brandon Tallent" />
<body>


<?php
 include('config.inc');

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);
if($_POST['submit'])
{
  $image = $HTTP_POST_FILES['image'];
  $description = $_POST['description'];
  $questionid = 20;
print ("Image File :".$HTTP_POST_FILES['image']['tmp_name']."<BR>");
  $fd = fopen($HTTP_POST_FILES['image']['tmp_name'], 'r') or die("can't open file");
  $fr = fread($fd,filesize($HTTP_POST_FILES['image']['tmp_name']));
  fclose($fd);
  $data = addslashes($fr);
 print ("DATA<BR>");
 print ("$data");
  // if the user didn't fill in a description, add a default.
   $description = ($description == '') ? 'Attached image' : $description;
/*
  $query = mysqli_query($db_connect,"INSERT INTO images(imageid,questionid,description,filename,filesize,width,height,filetype,data) values(NULL,'$questionid', '$description', '$image','',' ','','','$data')"); */
 }
?>

<form enctype="multipart/form-data" method="post" action="image.php">
<table>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;description </td>
       <td colspan=2><input type="text" name='description' length='20' maxlength='50'> </td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Image </td>
       <td colspan=2><input type="file" name="image"> </td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp; </td>
       <td colspan=2><input type="submit" name="submit" value="submit"> </td>
</tr>
</table>
</form>
</body>
</html>
