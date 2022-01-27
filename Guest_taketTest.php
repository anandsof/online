
<html>
<head>
 <title>certExams - Online Test</title>
<script LANGUAGE="JavaScript">
<!-- Begin

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
//  End -->
</script>
<link REL=StyleSheet HREF="style.css" TYPE="text/css">	
</head>
<body>

<?php
include('config.inc');

 $ID = $_GET['ID'];
$gro = 4;

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

  $result =  mysqli_query($db_connect,"select scoreid from scores where candidateID = '$ID'",$db_connectv);
  while($row = mysqli_fetch_row($result))
  {
	$res =  mysqli_query($db_connect,"DELETE FROM temp WHERE scoreid = '$row[0]'");

     	$yes = 0;
	$result1 =  mysqli_query($db_connect,"select scoreid from test where scoreid = '$row[0]'");
  	while($row = mysqli_fetch_row($result1))
		$yes = 1;
   	if($yes == 0)
	   $dquery = mysqli_query($db_connect,"delete from scores where scoreid = '$row[0]'");
   }

  $result =  mysqli_query($db_connect,"SELECT firstName,lastName FROM candidate WHERE candidateID='$ID'");
  $row = mysqli_fetch_row($result);
  $firstName = $row[0];
  $lastName = $row[1];
  $cid = $ID;
?>  


<table width='100%'>
 <tr>
 <td align='left' width='40%'>Different Tests Available</td>
 <td width='20%' align='left'></td>
 <td align='right' width='40%'></td>
 </tr>
</table>

 <hr width='100%' size='1' align='left'><br>

<table width='100%' border='1' cellspacing='1' cellpadding='2'>
<tr>
       <td align='left'><b>Exam Name</b></a></td>
       <td align='left'><b>Exam ID</b></td>
       <td align='left'><b>Version</b></td>
       <td align='left'><b>Action</b></td>
</tr>

<?php 
  $result =  mysqli_query($db_connect,"SELECT * FROM exam, candidateGroup WHERE startDate <= CURDATE() AND endDate >= CURDATE() AND candidateGroup.groupid=exam.groupid AND candidateID = '$ID'");

while($row = mysqli_fetch_row($result))
{
$flag = 1;
print <<< EXAM
<tr valign='middle'>
<td>$row[1] - <a href='instructions.php?id=$row[0]' onclick="NewWindow(this.href,'name','600','400','yes');return false;"><b><big>I</big>NSTRUCTIONS</b></a></td>
 <td>$row[2] </td> 
 <td>$row[3] </td> 
 <td>
 <form action='' method='post' name='x0'>
 <input name='status' type='hidden' value='new'>
<a href="testChoice.php?examid=$row[0]&cid=$cid">
<img src='pencil.gif' alt='Take Exam' border='0'>Take Exam<br>
EXAM;

$result_s =  mysqli_query($db_connect,"SELECT prefix,groupid FROM serial_prefixes WHERE examid = '$row[0]'");
$row_nar = mysqli_fetch_row($result_s);

if($row[12] == 1)
{
print <<< AAA
<a href ="serial.php?candid=$ID&groid=$row_nar[1]&prefix=$row_nar[0]">Activate Full Exam</a>
AAA;
}
print <<< EXAMAC
</a>
 </form>
 </td>
</tr>
EXAMAC;
}
if (! $flag)
{
print <<< EXAM
<tr valign='middle'>
 <td colspan=4><font color=RED>Presently No Exams Available for this group</font></td>
</tr>
EXAM;
}
mysqli_close($db_connect);
?>

</table>
</body>
</html>


