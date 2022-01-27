<?php
 include('cookie.php');
?>
<html>
<head>
<script Language="javascript">	

function MM_openBrWindow(theURL,winName,feature) { //v2.0
  newWindow = window.open(theURL,winName,feature);
  newWindow.focus();
}


function NewWindow(mypage, myname, w, h, scroll)
{
var winl = (screen.width - w) / 2;
var wint = (screen.height - h) / 2;
winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable'
win = window.open(mypage, myname, winprops)
if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
}

   function goResult()
   {
    window.close()
   }
		
		var questionNo
		var intQuesNo
		var maxQuestionNo = 15

	function goToQuestion(form)
		{
			questionNo = prompt("Please enter question number:","")
			if ((questionNo !=null) && (questionNo !=""))
			{
				if (isNumberString(questionNo))
				{
					intQuesNo=parseInt(questionNo)
					if ((intQuesNo>=1) && (intQuesNo<=(document.form.max.value)))
					{
						location.href="viewReview.php?scoreid="+document.form.scoreid.value+"&Page="+questionNo ;
					}
					else
					{
						alert("Question number should between 1 and " + document.form.max.value + ".")
					}
				}
				else
				{
					alert("Please input number into the empty line.")
				}
			}
		}

		function isNumberString (InString)  
		{
			if(InString.length==0) 
				return (false)
			RefString="1234567890"
			for (Count=0; Count < InString.length; Count++)  
			{
				TempChar= InString.substring (Count, Count+1)
				if (RefString.indexOf (TempChar, 0)==-1)  
					return (false)
			}
			return (true)
		}
	</script>


<title>Review Screen</title>
<link rel="stylesheet" type="text/css" href="Master.css">
</head>
<body bgcolor="#ffffff" text="#000000" link="#000000" vlink="#000080" alink="#000000">

<form name="form" action="viewReview.php" method="post">

<?php

include('config.inc');

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

 if ($scoreid = $_GET['scoreid'])
   ;
 else
  $scoreid = $_POST['scoreid'];

 if ($evt = $_POST['Page'])
  ;
 else
  $evt = $_GET['Page'];

  if(!$evt) { $evt = 1; }

$submit = $_POST['submit']; 
 if ($submit == "back")
   $evt = $evt-1; 
 else if ($submit == "next")
   $evt = $evt+1; 


 $q1 = mysqli_query($db_connect,"SELECT questionid, answer, marks FROM test where scoreid ='$scoreid' ORDER BY questionid");

for ($i = 1 ; $row = mysqli_fetch_row($q1) ; $i++)
{
 $qArray[$i] = $row[0];
 $aArray[$i] = stripslashes($row[1]);
 $mArray[$i] = $row[2];
}

$i = $i-1;

print ("<input type=hidden name=max value=$i>");

if ($evt != ($i+1))
{
$query = mysqli_query($db_connect,"SELECT * FROM question where questionid='$qArray[$evt]'");

 $val = mysqli_fetch_row($query);

// IF the Question has a Image 
 
  $result =  mysqli_query($db_connect,"SELECT * FROM images WHERE questionid = '$val[0]'");
  if($img = mysqli_fetch_row($result))
  {
   $imageid = $img[0];
   $description = stripslashes($img[2]);
   $filename = $img[3];
   $filesize = $img[4];
   $width = $img[5];
   $height = $img[6];
   $filetype = $img[7];
   $data = $img[8];
// print("$imageid $description $filename $filesize $width $height $filetype");
  } 


print <<< ENDREVIEW
  <div align="center"><center><p><font face="Arial">
      <small><i>Question $evt </i><br>
 </small></font></p>

  </center></div><hr>
  <div align="center">
  <center><table border="0" width="80%" cellspacing="0" cellpadding="0">
<tr><td>
ENDREVIEW;

 if ($mArray[$evt] != 0)
  print ("<img src=\"check.gif\" border=0>");
 else 
  print ("<img src=\"x.gif\" border=0>");

  $val[1] = stripslashes($val[1]);

print <<< ENDREVIEW
</td></tr>
    <tr>
      <td valign="top" width="10%"><big><big><big>
      <font face="Arial"><strong>Q</strong></font></big></big></big></td>
      <td width="90%"><font face="Arial">
 <small> $val[1] </small></font><br><br></td>
   </tr>
ENDREVIEW;

 if($val[14] == 'dd')
 {
  print ("<tr><td valign=top width=10%></td><td width=90%><font  face=\"Arial\">Correct Answer:</font></td></tr>");
$di = 0;
print ("<tr>\n<td valign =top width=10%></td><td width=90%><table  cellpading=0 cellspacing=5>");
  for ($col = 2, $a = 'A' ; $col <= 7 ; $col++,$a++)
  {
   if ($val[$col])
   {
	       	$match = explode("-1-1-1-",$val[$col]);
        	$Q[$di] = $match[0];
        	$A[$di] = $match[1];
	$Q[$di] = stripslashes($Q[$di]);
	$A[$di] = stripslashes($A[$di]);

   print("<tr><td valign =top width=10%><small>\n<font face=\"Arial\">$a)</font></small></td><td><table border=1 cellpading=0 cellspacing=0><tr><td><small><font face=\"Arial\"> $Q[$di] </font></small></td></tr></table></td><td><table border=1 cellpading=0 cellspacing=0><tr><td><small><font face=\"Arial\"> $A[$di] </font></small></td></tr></table></td></tr>");
         $di++;
   }
  }
 print("</table></td></tr>");
 }
 else
  for ($col = 2, $a = 'A' ; $col <= 7 ; $col++,$a++)
  {
    if ($val[$col])
   {
     $val[$col] = stripslashes($val[$col]);
   print ("<tr>\n<td valign =top width=10%><small>\n<font face=\"Arial\">$a)</font></small></td><td width=90%><small><font face=\"Arial\">$val[$col]<br><br></font></small></td></tr>");
   }
 }

// if Image
 if ($imageid)
 {
  print ("<tr>
      <td valign=\"top\" width=\"10%\"><font face=\"Arial\" color=\"BLUE\"> Image</font></td>
      <td width=\"90%\"><a href=\"javascript: onclick=MM_openBrWindow('picture.php?imageid=$imageid','Image','width=$width,height=$height' )\">$description</a><br><br></td>
</tr>");
  }

if($val[14] == 'dd')
{
print ("<tr><td valign=top width=10%></td><td width=90%><font  face=\"Arial\">Your Answer:</font></td></tr>");

  $di = 0;
 $dresult =  mysqli_query($db_connect,"SELECT * FROM dragdrop WHERE questionid = '$val[0]' AND scoreid='$scoreid'");
  while($dval = mysqli_fetch_row($dresult))
  {
print ("<tr>\n<td valign =top width=10%></td><td width=90%><table  cellpading=0 cellspacing=5>");
   for ($col = 2,$a = 'A'; $col <= 7 ; $col++,$a++)
   {
     if ($dval[$col])
     {
        	$match = explode("-1-1-1-",$dval[$col]);
        	$Q[$di] = $match[0];
        	$A[$di] = $match[1];
	$Q[$di] = stripslashes($Q[$di]);
	$A[$di] = stripslashes($A[$di]);

   print("<tr><td valign =top width=10%><small>\n<font face=\"Arial\">$a)</font></small></td><td><table border=1 cellpading=0 cellspacing=0><tr><td><small><font face=\"Arial\"> $Q[$di] </font></small></td></tr></table></td><td><table border=1 cellpading=0 cellspacing=0><tr><td><small><font face=\"Arial\"> $A[$di] </font></small></td></tr></table></td></tr>");

                $di++;
     }
   } 
 print("</table></td></tr>");
  }
	if ($di == 0)
	{
	 $aa = "<font color=RED> You did not answer this question </font>";
	print("<tr>\n<td valign =top width=10%></td>\n<td width=90%>&nbsp;&nbsp;&nbsp;&nbsp;\n $aa</td></tr>\n");
	}
}
else
{
print ("<tr><td valign=top width=10%></td><td width=90%><font  face=\"Arial\">Correct Answer:</font></td></tr>");
	$val[8] = stripslashes($val[8]);
  print ("<tr><td valign =top width=10%></td><td width=90%><small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font face=\"Arial\" color=#0000FF> $val[8] </font></small></td></tr>");
 
if ($aArray[$evt] == "")
 $aa = "<font color=RED> You did not answer this question </font>";
else
 $aa = $aArray[$evt];

 $aa = stripslashes($aa);

print <<< ENDREVIEW
<td valign =top width=10%></td>
<td width=90%><font face="Arial">Your Answer:</font></td>
</tr>
<tr>
<td valign =top width=10%></td>
<td width=90%><small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font face="Arial" color=#0000FF> $aa </font></small>
</td>
</tr>
ENDREVIEW;
}

 $val[10] = stripslashes($val[10]);
 $val[12] = stripslashes($val[12]);

print <<< ENDREVIEW

<tr><td valign =top width=10%></td><td width=90%>
<font face="Arial">Feedback:</font></td>
</tr>
<tr>
<td valign =top width=10%></td>
<td width=90%><font face="Arial"><small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $val[10] </font></small>
</td></tr>
<tr><td valign =top width=10%></td><td width=90%>
<font face="Arial">References:</font></td>
</tr>
<tr>
<td valign =top width=10%></td>
<td width=90%><font face="Arial"><small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $val[12] </font></small>
</td></tr>
ENDREVIEW;

}


print <<< ENDTHIS
 </table>
  </center></div><hr align="center">
  
  <div align="center"><center>
<p><font face="Arial">
ENDTHIS;

print ("<input type=\"hidden\" name=\"Page\" value=\"$evt\"> ");
print ("<input type=\"hidden\" name=\"scoreid\" value=\"$scoreid\"> ");


if( $evt != 1)
 print (" <input type=\"submit\" name=\"submit\" value=\"back\"> ");
// print ("<input type=image src=\"back.jpg\" name=\"submit\" value=\"back\" border=0>");

if( $evt != $i)
 print ("<input type=\"submit\" name=\"submit\" value=\"next\"> ");
// print ("<input type=image src=\"next.jpg\" name=\"submit\" value=\"next\" border=0>");

?>

 <input type="button" value="Go to Question" name="btnGoToQuestion" onClick="goToQuestion(this.form)"> 
  
  <input type="button" value="Exit" name="btnEndTest" onClick="goResult()">
<br><br>
	   </font>
  </center></div>
</form>
<p align="right"><font color=BLACK>&copy; anandsoft.com</font></p>
</body>
</html>
