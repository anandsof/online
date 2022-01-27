<?php
 include('cookie.php');
?>
<html>
<head>
<title>Online-test</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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

<div align="right"><small><a href="javascript:onclick=parent.resizeFrame('0,*')">Change Screen Layout</a><BR><small>(click for fullscreen and click again for normal screen)</small></small></div>

<?php
 include('config.inc');
  $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

 if ($examid = $_POST['examid'])
  ;
 else
  $examid = $_GET['examid']; 

  $action = $_GET['action'];

  if($id = $_GET['id']);
  else $id = $_POST['id'];

  $type = $_GET['type'];
  $next = $_POST['next'];

 if($next)
 {

   $question = addslashes(trim($_POST['question']));
   $choice1  = addslashes(trim($_POST['choice1']));
   $choice2  = addslashes(trim($_POST['choice2']));
   $choice3  = addslashes(trim($_POST['choice3']));
   $choice4  = addslashes(trim($_POST['choice4']));
   $choice5  = addslashes(trim($_POST['choice5']));
   $choice6  = addslashes(trim($_POST['choice6']));
   $answer   = addslashes(trim($_POST['correctAns']));
   $feedback = addslashes(trim($_POST['feedback']));
   $category = addslashes(trim($_POST['category']));
   $reference = addslashes(trim($_POST['reference']));
   $id = $_POST['qid'];

  $checkA = $_POST['checkA'];
  $checkB = $_POST['checkB'];
  $checkC = $_POST['checkC'];
  $checkD = $_POST['checkD'];
  $checkE = $_POST['checkE'];
  $checkF = $_POST['checkF'];
  if($checkA || $checkB || $checkC || $checkD || $checkE || $checkF)
    $answer = $checkA.$checkB.$checkC.$checkD.$checkE.$checkF ;

 if (($_POST['choice1a']) && ($_POST['choice1b']))
 {
  $choice1 = addslashes(trim($_POST['choice1a']));
  $choice1 .= " -1-1-1- ";
  $choice1 .= addslashes(trim($_POST['choice1b']));
  $answer ="DRAG";
 }
 if (($_POST['choice2a']) && ($_POST['choice2b']))
 {
  $choice2 = addslashes(trim($_POST['choice2a']));
  $choice2 .= " -1-1-1- ";
  $choice2 .= addslashes(trim($_POST['choice2b']));
  $answer ="DRAG";
 }
 if (($_POST['choice3a']) && ($_POST['choice3b']))
 {
  $choice3 = addslashes(trim($_POST['choice3a']));
  $choice3 .= " -1-1-1- ";
  $choice3 .= addslashes(trim($_POST['choice3b']));
  $answer ="DRAG";
 }
 if (($_POST['choice4a']) && ($_POST['choice4b']))
 {
  $choice4 = addslashes(trim($_POST['choice4a']));
  $choice4 .= " -1-1-1- ";
  $choice4 .= addslashes(trim($_POST['choice4b']));
  $answer ="DRAG";
 }
 if (($_POST['choice5a']) && ($_POST['choice5b']))
 {
  $choice5 = addslashes(trim($_POST['choice5a']));
  $choice5 .= " -1-1-1- ";
  $choice5 .= addslashes(trim($_POST['choice5b']));
  $answer ="DRAG";
 }
 if (($_POST['choice6a']) && ($_POST['choice6b']))
 {
  $choice6 = addslashes(trim($_POST['choice6a']));
  $choice6 .= " -1-1-1- ";
  $choice6 .= addslashes(trim($_POST['choice6b']));
  $answer ="DRAG";
 }


 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

  $query = "UPDATE question SET 
                question = '$question',
                choice1  = '$choice1',
                choice2  = '$choice2',
                choice3  = '$choice3',
                choice4  = '$choice4',
                choice5  = '$choice5',
                choice6  = '$choice6',
                answer   = '$answer',
                feedback = '$feedback',
                category = '$category',
                reference = '$reference'
            WHERE questionid = '$id'";
  $result = mysqli_query($db_connect,$query);


if ($HTTP_POST_FILES['image']['tmp_name'])
{
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

  $result =  mysqli_query($db_connect,"SELECT * FROM images WHERE questionid = '$id'");
  if($img = mysqli_fetch_row($result))
  {
###########################
	$deleteFilename = "images/".$img[3];
	unlink($deleteFilename);

	 $data = fread(fopen($HTTP_POST_FILES['image']['tmp_name'],"r"), filesize($HTTP_POST_FILES['image']['tmp_name']));

	$fd = fopen("images/$name", "w");
	$fout = fwrite($fd,$data);
	fclose($fd);

    $query = "UPDATE images SET 
                description  = '$description',
                filename  = '$name',
                filesize  = '$size',
                width  = '$width',
                height  = '$height',
                filetype  = '$type'
            WHERE questionid = '$id'";
    $result = mysqli_query($db_connect,$query);
	
  }
  else
  {
    $query = mysqli_query($db_connect,"INSERT INTO images(imageid,questionid,description,filename,filesize,width,height,filetype) values(NULL,'$id', '$description', '$name','$size','$width','$height','$type')");

	 $data = fread(fopen($HTTP_POST_FILES['image']['tmp_name'],"r"), filesize($HTTP_POST_FILES['image']['tmp_name']));
######################
	$fd = fopen("images/$name", "w");
	$fout = fwrite($fd,$data);
	fclose($fd);
######################
  }
}



	$query = "select questionid, type from question where examid = '$examid' order by questionid";
	$result = mysqli_query($db_connect,$query);
	while($row = mysqli_fetch_row($result))
		if($row[0] == $id)
			break;
		$row = mysqli_fetch_row($result);
		$id = $row[0];
		$type = $row[1];
		$action = "edit";
	if($id == '')
{
print <<< ENDUPDATE
<html>
<body>
<script language="javascript">
<!--
location.href ="editTest.php?examid=	$examid&action=show&category=ALL&type=ALL";
//-->
</script>
</body>
</html>
ENDUPDATE;
}
//print("$id = $type = $action");

 }


 if ($action == 'edit')
 {
  $result =  mysqli_query($db_connect,"SELECT * FROM question WHERE questionid = '$id'");
  $row = mysqli_fetch_row($result);

// Request to delete the Image

  if ( $imagid = $_GET['imageid'] )
	{

	  $result =  mysqli_query($db_connect,"SELECT * FROM images WHERE imageid = '$imagid'");
  if($img = mysqli_fetch_row($result)) {
	$deleteFilename = "images/".$img[3];
	unlink($deleteFilename);
	}

     $result =  mysqli_query($db_connect,"DELETE FROM images WHERE imageid = '$imagid'");
	$imageid = 0;
	}

// IF the Question has a Image 
 
  $result =  mysqli_query($db_connect,"SELECT * FROM images WHERE questionid = '$id'");
  if($img = mysqli_fetch_row($result))
  {
   $imageid = $img[0];
   $questionid = $img[1];
   $description = $img[2];
   $filename = $img[3];
   $filesize = $img[4];
   $width = $img[5];
   $height = $img[6];
   $filetype = $img[7];
  } 

// If it is multiple choice and single select

if ($type == 'mcs')
{
  if($row[8] == 'a')
   $checka = "checked";
  else if($row[8] == 'b')
   $checkb = "checked";
  else if($row[8] == 'c')
   $checkc = "checked";
  else if($row[8] == 'd')
   $checkd = "checked";
  else if($row[8] == 'e')
   $checke = "checked";
  else if($row[8] == 'f')
   $checkf = "checked";
  
// $check .= $row[8]; 
// $myA["$row[8]"] = "checked";
// print("$check and it is ".$myA[$row[8]]);

 
print <<< ENDEDIT

<h3>Edit Multiple Choice Question</h3>
<table border='0' width="100%">
<form name="form" enctype="multipart/form-data" action="editQuestion.php" method="post">
<tr>  
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Category</td>
       <td colspan='2'><input name='category' type='text' value="$row[11]" size='20'>
	<select name='Schapter' onblur='this.form.category.value=this.form.Schapter.value'>
         <option value=None>None
ENDEDIT;
         $res =  mysqli_query($db_connect,"SELECT DISTINCT category FROM question WHERE examid = '$examid'");
	   while($cat = mysqli_fetch_row($res))
            if ($cat[0] != "None")
	    {  
	      $cat[0] = stripslashes($cat[0]);
              print("<option value=\"$cat[0]\">$cat[0]");
	    }

      $row[1] = stripslashes($row[1]);
      $row[2] = stripslashes($row[2]);
      $row[3] = stripslashes($row[3]);
      $row[4] = stripslashes($row[4]);
      $row[5] = stripslashes($row[5]);
      $row[6] = stripslashes($row[6]);
      $row[7] = stripslashes($row[7]);
      $row[8] = stripslashes($row[8]);
      $row[10] = stripslashes($row[10]);
      $row[11] = stripslashes($row[11]);
      $row[12] = stripslashes($row[12]);
print <<< ENDEDIT
        </select>
	<small>Type in a category or choose from the list.</small>
       </td>
</tr>      
<tr>
       <td valign=top align='right' bgcolor='#dfdfdf'>Question</td>
       <td colspan='2'><textarea name='question' rows='4' cols='60'>$row[1]</textarea></td>
     
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>A)<input name=correctAns type='radio' value='a' $checka ></td>
       <td align='left'><textarea name='choice1' rows='2' cols='55'>$row[2]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>B)<input name=correctAns type='radio' value='b' $checkb></td>
       <td><textarea name='choice2' rows='2' cols='55'>$row[3]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>C)<input name=correctAns type='radio' value='c' $checkc></td>
       <td><textarea name='choice3' rows='2' cols='55'>$row[4]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>D)<input name=correctAns type='radio' value='d' $checkd></td>
       <td><textarea name='choice4' rows='2' cols='55'>$row[5]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>E)<input name=correctAns type='radio' value='e' $checke></td>
       <td><textarea name='choice5' rows='2' cols='55'>$row[6]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>F)<input name=correctAns type='radio' value='f' $checkf></td>
       <td><textarea name='choice6' rows='2' cols='55'>$row[7]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Feedback </td>
       <td colspan=2><textarea name='feedback' rows='5' cols='65'>$row[10]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Reference </td>
       <td colspan=2><input type="text" name='reference' value="$row[12]"  length='20'></td>
</tr>
ENDEDIT;
 if ($imageid)
  {
$description = stripslashes($description);
  print ("<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp; Image</td>
     <td colspan=2><a href=\"javascript: onclick=MM_openBrWindow('picture.php?imageid=$imageid','Image','scrollbars=yes,resizable=yes,width=$width,height=$height' )\">$description</a> &nbsp;&nbsp; <a href=\"editQuestion.php?action=edit&id=$id&examid=$examid&type=mcs&imageid=$imageid\"> [remove] </a><br>&nbsp;&nbsp;Or  Replace By</td>
</tr>");
  }

print <<< ENDEDIT

<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Image </td>
       <td colspan=2><input type="file" name="image"> </td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;description </td>
       <td colspan=2><input type="text" name="description" value=""> </td>
</tr>
<tr>   
       <td align='right' bgcolor='#dfdfdf'>
<input name='qid' type="hidden" value=$id>
<input name="examid" type="hidden" value=$examid>
</td>
       <td colspan='2'><br><input type="submit" name='submit' value='Save Changes'> 
<input type=hidden name=next value=1>
<input type=hidden name=id value=$id>
<input type=hidden name=examid value=$examid>
<input type="submit" onclick="document.form.action='editQuestion.php'" name='next' value='Save & Go Next'> </td>

</tr>
<tr>
	<td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td colspan=2><a href="editTest.php?examid=$examid&action=show&category=ALL&type=ALL"><< back</a></td>
</tr>
</form>
</table>

ENDEDIT;
} //end of type mcs

// if the type is Multiple choice and multiple select

if ($type == 'mcm')
{

 $ans = $row[8];
 for($i = 0; $i <= strlen($ans); $i++)
 {
  if($ans{$i} == 'a')
   $checka = "checked";
  else if($ans{$i} == 'b')
   $checkb = "checked";
  else if($ans{$i} == 'c')
   $checkc = "checked";
  else if($ans{$i} == 'd')
   $checkd = "checked";
  else if($ans{$i} == 'e')
   $checke = "checked";
  else if($ans{$i} == 'f')
   $checkf = "checked";
 }

      $row[1] = stripslashes($row[1]);
      $row[2] = stripslashes($row[2]);
      $row[3] = stripslashes($row[3]);
      $row[4] = stripslashes($row[4]);
      $row[5] = stripslashes($row[5]);
      $row[6] = stripslashes($row[6]);
      $row[7] = stripslashes($row[7]);
      $row[10] = stripslashes($row[10]);
      $row[11] = stripslashes($row[11]);
      $row[12] = stripslashes($row[12]);

print <<< ENDEDIT

<h3>Edit Multiple Choice Question</h3>
<table border='0' width="100%">
<form name="form" enctype="multipart/form-data" action="editQuestion.php" method="post">
<tr>  
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Category</td>
       <td colspan='2'><input name='category' type='text' value="$row[11]" size='20'>
	<select name='Schapter' onblur='this.form.category.value=this.form.Schapter.value'>
         <option value=None>None
ENDEDIT;
         $res =  mysqli_query($db_connect,"SELECT DISTINCT category FROM question WHERE examid = '$examid'");
	   while($cat = mysqli_fetch_row($res))
            if ($cat[0] != "None")
	    {  
	      $cat[0] = stripslashes($cat[0]);
              print("<option value=\"$cat[0]\">$cat[0]");
	    }
print <<< ENDEDIT
        </select>
	<small>Type in a category or choose from the list.</small>
       </td>
</tr>      
<tr>
       <td valign=top align='right' bgcolor='#dfdfdf'>Question</td>
       <td colspan='2'><textarea name='question' rows='4' cols='60'>$row[1]</textarea></td>
     
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>A)<input name=checkA type='checkbox' value='a' $checka ></td>
       <td align='left'><textarea name='choice1' rows='2' cols='55'>$row[2]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>B)<input name=checkB type='checkbox' value='b' $checkb></td>
       <td><textarea name='choice2' rows='2' cols='55'>$row[3]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>C)<input name=checkC type='checkbox' value='c' $checkc></td>
       <td><textarea name='choice3' rows='2' cols='55'>$row[4]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>D)<input name=checkD type='checkbox' value='d' $checkd></td>
       <td><textarea name='choice4' rows='2' cols='55'>$row[5]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>E)<input name=checkE type='checkbox' value='e' $checke></td>
       <td><textarea name='choice5' rows='2' cols='55'>$row[6]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>F)<input name=checkF type='checkbox' value='f' $checkf></td>
       <td><textarea name='choice6' rows='2' cols='55'>$row[7]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Feedback </td>
       <td colspan=2><textarea name='feedback' rows='5' cols='65'>$row[10]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Reference </td>
       <td colspan=2><input type="text" name='reference' value="$row[12]"  length='20'></td>
</tr>
ENDEDIT;
 if ($imageid)
  {
  print ("<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp; Image</td>
     <td colspan=2><a href=\"javascript: onclick=MM_openBrWindow('picture.php?imageid=$imageid','Image','scrollbars=yes,resizable=yes,width=$width,height=$height' )\">$description</a> &nbsp;&nbsp; <a href=\"editQuestion.php?action=edit&id=$id&examid=$examid&type=mcm&imageid=$imageid\"> [remove] </a><br>&nbsp;&nbsp;Or  Replace By</td>
</tr>");
  }

print <<< ENDEDIT
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Image </td>
       <td colspan=2><input type="file" name="image"> </td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;description </td>
       <td colspan=2><input type="text" name="description" value=""> </td>
</tr>
<tr>   
       <td align='right' bgcolor='#dfdfdf'>
<input name='qid' type="hidden" value=$id>
<input name="examid" type="hidden" value=$examid>
</td>
       <td colspan='2'><br><input type="submit" name='submit' value='Save Changes'>
<input type=hidden name=next value=1>
<input type=hidden name=id value=$id>
<input type=hidden name=examid value=$examid>
<input type="submit" onclick="document.form.action='editQuestion.php'" name='next' value='Save & Go Next'> </td>
</td>
     
</tr>
<tr>
	<td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td colspan=2><a href="editTest.php?examid=$examid&action=show&category=ALL&type=ALL"><< back</a></td>
</tr>
</form>
</table>

ENDEDIT;
} //end of type mcm


// if type is true and false

if ($type == 'tf')
{

  if($row[8] == 'true')
   $checkT = "checked";
  else if($row[8] == 'false')
   $checkF = "checked";

      $row[1] = stripslashes($row[1]);
      $row[10] = stripslashes($row[10]);
      $row[11] = stripslashes($row[11]);
      $row[12] = stripslashes($row[12]);

print <<< ENDEDIT

<h3>Edit True/False Question</h3>
<table border='0' width="100%">
<form enctype="multipart/form-data" action="editQuestion.php" method="post">
<tr>  
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Category</td>
       <td colspan='2'><input name='category' type='text' value="$row[11]" size='20'>
	<select name='Schapter' onblur='this.form.category.value=this.form.Schapter.value'>
         <option value=None>None
ENDEDIT;
         $res =  mysqli_query($db_connect,"SELECT DISTINCT category FROM question WHERE examid = '$examid'");
	   while($cat = mysqli_fetch_row($res))
            if ($cat[0] != "None")   
	    {  
	      $cat[0] = stripslashes($cat[0]);
              print("<option value=\"$cat[0]\">$cat[0]");
	    }
print <<< ENDEDIT
        </select>
	<small>Type in a category or choose from the list.</small>
       </td>
</tr>      
<tr>
       <td valign=top align='right' bgcolor='#dfdfdf'>Question</td>
       <td colspan='2'><textarea name='question' rows='4' cols='60'>$row[1]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>True<input name=correctAns type='radio' $checkT value='true'></td>     
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td>False<input name=correctAns type='radio' $checkF value='false'></td>       
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Feedback </td>
       <td colspan=2><textarea name='feedback' rows='5' cols='65'>$row[10]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Reference </td>
       <td colspan=2><input type="text" name='reference' value="$row[12]"  length='20'></td>
</tr>
ENDEDIT;
 if ($imageid)
  {
  print ("<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp; Image</td>
     <td colspan=2><a href=\"javascript: onclick=MM_openBrWindow('picture.php?imageid=$imageid','Image','scrollbars=yes,resizable=yes,width=$width,height=$height' )\">$description</a> &nbsp;&nbsp; <a href=\"editQuestion.php?action=edit&id=$id&examid=$examid&type=tf&imageid=$imageid\"> [remove] </a><br>&nbsp;&nbsp;Or  Replace By</td>
</tr>");
  }

print <<< ENDEDIT
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Image </td>
       <td colspan=2><input type="file" name="image"> </td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;description </td>
       <td colspan=2><input type="text" name="description" value=""> </td>
</tr>
<tr>   
       <td align='right' bgcolor='#dfdfdf'>
<input name='qid' type="hidden" value=$id>
<input name="examid" type="hidden" value=$examid>
</td>
       <td colspan='2'><br><input type="submit" name='submit' value='Save Changes'>
<input type=hidden name=next value=1>
<input type=hidden name=id value=$id>
<input type=hidden name=examid value=$examid>
<input type="submit" onclick="document.form.action='editQuestion.php'" name='next' value='Save & Go Next'> </td>
</td>
     
</tr>
<tr>
	<td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td colspan=2><a href="editTest.php?examid=$examid&action=show&category=ALL&type=ALL"><< back</a></td>
</tr>
</form>
</table>

ENDEDIT;


}//End of true false

// if it is short answer type

if ($type == 'sa')
{
      $row[1] = stripslashes($row[1]);
      $row[8] = stripslashes($row[8]);
      $row[10] = stripslashes($row[10]);
      $row[11] = stripslashes($row[11]);
      $row[12] = stripslashes($row[12]);
print <<< ENDEDIT

<h3>Edit Essay or Short Answer Question</h3>
<table border='0' width="100%">
<form enctype="multipart/form-data" action="editQuestion.php" method="post">
<tr>  
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Category</td>
       <td colspan='2'><input name='category' type='text' value="$row[11]" size='20'>
	<select name='Schapter' onblur='this.form.category.value=this.form.Schapter.value'>
         <option value=None>None
ENDEDIT;
         $res =  mysqli_query($db_connect,"SELECT DISTINCT category FROM question WHERE examid = '$examid'");
	   while($cat = mysqli_fetch_row($res))
            if ($cat[0] != "None")   
	    {  
	      $cat[0] = stripslashes($cat[0]);
              print("<option value=\"$cat[0]\">$cat[0]");
	    }
print <<< ENDEDIT
        </select>
	<small>Type in a category or choose from the list.</small>
       </td>
</tr>      
<tr>
       <td valign=top align='right' bgcolor='#dfdfdf'>Question</td>
       <td colspan='2'><textarea name='question' rows='4' cols='60'>$row[1]</textarea></td>
</tr>
<tr>
       <td valign='top' align='right' bgcolor='#dfdfdf'>Answer</td>
       <td align='left'><textarea name='correctAns' rows='2' cols='60'>$row[8]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Feedback </td>
       <td colspan=2><textarea name='feedback' rows='5' cols='65'>$row[10]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Reference </td>
       <td colspan=2><input type="text" name='reference' value="$row[12]"  length='20'></td>
</tr>
ENDEDIT;
 if ($imageid)
  {
  print ("<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp; Image</td>
     <td colspan=2><a href=\"javascript: onclick=MM_openBrWindow('picture.php?imageid=$imageid','Image','scrollbars=yes,resizable=yes,width=$width,height=$height' )\">$description</a> &nbsp;&nbsp; <a href=\"editQuestion.php?action=edit&id=$id&examid=$examid&type=sa&imageid=$imageid\"> [remove] </a><br>&nbsp;&nbsp;Or  Replace By</td>
</tr>");
  }

print <<< ENDEDIT
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Image </td>
       <td colspan=2><input type="file" name="image"> </td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;description </td>
       <td colspan=2><input type="text" name="description" value=""> </td>
</tr>
<tr>   
       <td align='right' bgcolor='#dfdfdf'>
<input name='qid' type="hidden" value=$id>
<input name="examid" type="hidden" value=$examid>
</td>
       <td colspan='2'><br><input type="submit" name='submit' value='Save Changes'>
<input type=hidden name=next value=1>
<input type=hidden name=id value=$id>
<input type=hidden name=examid value=$examid>
<input type="submit" onclick="document.form.action='editQuestion.php'" name='next' value='Save & Go Next'> </td>
</td>
     
</tr>
<tr>
	<td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
       <td colspan=2><a href="editTest.php?examid=$examid&action=show&category=ALL&type=ALL"><< back</a></td>
</tr>
</form>
</table>

ENDEDIT;
}//End of short answer type


// If the choice is for drag and drop

if ($type == 'dd')
{

      $row[1] = stripslashes($row[1]);
      $row[10] = stripslashes($row[10]);
      $row[11] = stripslashes($row[11]);
      $row[12] = stripslashes($row[12]);

print <<< ENDEDIT

<h3>Edit Matching Question</h3>
<table border='0' width="100%">
<form enctype="multipart/form-data" action="editQuestion.php" method="post">
<tr>  
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Category</td>
       <td colspan='2'><input name='category' type='text' value="$row[11]" size='20'>
	<select name='Schapter' onblur='this.form.category.value=this.form.Schapter.value'>
   	<option value=None>None
ENDEDIT;
         $res =  mysqli_query($db_connect,"SELECT DISTINCT category FROM question WHERE examid = '$examid'");
	   while($cat = mysqli_fetch_row($res))
            if ($cat[0] != "None")   
	    {  
	      $cat[0] = stripslashes($cat[0]);
              print("<option value=\"$cat[0]\">$cat[0]");
	    }
print <<< ENDEDIT
        </select>
	<small>Type in a category or choose from the list.</small>
       </td>
</tr>        

<tr>
       <td valign=top align='right' bgcolor='#dfdfdf'>Question</td>
       <td colspan='2'><textarea name='question' rows='4' cols='60'>$row[1]</textarea></td>
     
</tr>
ENDEDIT;
for ($i = 2; $i <= 7; $i++)
{
$j = $i - 1;
 $match = explode(" -1-1-1- ",$row[$i]);
      $match[0] = stripslashes($match[0]);
      $match[1] = stripslashes($match[1]);
  print ("<tr>\n<td align='right' bgcolor='#dfdfdf'></td>\n
       <td><textarea name='choice{$j}a' rows='2' cols='20'>$match[0]</textarea></td>\n
       <td><textarea name='choice{$j}b' rows='2' cols='20'>$match[1]</textarea></td>\n</tr>");

}
print <<< ENDEDIT
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Feedback </td>
       <td colspan=2><textarea name='feedback' rows='5' cols='65'>$row[10]</textarea></td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Reference </td>
       <td colspan=2><input type="text" name='reference' length='20' maxlength='50' value=$row[12]></td>
</tr>
ENDEDIT;
 if ($imageid)
  {
  print ("<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp; Image</td>
     <td colspan=2><a href=\"javascript: onclick=MM_openBrWindow('picture.php?imageid=$imageid','Image','scrollbars=yes,resizable=yes,width=$width,height=$height' )\">$description</a> &nbsp;&nbsp; <a href=\"editQuestion.php?action=edit&id=$id&examid=$examid&type=dd&imageid=$imageid\"> [remove] </a><br>&nbsp;&nbsp;Or  Replace By</td>
</tr>");
  }

print <<< ENDEDIT
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;Image </td>
       <td colspan=2><input type="file" name="image"> </td>
</tr>
<tr>
       <td align='right' bgcolor='#dfdfdf'>&nbsp;description </td>
       <td colspan=2><input type="text" name="description" value=""> </td>
</tr>
<tr>   
       <td align='right' bgcolor='#dfdfdf'>&nbsp;<input name="examid" type="hidden" value=$examid>
<input name='qid' type="hidden" value=$id> 
</td>
       <td colspan='2'><br><input type="submit" name='submit' value='Save Question'>
<input type=hidden name=next value=1>
<input type=hidden name=id value=$id>
<input type=hidden name=examid value=$examid>
<input type="submit" onclick="document.form.action='editQuestion.php'" name='next' value='Save & Go Next'> </td>
</td>
     
</tr>
<tr>
	<td align='right' bgcolor='#dfdfdf'>&nbsp;</td>
     <td colspan=2><a href="editTest.php?examid=$examid&action=show&category=ALL&type=ALL"><< back</a></td>
</tr>
</form>
</table>
ENDEDIT;

} //End of drag and drop

} // end of edit


// Now save the changes

if ($_POST['submit'])
{
   $question = addslashes(trim($_POST['question']));
   $choice1  = addslashes(trim($_POST['choice1']));
   $choice2  = addslashes(trim($_POST['choice2']));
   $choice3  = addslashes(trim($_POST['choice3']));
   $choice4  = addslashes(trim($_POST['choice4']));
   $choice5  = addslashes(trim($_POST['choice5']));
   $choice6  = addslashes(trim($_POST['choice6']));
   $answer   = addslashes(trim($_POST['correctAns']));
   $feedback = addslashes(trim($_POST['feedback']));
   $category = addslashes(trim($_POST['category']));
   $reference = addslashes(trim($_POST['reference']));
   $id = $_POST['qid'];

  $checkA = $_POST['checkA'];
  $checkB = $_POST['checkB'];
  $checkC = $_POST['checkC'];
  $checkD = $_POST['checkD'];
  $checkE = $_POST['checkE'];
  $checkF = $_POST['checkF'];
  if($checkA || $checkB || $checkC || $checkD || $checkE || $checkF)
    $answer = $checkA.$checkB.$checkC.$checkD.$checkE.$checkF ;

 if (($_POST['choice1a']) && ($_POST['choice1b']))
 {
  $choice1 = addslashes(trim($_POST['choice1a']));
  $choice1 .= " -1-1-1- ";
  $choice1 .= addslashes(trim($_POST['choice1b']));
  $answer ="DRAG";
 }
 if (($_POST['choice2a']) && ($_POST['choice2b']))
 {
  $choice2 = addslashes(trim($_POST['choice2a']));
  $choice2 .= " -1-1-1- ";
  $choice2 .= addslashes(trim($_POST['choice2b']));
  $answer ="DRAG";
 }
 if (($_POST['choice3a']) && ($_POST['choice3b']))
 {
  $choice3 = addslashes(trim($_POST['choice3a']));
  $choice3 .= " -1-1-1- ";
  $choice3 .= addslashes(trim($_POST['choice3b']));
  $answer ="DRAG";
 }
 if (($_POST['choice4a']) && ($_POST['choice4b']))
 {
  $choice4 = addslashes(trim($_POST['choice4a']));
  $choice4 .= " -1-1-1- ";
  $choice4 .= addslashes(trim($_POST['choice4b']));
  $answer ="DRAG";
 }
 if (($_POST['choice5a']) && ($_POST['choice5b']))
 {
  $choice5 = addslashes(trim($_POST['choice5a']));
  $choice5 .= " -1-1-1- ";
  $choice5 .= addslashes(trim($_POST['choice5b']));
  $answer ="DRAG";
 }
 if (($_POST['choice6a']) && ($_POST['choice6b']))
 {
  $choice6 = addslashes(trim($_POST['choice6a']));
  $choice6 .= " -1-1-1- ";
  $choice6 .= addslashes(trim($_POST['choice6b']));
  $answer ="DRAG";
 }


 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

  $query = "UPDATE question SET 
                question = '$question',
                choice1  = '$choice1',
                choice2  = '$choice2',
                choice3  = '$choice3',
                choice4  = '$choice4',
                choice5  = '$choice5',
                choice6  = '$choice6',
                answer   = '$answer',
                feedback = '$feedback',
                category = '$category',
                reference = '$reference'
            WHERE questionid = '$id'";
  $result = mysqli_query($db_connect,$query);


if ($HTTP_POST_FILES['image']['tmp_name'])
{
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

  $result =  mysqli_query($db_connect,"SELECT * FROM images WHERE questionid = '$id'");
  if($img = mysqli_fetch_row($result))
  {

##############################################
	$deleteFilename = "images/".$img[3];
	unlink($deleteFilename);

	 $data = fread(fopen($HTTP_POST_FILES['image']['tmp_name'],"r"), filesize($HTTP_POST_FILES['image']['tmp_name']));

	$fd = fopen("images/$name", "w");
	$fout = fwrite($fd,$data);
	fclose($fd);

    $query = "UPDATE images SET 
                description  = '$description',
                filename  = '$name',
                filesize  = '$size',
                width  = '$width',
                height  = '$height',
                filetype  = '$type'
            WHERE questionid = '$id'";
    $result = mysqli_query($db_connect,$query);
  }
  else
  {
    $query = mysqli_query($db_connect,"INSERT INTO images(imageid,questionid,description,filename,filesize,width,height,filetype) values(NULL,'$id', '$description', '$name','$size','$width','$height','$type')");

	 $data = fread(fopen($HTTP_POST_FILES['image']['tmp_name'],"r"), filesize($HTTP_POST_FILES['image']['tmp_name']));
	$fd = fopen("images/$name", "w");
	$fout = fwrite($fd,$data);
	fclose($fd);
######################
  }
}


print <<< ENDUPDATE
<html>
<body>
<script language="javascript">
<!--
location.href ="editTest.php?examid=$examid&action=show&category=ALL&type=ALL";
//-->
</script>
</body>
</html>
ENDUPDATE;
}
 mysqli_close($db_connect);
?>

</body>
</html>
