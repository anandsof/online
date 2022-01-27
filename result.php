<?php
 include('cookie.php');
?>
<html>
<head>
  <title>Online-test - Results</title>
  <script language="javascript">

function reviewTest(form)
{
  var scoreid = document.form.scoreid.value;
  examWin=window.open("", "ExamWindow", "scrollbars");
  examWin.location = "review.php?scoreid="+scoreid;
}


  </script>
  <style>
<!--
.BottomLink  { color: #FFFFFF; text-decoration: none }
.BottomText  { font-size: 8pt; font-family: Arial }
.BottomLink:hover { color: #FFFFFF; text-decoration: underline }
-->
  </style>
</head>
<body marginwidth="0" marginheight="0">
<table border="0" cellpadding="10" cellspacing="0" width="524"
 bgcolor="#ffffff">
  <tbody>
    <tr>
      <td width="100%" valign="top" align="left">
     <div align="center">
      <center>

<?php
include('config.inc');

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

$examid = $_GET['examid'];
$scoreid = $_GET['scoreid']; 
$time = $_GET['time'];


$q1 = mysqli_query($db_connect,"SELECT * FROM scores where scoreid ='$scoreid'");
while ($srow = mysqli_fetch_row($q1))
{
 $ID = $srow[1];
}


$query = mysqli_query($db_connect,"select question.answer as correct , temp.answer as answer, temp.markQuestion, temp.questionid, type, category, userName, scores.candidateID from temp join question join scores join candidate where temp.questionid=question.questionid and temp.scoreid = scores.scoreid and scores.candidateID=candidate.candidateID  and temp.scoreid = '$scoreid' ORDER BY questionid");
for ($i = 0; $row = mysqli_fetch_row($query) ; $i++)
{
 $qans[$i] = stripslashes($row[0]);
 $tans[$i] = stripslashes($row[1]);
 $markQuestion[$i] = $row[2];
 $qid[$i] = $row[3];
 $type[$i] = $row[4];
 $category[$i] = stripslashes($row[5]);
 $userName = stripslashes($row[6]);
 $cid = $row[7];
}

$max = $i;

// To count no. of attempted Q and no. of Q right
$correct = 0;
$attemped = 0;
for ($j=0; IsSet ($tans[$j]) ; $j++)
{

// if it is drag and drop
 if ($type[$j] == 'dd')
 {
	$ddquery = mysqli_query($db_connect,"SELECT choice1, choice1, choice2, choice3, choice4, choice5, choice6 FROM question WHERE questionid='$qid[$j]'");
	$ddrow = mysqli_fetch_row($ddquery);
         $ch1 = stripslashes($ddrow[0]);
         $ch2 = stripslashes($ddrow[1]);
         $ch3 = stripslashes($ddrow[2]);
         $ch4 = stripslashes($ddrow[3]);
         $ch5 = stripslashes($ddrow[4]);
         $ch6 = stripslashes($ddrow[5]);

	$dquery = mysqli_query($db_connect,"SELECT choice1, choice1, choice2, choice3, choice4, choice5, choice6 FROM dragdrop WHERE questionid='$qid[$j]' and scoreid = '$scoreid'");
	$drow = mysqli_fetch_row($dquery);
         $dch1 = stripslashes($drow[0]);
         $dch2 = stripslashes($drow[1]);
         $dch3 = stripslashes($drow[2]);
         $dch4 = stripslashes($drow[3]);
         $dch5 = stripslashes($drow[4]);
         $dch6 = stripslashes($drow[5]);
  if(($ch1 == $dch1) && ($ch2 == $dch2) && ($ch3 == $dch3) && ($ch4 == $dch4) && ($ch5 == $dch5) && ($ch6 == $dch6))
	{
 	$tans[$j] = "DRAG";
	  $query = "UPDATE temp SET 
               answer = 'DRAG'
            WHERE scoreid = '$scoreid' and questionid = '$qid[$j]'";
  	$result = mysqli_query($db_connect,$query);
	}
 }

if($tans[$j] != '')
 $attemped++;
 if ($qans[$j] == $tans[$j])
 {
   $correct++;
  $query = "UPDATE temp SET 
               marks = 1
            WHERE scoreid = '$scoreid' and questionid = '$qid[$j]'";
  $result = mysqli_query($db_connect,$query);
 }
}
if ($max)
 $percentage = round(($correct / $max) * 100);
$width = round(($percentage * 340) / 100);

 $query = "UPDATE scores SET 
               marks = '$correct',
	       timetaken = '$time',
	       maxMarks = '$max'
            WHERE scoreid = '$scoreid'";
  $result = mysqli_query($db_connect,$query);

$query = mysqli_query($db_connect,"SELECT title, passingScore FROM exam WHERE examid='$examid'");
 $tit = mysqli_fetch_row($query);
 $title = stripslashes($tit[0]);
 $passingScore = $tit[1];

$width1 = round(($passingScore * 340) / 100);

print <<< ENDRESULT

    <table border="0" bgcolor="#e8e8e8" width="100%" cellspacing="4">
     <caption><font face="Arial"><H3> $title </H3></font></caption>
      <tbody>
          <tr>
            <td><font face="Arial"><small>
Total Questions: <b> $i</b>
</small></font></td>
            <td><font face="Arial"><small>
Questions Attempted: <b> $attemped </b>
</small></font></td>
            <td><font face="Arial"><small>
Time Taken: <b> $time </b>
</small></font></td>
          </tr>
          <tr>
            <td colspan="3">
            <p align="center">
            <table width="480" border="0">
              <tbody>
                <tr>
                  <td bgcolor="#ffffff">
         <table width="100%" border="0" cellpadding="1" cellspacing="1">
                    <tbody>
                      <tr>
                        <th width="100%" colspan="2"><b>
<font face="Arial, Tahoma, Verdana" color="#000000" size="2">
<b>Your Score</b></font></b></th>
                      </tr>
                      <tr>
                        <td valign="middle" align="left">
<font face="Arial, Tahoma, Verdana" color="#000000" size="2">
Passing Score- $passingScore%</font></td>
                        <td valign="middle" align="left">
   <table border="0" cellpadding="1" cellspacing="0">
    <tbody><tr height="15"><td width="$width1" bgcolor="#cc9900"></td>
    </tr></tbody></table>
                        </td>
                      </tr>
                      <tr>
     <td valign="middle" align="left">
    <font face="Arial, Tahoma, Verdana" color="#000000" size="2">
 Your Score- $percentage%</font></td>
     <td valign="middle" align="left">
      <table border="0" cellpadding="1" cellspacing="0">
      <tbody> <tr height="15">
       <td width="$width" bgcolor="#009900"></td>
      </tr></tbody></table>
           </td>
                      </tr>
                    </tbody>
                  </table>
                  </td>
                </tr>
              </tbody>
            </table>
            </p>
            </td>
          </tr>
          <tr>
            <td colspan="3">
            <p align="center"><font size="2" face="Arial">
Answers Correct: <b> $correct</b>
</font></p>
ENDRESULT;
?>
            </td>
          </tr>
        </tbody>
      </table>
      </center>
      </div>
<br>
<div align="center">
  <center>


<?php
$action = $_GET['action'];

if ($action == "summ")
{
 print <<< THIS
 <table border="0" cellpadding="0" cellspacing="0" width="80%"  bgcolor="#E8E8E8">
    <tr>
     <td width="40%">
       <p align="center"><font face="Arial" size="1">Question # </font></td>
     <td width="30%">
        <p align="center"><font face="Arial" size="1">Correct</font></td>
     <td width="30%">
        <p align="center"><font face="Arial" size="1">Attempted</font></td>
   </tr>
   <tr>
      <td width="100%" colspan="3" bgcolor="#E8E8E8">
<table border="0" cellspacing="1" width="100%" cellpadding="0">

THIS;

$q6 = mysqli_query($db_connect,"SELECT questionid, marks, answer FROM temp WHERE scoreid='$scoreid' order by questionid ");
$k = 0;

while ($row = mysqli_fetch_row($q6))
{
 $k++;
print <<< ENDR
<tr>
<td width="40%" bgcolor="#FFFFFF" align="center">
<font face="Arial" size="2" color="BLUE">
 $k </font>
</td>
<td width="30%" bgcolor="#FFFFFF" align="center">
<p align="center"><font face="Arial" size="2">
ENDR;

if ($row[1] == 1)
 print ("Yes");
else 
 print ("No");
 
print <<< ENDS
</font>
</td>
<td width="30%" bgcolor="#FFFFFF" align="center">
<p align="center"><font face="Arial" size="2">
ENDS;

if ($row[2] != '')
 print ("Yes");
else 
 print ("No");

print <<< ENDT
</font>
</td>
</tr>
ENDT;
}
print ("</table>");
} // End of IF action = summ

else
{

?>


<table border="0" cellpadding="0" cellspacing="0" width="80%" bgcolor="#E8E8E8">
    <tr>
      <td width="35%">
        <p align="center"><font face="Arial" size="1">Category</font></td>
      <td width="20%">
        <p align="center"><font face="Arial" size="1">Questions</font></td>
      <td width="20%">
        <p align="center"><font face="Arial" size="1">Correct</font></td>
      <td width="25%">
        <p align="center"><font face="Arial" size="1">% score</font></td>
 </tr>
 <tr>
      <td width="100%" colspan="4" bgcolor="#E8E8E8">
<table border="0" cellspacing="1" width="100%" cellpadding="0">


<?php

$query = mysqli_query($db_connect,"SELECT DISTINCT category FROM question WHERE examid='$examid' ");
while ($row = mysqli_fetch_row($query))
{
 $cquestion = 0;
 $ccorrect = 0;

 for($j = 0; $j < $max ; $j++)
 {
   if($row[0] ==  $category[$j])
   {
     if($qans[$j] != '')
       $cquestion++;  
     if ($qans[$j] == $tans[$j])
       $ccorrect++;  
   }
 }
$per = 0;
if($cquestion != 0)
 $per = round(($ccorrect / $cquestion) * 100);

print <<< ENDR
<tr>
<td width="35%" bgcolor="#FFFFFF" align="center">
<font face="Arial" color="BLUE" size="2">
 $row[0]</font>
</td>
<td width="20%" bgcolor="#FFFFFF" align="center">
<p align="center"><font face="Arial" size="2"> $cquestion </font>
</td>
<td width="20%" bgcolor="#FFFFFF" align="center">
<p align="center"><font face="Arial" size="2"> $ccorrect </font>
</td>
<td width="25%" bgcolor="#FFFFFF" align="center">
<p align="center"><font face="Arial" size="2"> $per </font>
</td>
</tr>
ENDR;
}
?>


</table>
<?php
} // END of else of action = summ
?>
</td>
    </tr>
  </table>
  </center>
</div>
      <br>
      <div align="center">
      <center>
<table>
<tr><td>
<form method="post" action="save.php" name="form1"> 
<input type="hidden" value="<?php print ("$scoreid") ?>" name="scoreid">
<input type="submit" value="Save Test" name="saveTest">
</form></td><td>
<form method="post" action="save.php" name="form1"> 
<input type="hidden" value="<?php print ("$scoreid") ?>" name="scoreid">
<input type="hidden" value="exit" name="action">
 <input type="submit" value="Dont Save" name="QuitTest">
</form>
</td></tr></table>
      <form method="post" action="review.php" name="form"> 
<input type="hidden" value="<?php print ("$scoreid") ?>" name="scoreid">
<input type="button" value="Review Test" name="Review Test" onclick="reviewTest(this.from)">

<?php
if ($action != "summ")
 print("<input type=\"button\" value=\"View Summary\" name=\"Review Test\" onClick=\"result(this.from)\">");
else 
 print("<input type=\"button\" value=\"View By Category\" name=\"Review Test\" onClick=\"resultCat(this.from)\">");

?>


 </form>
      </center>
      </div>
      <div align="center">
      <center>
      </center>
      </div>
      <br>
     </td>
    </tr>
  </tbody>
</table>
<script language="javascript">
function result(form)
{
	location="result.php?examid=<?php print("$examid&scoreid=$scoreid&time=$time&action=summ") ?>";
}

function resultCat(form)
{
	location="result.php?examid=<?php print("$examid&scoreid=$scoreid&time=$time") ?>";
}

 </script>
</body>
</html>
