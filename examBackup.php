<?php
 include('cookie.php');


include('config.inc');

// TO see users id

 if ($ID = $_GET['ID'])
   ;
 else
   $ID = $_POST['ID'];


 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);


////////////////////////////////////////////////

	$examid = $_POST['examid'];
	$query = mysqli_query($db_connect,"select title from exam where examid='$examid'");
	$row = mysqli_fetch_row($query);
	$examName = $row[0];

	$action = $_POST['action'];

   if($action == 'backupnow')
   {
        $backup_file = 'db_certExam_' . $examName . '-' . date('YmdHis') . '.sql';

        $fp = fopen( $backup_file, 'w');

        fputs($fp, $schema);


          $fields_query = mysqli_query($db_connect,"select * from question where examid = '$examid' ");

          while ($field = $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);_fetch_array($fields_query))
	  {

	 $schema = 'insert into question values ('. $field[0] .',\''. $field[1].'\', \''.$field[2].'\', \''.$field[3].'\', \''.$field[4].'\', \''.$field[5].'\', \''.$field[6].'\', \''.$field[7].'\', \''.$field[8].'\', \''.$field[9].'\', \''.$field[10].'\', \''.$field[11].'\', \''.$field[12].'\', '.$field[13].', \''.$field[14].'\', '.$field[15].', '.$field[16].');' ."\n";

            fputs($fp, $schema);

          }

        fclose($fp);



        if (isset($_POST['download']) && ($_POST['download'] == 'yes'))
	 {
          header('Content-type: application/x-octet-stream');
          header('Content-disposition: attachment; filename=' . $backup_file);

          readfile($backup_file);
          unlink($backup_file);
          exit;

         }
         else
	 {
          print("success");
         }

        
        break;
  }
  else if($action == 'restorenow')
  {
        $filename = $HTTP_POST_FILES['sql_file']['tmp_name'];

	$farray = file($filename) or die("can't read '$filename' file");
	
	//loop through each entry
	foreach ($farray as $val)
	{
		$arr_1 = explode("\n", $val);

		for($i = 0 ; $i < count($arr_1) ; $i++)
		{
			//Enter data into database

			$query = $arr_1[$i];
			if($query != NULL)
			{
			$result = mysqli_query($db_connect,$query);

			if($db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);_affected_rows() != 1)
			{

			$arr_3 = explode(',', $arr_1[$i]);
//			print("Array Value = ".$arr_3[0]);

			$quesid = str_replace("(","",strstr($arr_3[0],'('));
//			print(" QID = ".$quesid); 
			$result1 = mysqli_query($db_connect,"DELETE FROM question WHERE questionid = '$quesid'");

			$result = mysqli_query($db_connect,$query);
			if($db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);_affected_rows() != 1)
			{
//				echo "Problem inserting contact admin";
				$mes = 1;
			}
			}
			}
		}
	}
	if(!$mes)
	print("<font color=GREEN>Operation Sucess</font><br>");
	else
	print("<font color=RED>Operation UnSucess</font><br>");
  }
///////////////////////////////////////////////

?>
<html>
<head>
<title>certExams.com - Online Test</title>
<link REL=StyleSheet HREF="style.css" TYPE="text/css">
</head>
<body>

<br><br>
<center>
<form name="backup" action="examBackup.php" method="post">
<table border="0" width="100%" cellspacing="0" cellpadding="2">

  <tr>
    <td>This will backup the questions belonging to the selected exam. Do not interrupt the backup process which might take a couple of minutes.</td>
  </tr>
  
  <tr>
	<td align="center">
	Select A Exam <select name="examid">
<?php
   $res=mysqli_query($db_connect,"SELECT exam.examid, exam.title FROM exam,candidate,examPermissions WHERE candidate.editExam = 1 AND candidate.candidateID = examPermissions.candidateID AND examPermissions.examid = exam.examid AND candidate.candidateID = '$ID'");
   while($grow = mysqli_fetch_row($res))
	print("\n<option value=\"$grow[0]\">$grow[1]\n");
?>
	</td>
  </tr>

  <tr>
    <td align="center"><br>
<input type="hidden" name="download" value="yes">
<input type="hidden" name="action" value="backupnow">
<input name="ID" type="hidden" value=<?php print("$ID") ?>>
<input type="submit" name="Backup" value=" Backup ">
   </td>
  </tr>
</table>
</form>
</center>
<center> <hr size="1" noshade="noshade" width=75%> </center>
<center>
<script language="JavaScript">
<!--
function check_form()
{
	var validity = true;
  if (!check_empty(document.restore.sql_file.value))
        { validity = false; alert('The File Name is missing.'); }

	return validity;
}

function check_empty(text) {
  return (text.length > 0); // returns false if empty
}
// -->
  </script>

<form name="restore" action="examBackup.php" method="post" enctype="multipart/form-data" onSubmit="return check_form();">
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td>Do not interrupt the restoration process.<br>The larger the backup, the longer this process takes!</td>
  </tr>
  <tr>
    <td align="center"><br><input type="file" name="sql_file"></td>
  </tr>
  <tr>
    <td align="center"><small>The file uploaded must be a raw sql (text) file.</small></td>

  </tr>
  <tr>
    <td align="center">
<input type="hidden" name="download" value="yes">
<input type="hidden" name="action" value="restorenow">
<input name="ID" type="hidden" value=<?php print("$ID") ?>>
<input type="submit" name="Restore" value=" Restore ">
	</td>
  </tr>
</table>
</form>
</center>
</body>
</html>
