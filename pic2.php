<html>
<head>
 <title>certExams - Online Test</title>
  <meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Cache-Control" content="no-cache" />
  <meta http-equiv="Content-Type" content="text/html" />
  <meta name="author" content="Ravishankar Bhatia" />
  <meta name="copyright" content="Anandsoft.com">

 <script language="JavaScript">
<!--
function closeWindow() {
   window.close()
}
//-->
  </script>

<link REL=StyleSheet HREF="myStyle.css" TYPE="text/css">
</head>
<body>
<?php
 include('config.inc');

 $imageid = $_GET['imageid'];
//print("ImageID = $imageid");

    if (isset($imageid)) 
    {

	$count = 0;

	 if ($handle = opendir("imageshow")) {
	   while (false !== ($file = readdir($handle))) {
	       if ($file != "." && $file != "..") {
	           $count++;
	       }
	   }
	   closedir($handle);
	}

	$i = 0;
	 if ($handle = opendir("imageshow")) {
	   while (false !== ($filename = readdir($handle))) {
	       if ($filename != "." && $filename != "..") {
		$i++;
		if($imageid == $i)
			print"<img src=\"imageshow/$filename\" width=\"400\" height=\"400\">";
		} 
	   }
	}
	closedir($handle); 
	}
	else
	{
		print("<font color=RED>Invalid Image, Error</font>");
	}

$prev = $imageid - 1;
$next = $imageid + 1;

print <<< IMAGE
<center>
<table width="100%">
<tr>
<td width="50">
<div align="left">
IMAGE;

if($prev > 0)
  print ("<a href=\"pic2.php?imageid=$prev\">Previous</a>");

print <<< IMAGE
</div></td>
<td width="50">
<div align="right">
IMAGE;

if($next <= $count)
  print("<a href=\"pic2.php?imageid=$next\">Next</a>");

print <<< IMAGE
</div>
</td>
</tr>
</table>
</center>
IMAGE;
?>
<p align="right"><small><a href="javascript:closeWindow()">Close this
window</a></small></p>
</body>
</html>
