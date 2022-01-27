<?php
include('cookie.php');
include('config.inc');
?><?php
if ($examidnnnn = $_GET['examid']);
else
    $examidnnnn = $_POST['examid'];

$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

$result         = mysqli_query($db_connect, "SELECT examtitlequestionpage FROM exam WHERE examid = '$examidnnnn'");
$row            = mysqli_fetch_row($result);
$exam_headtitle = $row[0];


//$examid = $_GET['examid'];
//$action = $_GET['action'];
//$scoreid = $_GET['scoreid'];
if ($examid = $_GET['examid']);
else
    $examid = $_POST['examid'];

if ($action = $_GET['action']);
else
    $action = $_POST['action'];

$scoreid = $_GET['scoreid'];

?>
<html>

<head>
<title><?php
echo "$exam_headtitle";
?></title>
<script language="JavaScript" type="text/javascript">
<!-- Begin

function MM_openBrWindow(theURL,winName,feature) { //v2.0
  newWindow = window.open(theURL,winName,feature);
  newWindow.focus();
}

function fun()
{
 document.form.rd.value=1;
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
<script language="javascript" type="text/javascript">    

PopUpURL    = "The right click options are disabled for this window";

isIE=document.all;
isNN=!document.all&&document.getElementById;
isN4=document.layers;

if (isIE||isNN)
{
 document.oncontextmenu=checkV;
}
else
{
 document.captureEvents(Event.MOUSEDOWN || Event.MOUSEUP);
 document.onmousedown=checkV;
} 

function checkV(e)
{
    if (isN4)
     {
    if (e.which==2||e.which==3)
        {
        dPUW=alert(PopUpURL);
        return false;
        }
    }
    else
    {
    dPUW=alert(PopUpURL);
    return false;
    }
}



 function goResult()
 {
   window.close()
 }
    var questionNo
    var intQuesNo
    
    function goToQuestion(form,ch)
    {
        if (ch == 'GO')
        {
    questionNo = prompt("Please enter question number:","")
        }
        else if (ch == 'No')
        {
      questionNo = document.questionform.ListofMarkedQuestion.value;
        }
    else if (ch == 'QNo')
        {
         questionNo =      document.questionform.ListOfUnattemptedquestion.value;      
        }
           if ((questionNo !=null) && (questionNo !=""))
        {
                   if (isNumberString(questionNo))
            {
                intQuesNo=parseInt(questionNo)
                if ((intQuesNo>=1) && (intQuesNo<=(document.questionform.max.value)))
                {
                      location.href="QuestionScreen.php?scoreid="+document.questionform.scoreid.value+"&Page="+questionNo+"&examid="+document.questionform.examid.value+"&questionid="+document.questionform.questionid.value+"&action="+document.questionform.action.value
                }
                else
                {
var h = document.questionform.max.value 
        alert("Question number should between 1 and " + h + ".")
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
<title>Question Screen</title>
<link rel="stylesheet" type="text/css" href="Master.css">
<meta name="Microsoft Border" content="none">
</head>

<body bgcolor="#ffffff" text="#000000" link="#000000" vlink="#000080" alink="#000000" onload='self.focus()'>

<form name="questionform" method="POST" action="QuestionScreen.php">


<?php


if ($submit = $_POST['submit']) {
    //print("in post submit <br>");
} else {
    if ($submit = $_GET['submit']) {
        //print("in get submit<br>"); 
        $ans  = $_GET['ans'];
        $area = $_GET['area'];
    }
}

$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

//$examid = $_GET['examid'];
//$action = $_GET['action'];
if ($examid = $_GET['examid']);
else
    $examid = $_POST['examid'];

if ($action = $_GET['action']);
else
    $action = $_POST['action'];

$scoreid = $_GET['scoreid'];

if ($submit) {
    
    //print("after submit is found");
    
    
    // for mcs & tf & sa
    if ($rd = $_POST['rd'])
        $answer = addslashes(trim($rd));
    
    
    // for mcm
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    $d = $_POST['d'];
    $e = $_POST['e'];
    $f = $_POST['f'];
    
    if ($a || $b || $c || $d || $e || $f)
        $answer = $a . $b . $c . $d . $e . $f;
    
    //print(" Previous Answer is $answer<br>");
    
    if ($scoreid = $_GET['scoreid']);
    else
        $scoreid = $_POST['scoreid'];
    
    if ($questionid = $_POST['questionid']);
    else
        $questionid = $_GET['questionid'];
    
    $chkMarkQuestion = $_POST['chkMarkQuestion'];
    
    $q2 = "UPDATE temp SET 
           answer = '$answer',
           markQuestion = '$chkMarkQuestion'
            WHERE scoreid = '$scoreid' and questionid = '$questionid'";
    
    
    //print("$q2<br>");
    //print("$chkMarkQuestion<br>");
    $r2 = mysqli_query($db_connect, $q2);
    
}

if ($evt = $_POST['Page']);
else
    $evt = $_GET['Page'];

//print("$evt<br>");

if (!$evt) {
    $evt = 1;
}

if ($submit == "Previous")
    $evt = $evt - 1;
else if ($submit == "Next")
    $evt = $evt + 1;
else if ($submit == "End Test") {
    if ($max = $_POST['max']);
    else
        $max = $_GET['max'];
    
    $query = mysqli_query($db_connect, "SELECT temp.answer,question.question FROM temp,question WHERE temp.scoreid='$scoreid' and temp.questionid = question.questionid order by sno");
    
    print <<< ENDTEST
 <div align="center"><center><table CellSpacing="20">
  <tr><td align="center"><b><u>$exam_headtitle</u></b></td></tr>
    <tr>
      <td>
    <font face="Arial"><u>List of Unattempted Questions</u></font>
    <small>(Click on the Question to go to the Question)</small>
     </td>
    </tr>
    <tr>
      <td><font face="Arial"><select name="ListOfUnattemptedquestion" size="6" onChange="goToQuestion(document.questionform,'QNo')">
ENDTEST;
    
    $i = 0;
    while ($row = mysqli_fetch_row($query)) {
        $i++;
        $ques[i] = substr($row[1], 0, 50);
        $row[0]  = stripslashes(trim($row[0]));
        if ((!$row[0]) || ($row[0] == NULL))
            print("<option value=$i>$i - " . substr($row[1], 0, 50) . "...</option>");
    }
    if ($max)
        for (++$i; $i <= $max; $i++) {
            $ques[$i] = stripslashes(trim($ques[$i]));
            print("<option value=$i>$i - " . substr($ques[$i], 0, 50) . "...</option>");
        }
    
    print <<< ENDTEST
      </select> </font>
     </td>
</tr>
<tr>
<td>
 <font face="Arial"><u>List of Marked Questions</u></font>
 <small>(Click on the Question to go to the Question)</small>
</td>
</tr>
<tr>
     <td><font face="Arial"><select name="ListofMarkedQuestion" size="6" onchange="goToQuestion(document.questionform,'No')">

ENDTEST;
    
    $query = mysqli_query($db_connect, "SELECT question, markQuestion FROM temp, question WHERE temp.scoreid='$scoreid' and temp.questionid = question.questionid order by sno");
    $i     = 0;
    while ($row = mysqli_fetch_row($query)) {
        $i++;
        if ($row[1] == 'ON') {
            $row[0] = stripslashes(trim($row[0]));
            print("<option value=$i>$i - " . substr($row[0], 0, 50) . "...</option>");
        }
    }
    
    print <<< ENDTEST
     </select> </font>
      </td>
    </tr>
   </table> </center></div>
  <div align="center"><center><p><font face="Arial">
   <input type="button" value="Back To Test" name="backToTest" onClick="backtoTest(this.from)">
   <input type="button" value="Goto Question" name="gotoQuestion" onClick="goToQuestion(this.form,'GO')">
   <input type="button" value="End Test" name="EndTest" onClick="gotoResult(this.form)">
    </font></p></center></div>

<script Language="javascript">    

 function gotoResult(form)
 {
   //parent.frames[0].document.user.userid.value"
   var time=parent.ExamScreenTop.document.clock.countUp.value;
   parent.opener.location = "result.php?examid=$examid&scoreid=$scoreid&time="+time;
    parent.close();
  }

  function backtoTest(form)
  {
    location.href="QuestionScreen.php?scoreid=$scoreid&examid=$examid&action=$action";
  }

</script>

ENDTEST;
    
    print("<input type=\"hidden\" name=\"Page\" value=\"$evt\"> ");
    print("<input type=\"hidden\" name=\"examid\" value=\"$examid\"> ");
    print("<input type=\"hidden\" name=\"scoreid\" value=\"$scoreid\"> ");
    print("<input type=\"hidden\" name=\"questionid\" value=\"$questionid\"> ");
    print("<input type=\"hidden\" name=\"max\" value=\"$max\"> ");
    print("<input type=\"hidden\" name=\"action\" value=\"$action\"> ");
    
    exit;
    
} // end of sumbit=End Test

//print("ScoreID is $scoreid<br>");

$result = mysqli_query($db_connect, "SELECT * FROM temp WHERE scoreid='$scoreid' ORDER BY sno");
for ($j = 1; $res = mysqli_fetch_row($result); $j++) {
    $qid[$j] = $res[2];
    //print("$qid[$j]<br>");
}
$j = $j - 1;
// still some questions are left

if ($evt != ($j + 1)) {
    
    //print("still some questions are left<br>");
    ///print("no of questions :$evt<br>");
    
    
    
    //print("questionid is :$qid[$evt]<br>");
    
    
    $result = mysqli_query($db_connect, "SELECT * FROM question WHERE questionid='$qid[$evt]'");
    
    //print("$result<br>");
    
    while ($row = mysqli_fetch_row($result)) {
        $res = mysqli_query($db_connect, "SELECT * FROM temp WHERE scoreid='$scoreid' and questionid='$row[0]'");
        $sco = mysqli_fetch_row($res);
        
        $questionid = $row[0];
        $answer     = addslashes(trim($row[8]));
        //$feedback = addslashes(trim($row[10]));
        $feedback   = $row[10];
        
        // IF the Question has a Image 
        
        $result = mysqli_query($db_connect, "SELECT * FROM images WHERE questionid = '$questionid'");
        if ($img = mysqli_fetch_row($result)) {
            $imageid     = $img[0];
            $description = stripslashes($img[2]);
            $filename    = $img[3];
            $filesize    = $img[4];
            $width       = $img[5];
            $height      = $img[6];
            $filetype    = $img[7];
            //   $data = $img[8];
        }
        
        $markQuestion = $sco[4];
        if ($markQuestion == 'ON')
            $sel = 'checked';
        
        $row[1] = stripslashes($row[1]);
        
        if ($action == "learning") {
            
            $count = 0;
            if ($handle = opendir("imageshow")) {
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        $count++;
                    }
                }
                closedir($handle);
            }
            
            $rand = mt_rand(2, $count);
            
            $count = 0;
            if ($handle = opendir("imageshow")) {
                while (false !== ($filename = readdir($handle))) {
                    if ($filename != "." && $filename != "..") {
                        $count++;
                        if ($count == $rand) {
                            $IMG = "<a href=\"javascript:onclick=MM_openBrWindow('pic2.php?imageid=$rand', 'IMAGESHOW','width=420, height=475')\"><img src=\"imageshow/$filename\" width=\"75\" height=\"75\"><a>";
                        }
                    }
                }
                closedir($handle);
            }
        } // End of image display
        
        print <<< ENDQUESTION
<center>
    <table width="100%">
<tr><td colspan="3" align="center"><u><b>$exam_headtitle</b></u></td></tr>
<tr><td width="35%"><a href="https://online.certexams.com" target="_blank"><img src="https://online.certexams.com/images/home.gif" border="0"></a></td><td width="30%">
<div align="center"><p><font face="Arial"><small>
      <i>Question $evt of $j</i><br>
    <input type="checkbox" name="chkMarkQuestion" value="ON" $sel>Mark 
        Question  </small></font></p>
    </div>
</td><td width="35%"><div align="right">$IMG</div></td></tr>
</table>
<center>
    <hr>
    <div align="center"><center><table border="0" width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td valign="top" width="10%"><big><big><big>
      <font face="Arial"><strong>Q</strong></font></big></big></big>
      </td>
      <td width="90%"><font face="Arial">
   <pre>$row[1]</pre>
      </font><br><br></td>
   </tr>
ENDQUESTION;
        
        for ($col = 2, $a = 'a'; $col <= 7; $col++, $a++) {
            $check = "";
            if ($row[$col]) {
                print("<tr><td valign =top width=10%><font face=\"Arial\">");
                $dd = 0;
                if ($row[14] == 'dd') {
                    $dd = 1;
                    print("<BR></font></td><td width=90%><font face=\"Arial\"><a href=\"javascript: onclick=MM_openBrWindow('drag&drop.php?questionid=$row[0]&scoreid=$scoreid','DragAndDrop','scrollbars=yes,resizable=yes,width=600,height=400' );fun();\">Click For Drag And Drop</a></font><input type=\"hidden\" name=\"rd\" > </td></tr>");
                    //       print ("");
                    break;
                } else if ($row[14] == 'mcm') {
                    if (strchr($sco[3], $a))
                        $check = "checked";
                    $row[$col] = stripslashes($row[$col]);
                    print("<input name=\"$a\" type=\"checkbox\" $check value=$a >$a)</font></td><td width=90%><font face=\"Arial\"> <pre>$row[$col]</pre> <br><br></font></td> </tr>");
                } else if ($row[14] == 'mcs') {
                    if ($sco[3] == $a)
                        $check = "checked";
                    $row[$col] = stripslashes($row[$col]);
                    print("<input name=\"rd\" type=\"radio\" value = $a  $check >$a)</font></td><td width=90%><font face=\"Arial\"> <pre>$row[$col]</pre> <br><br></font></td> </tr>");
                }
            }
        }
        if ($row[14] == 'tf') {
            if ($sco[3] == "true")
                $checkT = "checked";
            
            print("<tr><td valign =top width=10%><font face=\"Arial\">");
            print("<input name=\"rd\" type=\"radio\" $checkT value =true></font></td><td width=90%><font face=\"Arial\"> <pre>True</pre> <br><br></font></td></tr>");
            
            if ($sco[3] == "false")
                $checkF = "checked";
            
            print("<tr><td valign =top width=10%><font face=\"Arial\">");
            print("<input name=\"rd\" type=\"radio\" $checkF value =false></font></td><td width=90%><font face=\"Arial\"> <pre>False</pre> <br><br></font></td></tr>");
        }
        if ($row[14] == 'sa') {
            $sco[3] = stripslashes($sco[3]);
            print("<tr><td valign =top width=10%><font face=\"Arial\">");
            print("Ans. </font></td><td width=90%><font face=\"Arial\"><textarea name=\"rd\" rows=\"2\" cols=\"60\">$sco[3]</textarea> <br><br></font></td> </tr>");
        }
        // if Image
        if ($imageid) {
            print("<tr>
      <td valign=\"top\" width=\"10%\"><font face=\"Arial\" color=\"BLUE\"> Image</font></td>
      <td width=\"90%\"><a href=\"javascript: onclick=MM_openBrWindow('picture.php?imageid=$imageid','Image','scrollbars=yes,resizable=yes,width=$width,height=$height' )\">$description</a><br><br></td>
</tr>");
        }
    } // End of while
} // End of IF

$evtP = $evt - 1;
$evtN = $evt + 1;

print("</table>\n</center>\n</div>\n<hr align=\"center\">\n
  <div align=\"center\"><center><p><font face=\"Arial\">");

print("<input type=\"hidden\" name=\"Page\" value=\"$evt\"> ");
print("<input type=\"hidden\" name=\"examid\" value=\"$examid\"> ");
print("<input type=\"hidden\" name=\"scoreid\" value=\"$scoreid\"> ");
print("<input type=\"hidden\" name=\"questionid\" value=\"$questionid\"> ");
print("<input type=\"hidden\" name=\"max\" value=\"$j\"> ");
print("<input type=\"hidden\" name=\"action\" value=\"$action\"> ");

if ($evt != 1) {
    // print (" <input type=\"hidden\" name=\"submit\" value=\"back\"> ");
    // print(" <a href=\"javascript:document.form.submit()\"><img src=\"back.jpg\" border=\"0\" alt=\"submit\"></a> ");
    print(" <input type=\"submit\" name=\"submit\" value=\"Previous\"> ");
    //print(" <button type=\"submit\" name=\"submit\" value=\"back\"><img src=\"back.jpg\" border=\"0\" alt=\"submit\"></button>");
}

if ($evt != $j) {
    // print ("<input type=\"hidden\" name=\"submit\" value=\"next\"> ");
    // print (" <a href=\"javascript:document.form.submit();\"><img src=\"next.jpg\" border=\"0\" alt=\"submit\" ></a> ");
    print("<input type=\"submit\" name=\"submit\" value=\"Next\"> ");
    //print(" <button type=\"submit\" name=\"submit\" value=\"next\"><img src=\"next.jpg\" border=\"0\" alt=\"submit\"></button>");
}
if (($action == "learning") && ($dd != 1)) {
    $nareshflag = 1;
    $feedback1  = str_replace("\n\r", "", $feedback);
    $feedback2  = str_replace("\n", "\\n", $feedback1);
    $feedback3  = str_replace("\r", "", $feedback2);
    $feedback4  = str_replace("\t", " ", $feedback3);
    $feedback7  = str_replace('"', "'", $feedback4);
    //yv$feedback5 = str_replace("\b","",$feedback4);
    //yv$feedback6 = str_replace("\v","",$feedback5);
    //yv$feedback7 = str_replace("\f","",$feedback6);
    
    print <<< LEARN

<input type="button" value="Show Answer" name="answer" onClick="enab()" >
<input type="submit" value="End Test" name="submit"> 
<div align="center"><center><table border="0" width="100%" cellspacing="0" cellpadding="0">
<tr>
<td>
<font face="Arial"><pre>Answer:</pre></font>
</td>
<td>
<input type="text" name="ans" value="">
</td>
</tr>
<td><font face="Arial"><pre>
Explanation:</pre></font>
</td>
<td></td>
<tr>
<td></td>
<td><span id='display'></span>
</td>

</tr>
</table>

<script language="JavaScript"><!--
var  a_variable = '$answer<br>';
var  b_variable = '$feedback6';
function replace(str,from,to) {
           var i = str.indexOf(from);
           if (!from || !str || i == -1) return str;
           var newstr = str.substring(0, i) + to;
           if (i+from.length < str.length)
           newstr += replace(str.substring(i+from.length,str.length),from,to);
           return newstr;
}
function seeAnswer() 
{
var windowReference = window.open('popup.htm','windowName','width=500,height=500');
if (!windowReference.opener)
  windowReference.opener = this.window;
}
function enab ()
{
frm=document.forms[0]
frm.ans.value="$answer";
//frm.area.value="$feedback7";
document.getElementById('display').innerHTML = "$feedback7";
}
//--></script>
LEARN;
}
if (!$nareshflag) {
    print <<< ENDQUESTION
<input type="submit" value="End Test" name="submit"> 
<br>
ENDQUESTION;
}
?> 
 <br>
<br>
<?php
$qid = $questionid + 1;
print <<<AAA
<a href="https://online.certexams.com/QuestionScreen.php?submit=next&Page=$evt&examid=$examid&scoreid=$scoreid&questionid=$qid&max=$max&action=$action&chkMarkQuestion=$sel&ans=$ans&area=$area"><img src="https://online.certexams.com/images/clearblank.gif" width="10" height="10" border="0"></a>
AAA;
?>
<!--<p align="right"><font color=BLACK>&copy; anandsoft.com</font></p> -->
</form>
</body>
</html>
