<?php
 include('cookie.php');
?>
<html>
<head>
	<title>brains@work</title>
	<link REL=StyleSheet HREF="style.css" TYPE="text/css">

	<script language="JavaScript">	
	function init()
	{
		define('startDate','string','Start Date');
		define('endDate','string','End Date');
		define('time','num','Time Limit',1);
		define('passingScore','num','Passing Score',1);
		define('questions','num','Number of Questions',1);
	}
	</script>
	<script language="javascript">
function validate()
{
 var start = new Date(document.form.startDateselect2.value,document.form.startDateselect1.value-1,document.form.startDateselect0.value);
 var end = new Date(document.form.endDateselect2.value,document.form.endDateselect1.value-1,document.form.endDateselect0.value);
 var diff = end - start;
//alert (diff);
if (diff < 0)
{
 alert ('Start Date should be previous of End Date');
 return false;
}
else 
 return true;
}

function populatedate(dateselect,max, selecteddate){
selecteddate--;
for (m=dateselect.options.length-1;m>0;m--)
	dateselect.options[m]=null;
for (i=0;i<max;i++)
	dateselect.options[i]=new Option(i+1,i+1);
if (selecteddate<max) dateselect.options[selecteddate].selected=true;
else dateselect.options[0].selected=true;
}

function evalleapyear(year){
//	alert(year);
	if ((year % 400)==0) {return true;}
	else if ((year % 100)==0) {return false;}
	else if ((year % 4)==0) {return true;}
	return false;
}

function fulleval(dselect,mselect,yselect,output)
{
	if (mselect.options[mselect.selectedIndex].value ==  1) {populatedate(dselect,31,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value ==  2) {
		if (evalleapyear(yselect.options[yselect.selectedIndex].value)){
		populatedate(dselect,29,dselect.options[dselect.selectedIndex].value);
		}
		else populatedate(dselect,28,dselect.options[dselect.selectedIndex].value);
	}
	if (mselect.options[mselect.selectedIndex].value ==  3) {populatedate(dselect,31,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value ==  4) {populatedate(dselect,30,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value ==  5) {populatedate(dselect,31,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value ==  6) {populatedate(dselect,30,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value ==  7) {populatedate(dselect,31,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value ==  8) {populatedate(dselect,31,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value ==  9) {populatedate(dselect,30,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value == 10) {populatedate(dselect,31,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value == 11) {populatedate(dselect,30,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value == 12) {populatedate(dselect,31,dselect.options[dselect.selectedIndex].value)}
	output.value = yselect.options[yselect.selectedIndex].value+ "-" + mselect.options[mselect.selectedIndex].value + "-" + dselect.options[dselect.selectedIndex].value;
//	alert(output.value);
}

function nulleval(dselect,mselect,yselect,output)
{
	output.value = yselect.options[yselect.selectedIndex].value + "-" + mselect.options[mselect.selectedIndex].value + "-" + dselect.options[dselect.selectedIndex].value ;
//	alert(output.value);
}

</script>
</head>

<body  onLoad="init();">
<center><h3>Exam Settings</h3></center>
<HR>
<form name="form" action="edit1.php" method="post" onSubmit="return validate();">

<?php

 include('config.inc');
 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);
 
 $month = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep', 'Oct','Nov','Dec');

  $examid = $_GET['examid'];
  $ID = $_GET['ID'];

  $action = $_POST['action'];
  if ($action == "update")
  {
   $ID = $_POST['ID'];
   $examid = $_POST['examid'];
   $startDate = $_POST['startDate'];
   $endDate = $_POST['endDate'];
   $time = $_POST['time'];
   $passingScore = $_POST['passingScore'];
   $questions = $_POST['questions'];
   $active = $_POST['active'];
   $groupid = $_POST['groupName'];

   if ($active == 'on')
     $active = 'Yes';
   else 
     $active = 'No';

   $result =  "update exam set 
		startDate = '$startDate',
		endDate = '$endDate',
		time = '$time',
		passingScore = '$passingScore',
		questions = '$questions',
		active = '$active',
		groupid = '$groupid'
	       where examid = '$examid'";

   $query = mysqli_query($db_connect,$result);

  print ("<center><BR>Exam Setting Updated<BR></center>");
  print ("<center><a href=\"viewTest.php?ID=$ID\">Continue...</a></center><br>");
  exit;

  }

  $result = ("select COUNT(*) from exam,question where exam.examid=question.examid and exam.examid = '$examid' and question.used=1");
  $query = mysqli_query($db_connect,$result);
  $row = mysqli_fetch_row($query);
  $max = $row[0];

  $result =  ("select * from exam where examid='$examid'");
  $query = mysqli_query($db_connect,$result);
  $row = mysqli_fetch_row($query);

  if ($row[11] == 'Yes')
    $ch = 'checked';
  $matchStart = explode("-",$row[7]);
  $matchEnd = explode("-",$row[8]);

print <<< EDIT
<table>
<tr>
       <td align='right' bgcolor='#dfdfdf'>Exam Title: </td>
       <td>$row[1]</td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>Exam ID: </td>
       <td>$row[2]</td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>Exam version: </td>
       <td>$row[3]</td>
</tr>

<tr>
       <td align='right' bgcolor='#dfdfdf'>Exam Group: </td>
       <td>
 <select name='groupName'> 
EDIT;

// check wheather admin or not
   $result =  ("select admin from candidate where candidateID = '$ID'");
   $query = mysqli_query($db_connect,$result);
   $grow = mysqli_fetch_row($query);
   $admin = $grow[0];

  if($admin == 1)
     $result = ("select * from groups");
  else
     $result =  ("select groups.groupid, groupName from groups,groupPermissions where groups.groupid = groupPermissions.groupid and candidateID = '$ID'");
  $query = mysqli_query($db_connect,$result);
  while ( $grow = mysqli_fetch_row($query))
  {
   $sch = "";
   if($grow[0] == $row[12])
    $sch = "selected";
   print ("\n<option $sch value=$grow[0]>$grow[1]");
  }
 
print <<< EDIT
</select>
</td>
</tr>

<tr>
       <td align='right' bgcolor='#dfdfdf'>Start Date: </td>
       <td>
<input type='hidden' name='startDate' value="$row[7]">
<select name='startDateselect0' onchange='nulleval(startDateselect0,startDateselect1,startDateselect2,startDate)'>
EDIT;
for ($i = 1 ; $i <= 31 ; $i++)
{
  $select = "";
 if ($i == $matchStart[2])
   $select = 'selected';
  print ("<option $select value=$i>$i</option>\n");
}
print ("</select>\n");
print <<< EDIT
<select name='startDateselect1' onchange='fulleval(startDateselect0,startDateselect1,startDateselect2,startDate)'>
EDIT;
for ($i = 1 ; $i <= 12 ; $i++)
{
  $select = "";
 if ($i == $matchStart[1])
   $select = 'selected';
  $j = $i - 1;
  print ("<option $select value=$i>$month[$j]</option>\n");
}
print ("</select>\n");
print <<< EDIT
<select name='startDateselect2' onchange='fulleval(startDateselect0,startDateselect1,startDateselect2,startDate)'>
EDIT;
for ($i = 2000 ; $i <= 2030 ; $i++)
{
  $select = "";
 if ($i == $matchStart[0])
   $select = 'selected';
  print ("<option $select value=$i>$i</option>\n");
}
print ("</select>\n");
print <<< EDIT
</td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>End Date: </td>
       <td><input type='hidden' name='endDate' value="$row[8]">
<select name='endDateselect0' onchange='nulleval(endDateselect0,endDateselect1,endDateselect2,endDate)'>
EDIT;
for ($i = 1 ; $i <= 31 ; $i++)
{
  $select = "";
 if ($i == $matchEnd[2])
   $select = 'selected';
  print ("<option $select value=$i>$i</option>\n");
}
print ("</select>\n");
print <<< EDIT
<select name='endDateselect1' onchange='fulleval(endDateselect0,endDateselect1,endDateselect2,endDate)'>
EDIT;
for ($i = 1 ; $i <= 12 ; $i++)
{
  $select = "";
 if ($i == $matchEnd[1])
   $select = 'selected';
  $j = $i - 1;
  print ("<option $select value=$i>$month[$j]</option>\n");
}
print ("</select>\n");
print <<< EDIT
<select name='endDateselect2' onchange='fulleval(endDateselect0,endDateselect1,endDateselect2,endDate)'>
EDIT;
for ($i = 2000 ; $i <= 2030 ; $i++)
{
  $select = "";
 if ($i == $matchEnd[0])
   $select = 'selected';
  print ("<option $select value=$i>$i</option>\n");
}
print ("</select>\n");
print <<< EDIT
</td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>Time Limit: </td>
       <td><input name="time" type="text" value="$row[9]" size='3' maxlength=4><small>minutes.</small></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>Passing Score: </td>
       <td><input name="passingScore" type="text" value="$row[10]" size='3' maxlength='3'> Percent correct.</td>
</tr>
<tr>
       <td align='right' valign='top' bgcolor='#dfdfdf'>Exam Instructions: </td>
       <td>$row[4]</td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>Number of Questions:</td>
       <td><input name="questions" type="text" value="$row[6]" maxlength=4 size="4">($max Question Available)</td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>Exam Active:</td>
       <td><input name="active" type="checkbox" $ch></td>
</tr>
<tr>
       <td align='right' valign='top' bgcolor='#dfdfdf'>&nbsp; </td>

       <td><input name="action" type="hidden" value="update">
	   <input name="examid" type="hidden" value="$examid">
	   <input name="ID" type="hidden" value="$ID">
	   <input type="submit" name="submit" value="Save Changes...">
	   </form>
	   </td>
</tr>
</table>
<hr>
EDIT;

?>

<script language="javascript">

	function validate()
	{
	 var start = new Date(document.form.startDateselect2.value,document.form.startDateselect1.value-1,document.form.startDateselect0.value);
	 var end = new Date(document.form.endDateselect2.value,document.form.endDateselect1.value-1,document.form.endDateselect0.value);
	 var diff = end - start;
	//alert (diff);
	if (diff < 0)
		{
		 alert ('Start Date should be previous of End Date');
		 return false;
		}
	if ((document.form.questions.value > <?php print ("$max") ?>) || (document.form.questions.value < 0))
		{
		 alert ('Questions should be less than or Equal to Available Questions');
		 return false;
		}
	else 
		 return true;
	}
</script>

</body>
</html>
