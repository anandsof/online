<?php
 include('cookie.php');
 include('logged.php');
?>
<?php
include('config.inc');

 $examid = $_GET['examid'];
 $cid = $_GET['cid'];

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

  $result =  mysqli_query($db_connect,"SELECT * FROM exam WHERE examid = '$examid'");
  $row = mysqli_fetch_row($result);
  $title = $row[1];
  $questions = $row[6];
  $time = $row[9];
?>


<html>
<head>
  <title>certExam</title>
      <script language="JavaScript">
var numOfQuestions=89;
isTrialUser =1;
var isFastAssessmentUser=0;
var avaMins=600;

function MM_openBrWindow(theURL,winName,feature) { //v2.0
  newWindow = window.open(theURL,winName,feature);
  newWindow.focus();
}

function isNumberString (InString)  
{
	if(InString.length==0) 
		return (false);
	RefString="1234567890";

	var len;
	if (InString.length) 
		len=InString.length 
	else 
		len=1;
	
	for (Count=0; Count < len; Count++)  
	{
		TempChar= InString.substring (Count, Count+1);
		if (RefString.indexOf (TempChar, 0)==-1)  
			return (false);
	}
	return (true);
}

function startTest(frmChosenForm)
{	
	if (isTrialUser==1)
	{
		numOfQuestions = <?php print("$questions") ?>;
		avaMins = 600;
	}
	else if (isTrialUser==2) 
	{
		numOfQuestions = <?php print("$questions") ?>;
		avaMins = 600; 
	}
	 
	if (avaMins==0)
	{ 
		alert("Your time is used up. You will now have to buy time to continue using brains.com");
		parent.parent.location="";
	}
	else
	{
		if (isNumberString(frmChosenForm.txtStartQuestion.value) && isNumberString(frmChosenForm.txtEndQuestion.value))
		{
			if (parseInt(frmChosenForm.txtEndQuestion.value) > numOfQuestions)
			{
				alert("The total number of available questions is "+ numOfQuestions + ".");
				frmChosenForm.txtEndQuestion.focus();
			} 
			else 
			{
				if (parseInt(frmChosenForm.txtStartQuestion.value) < 1)
				{
					alert("The starting question number cannot be less than 1.");
					frmChosenForm.txtStartQuestion.focus();
				}
				else
				{
					if (parseInt(frmChosenForm.txtStartQuestion.value) > parseInt(frmChosenForm.txtEndQuestion.value))
					{
						alert("The starting question number cannot not greater than the ending number.");
						frmChosenForm.txtStartQuestion.focus();
					}
					else
					{
    var st=parseInt(frmChosenForm.txtStartQuestion.value);
    var ed=parseInt(frmChosenForm.txtEndQuestion.value);
    var randQ=frmChosenForm.randQ.checked;
    var candidateid = <?php print("$cid"); ?>;
          
    if(candidateid==2)
       { 
        MM_openBrWindow("temp.php?examid=<?php print("$examid&cid=$cid&action=learning&start=") ?>"+st+"&end="+ed+"&randQ="+randQ+"" ,'exam','width=800,height=630,toolbar=1,resizable=1,location=1,menubar=1');
       }
       else
       { 
         MM_openBrWindow("temp.php?examid=<?php print("$examid&cid=$cid&action=learning&start=") ?>"+st+"&end="+ed+"&randQ="+randQ+"" ,'exam','width=800,height=630');
       }  
					}
				}
			}
		}
		else
		{
			alert("The starting and ending question numbers must be numeric.");		
		}
	}
}
      </script>

<link REL=StyleSheet HREF="myStyle.css" TYPE="text/css">
 <style>
<!--
a { font-family: Arial; font-size: 10pt; color: #800000; text-decoration: 
               underline }
-->
  </style>
</head>
<body marginwidth="0" marginheight="0">
<center><h3><u><?php echo $title ?></u></h3></center>
<table border="0" cellpadding="10" cellspacing="0" width="100%"
 bgcolor="#ffffff">
  <tbody>
    <tr>
      <td width="100%" valign="top" align="left"> 	
      <p><b>Choose one of the following testing options:</b></p>
      <small> </small><small> </small><small> </small><small> </small>
      <table border="0" cellpadding="0" cellspacing="0" width="504">
        <tbody>
          <tr>
            <td valign="top" align="left"><b><font size="3">1</font></b></td>
            <td valign="top" align="left"><br>
            </td>
            <td valign="top" align="left">
            <form name="frmRandom" method="post" action=""> 
            <font face="Arial" size="2">
	<input type="hidden" name="txtStartQuestion" value="1"> 	  	<input type="hidden" name="intTestType" value="1"> 		<input type="hidden" name="txtEndQuestion" size="4" value="15">

<?php 

 

if($cid == 2)
{
print <<< LINK11

<a href="https://online.certexams.com/temp.php?examid=$examid&cid=$cid&randQ=true" target="_blank">

LINK11;
}
else
{
print <<< LINK


<!--
 <a href="javascript:onclick=MM_openBrWindow('temp.php?examid=$examid&cid=$cid&randQ=true','exam','width=800,height=630')"> 
-->

<a href="https://online.certexams.com/temp.php?examid=$examid&cid=$cid&randQ=true" onclick="MM_openBrWindow('temp.php?examid=$examid&cid=$cid&randQ=true','exam','width=800,height=630'); return false;" target="_blank"> 

LINK;
}
print <<< CHOICE

<b>Exam mode</b></a><br>
You will be presented <b>$questions</b> questions (in random order).<br>
There is a time limit of&nbsp;<b>$time</b>&nbsp;minutes for this exam.</font>
<br><font face="Arial"><font size="2">Use this mode       
to simulate the real exam environment. You will not be able to view
answers to         questions as you proceed through the exam (as in the
real exam). A review is available at the         end of the exam.</font>
</font> <font face="Arial">		 </font> </form>

CHOICE;
?>

            </td>
          </tr>
          <tr>
            <td valign="top" align="left" colspan="3"><br>
            </td>
          </tr>
	  <tr>
            <td valign="top" align="left" colspan="3"><br>
            </td>
          </tr>
          <tr>
            <td valign="top" align="left"><b><font size="3">2</font></b></td>
            <td valign="top" align="left"><br>
            </td>
            <td valign="top" align="left">
      <form name="frmCustom" method="post" action="">
      <input type="hidden" name="intTestType" value="0">
      <font face="Arial" size="2">
    <a href="https://online.certexams.com/temp.php?examid=<?php print("$examid&cid=$cid&action=learning&start=")?>st&end=ed&randQ=randQ" onclick="JavaScript:startTest(document.frmCustom); return false;" target=_blank>
 <b>Customized Exam Mode</b></a> 		<br>
Questions </font><font face="Arial" size="2">	
    <input type="text" name="txtStartQuestion" size="4" value="1"> through <input type="text" name="txtEndQuestion" size="4" value="<?php print("$questions") ?>">&nbsp;</font>
<font face="Arial" size="2">will be presented to you.&nbsp;<br>
<input type="checkbox" name="randQ"> Check the box for random Questions. <br>
There is no time limit on this exam.<br> You can change the starting and ending question numbers in the boxes above.</font>
<br><font face="Arial"><font face="Arial" size="2">Use
this mode to view questions in a particular range from our
question bank. You can view answers to questions as you proceed
through the exam. A review is available at the end of the exam.</font></font>
		</form>
            </td>
          </tr>
        </tbody>
      </table>
      </td>
    </tr>
  </tbody>
</table>
</body>
</html>
