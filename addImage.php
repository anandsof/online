<?php
 include('cookie.php');

 include('config.inc');

  $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

if ($HTTP_POST_FILES['image']['tmp_name'])
{

  $description = $_POST['description'];

  $name   = $HTTP_POST_FILES['image']['name'];
echo $name;
$count = 0;

 if ($handle = opendir("imageshow")) {
   while (false !== ($file = readdir($handle))) {
       if ($file != "." && $file != "..") {
           $count++;
       }
   }
   closedir($handle);
}
$count++;

   $data = fread(fopen($HTTP_POST_FILES['image']['tmp_name'],"r"), filesize($HTTP_POST_FILES['image']['tmp_name']));

	$extension = explode(".",$name);

	$fd = fopen("imageshow/".$count.".".$extension[1], "w");
	$fout = fwrite($fd,$data);
	fclose($fd);

  // if the user didn't fill in a description, add a default.
   $description = ($description == '') ? 'Attached image' : $description;

   $message = "Image Added Sucessfully";
}

?>

<html>
<head>
 <title>certExams - online Test</title>
  <meta name="author" content="Ravishankar Bhatia">
 <meta name="copyright" content="Anandsoft.com">
 <link REL=StyleSheet HREF="myStyle.css" TYPE="text/css">	
</head>
<body>
<br> 
<center><h3>Add Image</h3></center>
<center><font color=RED><?php print("$message") ?></font></center>
<center>
<div class="menu">
<form name="form" enctype="multipart/form-data" method="post" action="addImage.php">
<table>
<tr>
<td align="right">
File :</td><td algin="left"> <input type="file" name="image">
</td>
</tr>
<tr>
<td align="right">
Description : </td><td align="left"><input type="text" name="description" value="">
</td>
</tr>
<tr>
<td colspan=2 align="center">
<input type="submit" name="submit" value="Submit!">
</td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
