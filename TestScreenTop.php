<?php
 include('config.inc');
 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

 $examid = $_GET['scoreid'];
 $examid = $_GET['examid'];
 $action = $_GET['action'];

$testType = 0 ;
$strTestType = 0 ;
$time = 6000;

if (!$action)
{ 
  $query = mysqli_query($db_connect,"SELECT time FROM exam WHERE examid = '$examid'");
  $row = mysqli_fetch_row($query);
  $time = $row[0];
  $testType = 1;
  $strTestType= 1;
}

 
?>

<html>
<script language="javascript">
var upSec=0;
var upMin=0;
var upHour=0;
var downSec=0;
var isTrialUser=1;
var avaMins;
if (isTrialUser==1) 
	avaMins=<?php print("$time") ?>;
else
	avaMins=20;

var testType = <?php print("$testType") ?> ;
var strTestType = <?php print("$strTestType") ?>;

var limitMins = <?php print("$time") ?>;
var boughtMins=  600;
var strBoughtMins= "600";
var	downHour=Math.floor(avaMins/60);
var	downMin=(avaMins % 60);
var now=new Date();
var startSec=now.getSeconds();
var startMin=now.getMinutes();
var startHour=now.getHours();

function go()
{
	if ((isBlank(strTestType)) || (isBlank(strBoughtMins)))
	{
		alert("The current Session established with Online-test timed out. Please close your browser and log back in again.");
		parent.close();
		parent.opener.location="";
	}
	else
	{
		checkTime(upHour,upMin);

		upSec++;
		if(upSec>=60)
		{
			upSec=0;
			upMin++;
		}
		if(upMin>=60)
		{
			upMin=0;
			upHour++;
		}
	
		startSec++;
		if(startSec>=60)
		{
			startSec=0;
			startMin++;
		}
		if(startMin>=60)
		{
			startMin=0;
			startHour++;
		}

		if (testType==1)
		{
			downSec--;
			if(downSec<=-1)
			{
				downSec=59;
				downMin--;
			}
			if(downMin<=-1)
			{
				downMin=59;
				downHour--;
			}
		}
		upTime=(upHour>=10 ? upHour : "0" +upHour)+":";
		upTime+=(upMin>=10 ? upMin : "0" + upMin)+":";
		upTime+=(upSec>=10 ? upSec : "0" + upSec);
		//startTime=(startHour>=10 ? startHour: "0"+startHour)+":";
		//startTime+=(startMin>=10 ? startMin: "0"+startMin)+":";
		//startTime+=(startSec>=10 ? startSec:"0"+ startSec);
		document.clock.countUp.value=upTime;
		//document.clock.currentTime.value=startTime;
		if (testType==1)
		{
			downTime=(downHour>=10 ? downHour: "0"+downHour)+":";
			downTime+=(downMin>=10 ? downMin: "0"+downMin)+":";
			downTime+=(downSec>=10 ? downSec: "0"+downSec);
			document.clock.countDown.value=downTime;
		}
		setTimeout("go()",1000);
	}
}

function checkTime(usedHour, usedMin)
{
	var usedMins=usedHour*60 + usedMin;
	if (testType==1)
	{
		if (boughtMins<=limitMins)
		{
			if (usedMins>=boughtMins)
			{
				alert("You will now need to buy time to continue to use Online-test.");
				parent.close();
				parent.opener.location="";

			}
		}
		else
		{
			if (usedMins>=limitMins)
			{
				alert("Your have run out of time. The test will now end.");
                                var time=document.clock.countUp.value;
                                parent.opener.location = "result.php?examid=<?php print("$examid&scoreid=$scoreid&time=") ?>"+time;
				parent.close();
				parent.opener.location="result.php";
			}
		}
	}
	else
	{
		if (usedMins>=boughtMins)
		{
			alert("You will now need to buy time to continue to use Online-test.");
			parent.close();
			parent.opener.location="";
		}
	}	
}


function isBlank (InString) 
{
	if (InString==null) return (!false)
	if (InString.length!=0)
		return (!true);
	else
		return (!false);
}



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

</script>


<head>
<title>Exam Top Screen</title>
<base target="_self">
</head>
<body onload="go();self.focus();"  bgcolor="BLUE" text="#FFFFFF">


<form name="clock">

  <table valign="top" border="0" cellpadding="2" width="100%" cellspacing="0" bordercolor="#CC9900">

    <tr>
    
	<td align="center" valign="bottom" bgcolor="BLUE"><font face="Arial"><small><B>Test Time:</B></small>
	<input type="text" name="countUp" value="00:00:00" size="9">&nbsp;&nbsp;&nbsp;

<?php 
if ($action == "")
{
print <<< TIME
 <small><b>Time
	Available:</b> </small><input type="text" name="countDown" size="9">
TIME;
}
?>
			
</font></td>
    </tr>
<!--	<tr>      <td valign=top width="15%" ><small><small>Current Time </small></small></td>      <td valign=top width="15%"><small><input type="text" name="currentTime" size="9"></small></td>    </tr>	-->
  </table>
</form>
</body>
</html>
