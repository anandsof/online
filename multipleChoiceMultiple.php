<?php
 include('cookie.php');
?>
<?php
 include('config.inc');

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

 $examid = $_GET['examid'];
 
if ($_POST['submit'] == "Save Question")
 {
  $examid = $_POST['examid'];
  $question = addslashes(trim($_POST['question']));
  $checkA = addslashes(trim($_POST['checkA']));
  $checkB = addslashes(trim($_POST['checkB']));
  $checkC = addslashes(trim($_POST['checkC']));
  $checkD = addslashes(trim($_POST['checkD']));
  $checkE = addslashes(trim($_POST['checkE']));
  $checkF = addslashes(trim($_POST['checkF']));
  $choice1 = addslashes(trim($_POST['choice1']));
  $choice2 = addslashes(trim($_POST['choice2']));
  $choice3 = addslashes(trim($_POST['choice3']));
  $choice4 = addslashes(trim($_POST['choice4']));
  $choice5 = addslashes(trim($_POST['choice5']));
  $choice6 = addslashes(trim($_POST['choice6']));
  $feedback = addslashes(trim($_POST['feedback']));
  $category = addslashes(trim($_POST['category']));
  $reference = addslashes(trim($_POST['reference']));
 
  $answer = $checkA.$checkB.$checkC.$checkD.$checkE.$checkF ;

 if ($category == '')
   $category = 'None';

  $result =  mysqli_query($db_connect,"SELECT CURDATE()");
  $row = mysqli_fetch_row($result);
  $date = $row[0];
 
  $query = "insert into question (questionid,question,choice1,choice2,choice3,choice4,choice5,choice6,answer,date,feedback,category,reference, examid,type ) VALUES (NULL, '$question', '$choice1', '$choice2', '$choice3', '$choice4', '$choice5', '$choice6', '$answer', '$date','$feedback', '$category', '$reference', '$examid', 'mcm')";
 $result = mysqli_query($db_connect,$query);

$query = mysqli_query($db_connect,"SELECT LAST_INSERT_ID()");
  $row = mysqli_fetch_row($query);
  $questionid = $row[0];

if ($HTTP_POST_FILES['image']['tmp_name'])
{
  $description = addslashes(trim($_POST['description']));
  // get height and width of image
    $imagehw = getimagesize($HTTP_POST_FILES['image']['tmp_name']);
  // prepare the image for inserting into the database
//   $data = addslashes(fread(fopen($HTTP_POST_FILES['image']['tmp_name'],"r"), filesize($HTTP_POST_FILES['image']['tmp_name'])));

  // if the user didn't fill in a description, add a default.
   $description = ($description == '') ? 'Attached image' : $description;
   $width  = $imagehw[0] + 50;
   $height = $imagehw[1] + 50;
   $type   = $HTTP_POST_FILES['image']['type'];
   $name   = $HTTP_POST_FILES['image']['name'];
   $size   = $HTTP_POST_FILES['image']['size'];

  $query = mysqli_query($db_connect,"INSERT INTO images(imageid,questionid,description,filename,filesize,width,height,filetype) values(NULL,'$questionid', '$description', '$name','$size','$width','$height','$type')");
##################################################
	   $data = fread(fopen($HTTP_POST_FILES['image']['tmp_name'],"r"), filesize($HTTP_POST_FILES['image']['tmp_name']));

	$fd = fopen("images/$name", "w");
	$fout = fwrite($fd,$data);
	fclose($fd);
##################################################
}
$message = "Question Added Sucessfully";
 }
 
  $result =  mysqli_query($db_connect,"SELECT DISTINCT category FROM question where examid = '$examid' ");
  
?>

<html>
<head>
<title>Online-test</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script LANGUAGE="JavaScript">
<!-- Begin

function validate()
{ 
  validity = true; // assume valid

  if (!check_empty(document.form.question.value))
        { validity = false; alert('The Question is missing.'); }

  else if ((!check_empty(document.form.choice1.value)) && (!check_empty(document.form.choice2.value)) && (!check_empty(document.form.choice3.value)) && (!check_empty(document.form.choice4.value)) && (!check_empty(document.form.choice5.value)) && (!check_empty(document.form.choice6.value)))
   { validity = false; alert('No Answers, Please give a Answer'); }

else if ((!check_empty(document.form.feedback.value)))
   { validity = false; alert('No Feedback, Please give a Feedback'); }

  return validity;
}

function check_empty(text) {
  return (text.length > 0); // returns false if empty
}

//  End -->
</script>

<link REL=StyleSheet HREF="style.css" TYPE="text/css">
</head>
<body>

<div align="right"><small><a href="javascript:onclick=parent.resizeFrame('0,*')">Change Screen Layout</a><BR><small>(click for fullscreen and click again for normal screen)</small></small></div>

<h3>Multiple Choice Question</h3>
<font color=GREEN><?php print("$message") ?></font><BR>
<table border='0' width="100%">
<form name="form" enctype="multipart/form-data" action="multipleChoiceMultiple.php" method="post" onsubmit="return validate()">

<tr>  
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Category</td>
       <td colspan='2'><input name='category' type='text' value='' size='20'>
	<select name='Schapter' onblur='this.form.category.value=this.form.Schapter.value'>
 	<?php
           print("<option value=None>None");

	   while($cat = mysqli_fetch_row($result))
	   { 
            if ($cat[0] != "None")
             print("<option value=\"$cat[0]\">$cat[0]");
           }
        ?>
        </select>
	<small>Type in a category or choose from the list.</small>
       </td>
</tr>        

<tr>
       <td valign=top align='right' bgcolor='#dfdfdf'>Question</td>
       <td colspan='2'><textarea name='question' rows='4' cols='60'></textarea></td>
     
</tr>

<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>A)<input name=checkA type='checkbox' value='a' ></td>
       <td align='left'><textarea name='choice1' rows='2' cols='55'></textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>B)<input name=checkB type='checkbox' value='b'></td>
       <td><textarea name='choice2' rows='2' cols='55'></textarea></td>

</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>C)<input name=checkC type='checkbox' value='c'></td>
       <td><textarea name='choice3' rows='2' cols='55'></textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>D)<input name=checkD type='checkbox' value='d'></td>
       <td><textarea name='choice4' rows='2' cols='55'></textarea></td>

</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>E)<input name=checkE type='checkbox' value='e'></td>
       <td><textarea name='choice5' rows='2' cols='55'></textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>F)<input name=checkF type='checkbox' value='f'></td>
       <td><textarea name='choice6' rows='2' cols='55'></textarea></td>

</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Feedback </td>
       <td colspan=2><textarea name='feedback' rows='5' cols='65'></textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Reference </td>
       <td colspan=2><input type="text" name='reference' length='20' maxlength='50'> </td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Image </td>
       <td colspan=2><input type="file" name="image"> </td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;description </td>
       <td colspan=2><input type="text" name="description" value=""> </td>
</tr>
<tr>   
       <td align='right' bgcolor='#dfdfdf'>&nbsp;<input name="examid" type="hidden" value=<?php print("$examid") ?> ></td>
       <td colspan='2'><br><input type="submit" name='submit' value='Save Question'></td>
     
</tr>
<tr>
	<td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td colspan=2><a href="createTest.php?examid=<?php print $examid ?>"> Add another Types of question</a></td>
</tr>
</form>
</table>
</body>
</html>
