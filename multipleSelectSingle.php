<?php
 include('cookie.php');
?>
<?php
 include('config.inc');

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

if ($_POST['submit'] == "Save Question")
 {
  $examid = $_POST['examid'];
  $question = $_POST['question'];
  $answer = $_POST['correctAns'];
  $choice1 = $_POST['choice1'];
  $choice2 = $_POST['choice2'];
  $choice3 = $_POST['choice3'];
  $choice4 = $_POST['choice4'];
  $choice5 = $_POST['choice5'];
  $choice6 = $_POST['choice6'];
  $feedback = $_POST['feedback'];
  $category = $_POST['category'];
  $reference = $_POST['reference'];
 

 if ($category == '')
   $category = 'None';

  $result =  mysqli_query($db_connect,"SELECT CURDATE()");
  $row = mysqli_fetch_row($result);
  $date = $row[0];
 
  $query = "insert into question (questionid,question,choice1,choice2,choice3,choice4,choice5,choice6,answer,date,feedback,category,reference, examid ) VALUES (NULL, '$question', '$choice1', '$choice2', '$choice3', '$choice4', '$choice5', '$choice6', '$answer', '$date','$feedback', '$category', '$reference', '$examid')";
 $result = mysqli_query($db_connect,$query);
 }
 
  $result =  mysqli_query($db_connect,"SELECT DISTINCT category FROM question");
  
?>

<html>
<head>
<title>Online-test</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>
<body>
<h3>Multiple Choice Question</h3>
<table border='0' width=600>
<form action="createTest.php" method="post">

<tr>  
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Category</td>
       <td colspan='2'><input name='category' type='text' value='' size='20'>
	<select name='Schapter' onblur='this.form.category.value=this.form.Schapter.value'>
 	<?php
	   while($cat = mysqli_fetch_row($result))
	    print("<option value=\"$cat[0]\">$cat[0]");
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
       <td>A)<input name=correctAns type='radio' value='a' ></td>
       <td align='left'><textarea name='choice1' rows='2' cols='55'></textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>B)<input name=correctAns type='radio' value='b'></td>
       <td><textarea name='choice2' rows='2' cols='55'></textarea></td>

</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>C)<input name=correctAns type='radio' value='c'></td>
       <td><textarea name='choice3' rows='2' cols='55'></textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>D)<input name=correctAns type='radio' value='d'></td>
       <td><textarea name='choice4' rows='2' cols='55'></textarea></td>

</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>E)<input name=correctAns type='radio' value='e'></td>
       <td><textarea name='choice5' rows='2' cols='55'></textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>F)<input name=correctAns type='radio' value='f'></td>
       <td><textarea name='choice6' rows='2' cols='55'></textarea></td>

</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Feedback </td>
       <td colspan=2><textarea name='feedback' rows='3' cols='60'></textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Reference </td>
       <td colspan=2><input type="text" name='reference' length='20'></td>
</tr>
<tr>   
       <td align='right' bgcolor='#dfdfdf'>&nbsp;<input name="examid" type="hidden" value=<?php print("$examid") ?> ></td>
       <td colspan='2'><br><input type="submit" name='submit' value='Save Question'></td>
     
</tr>
<tr>
	<td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td colspan=2><a href="main_html.html">Go to home</a></td>
</tr>
</form>
</table>
</body>
</html>
