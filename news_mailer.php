<?php
include('config.inc');
$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);
$submit = $_POST['submit'];
$reset=$_POST['reset'];
$ddval=$_POST['times'];

if($submit)
{
 
 $subject = $_POST['subject'];
 if ($HTTP_POST_FILES['filee']['tmp_name'])
{
 $name   = $HTTP_POST_FILES['filee']['name'];
 $mbody = fread(fopen($HTTP_POST_FILES['filee']['tmp_name'],"r"), filesize($HTTP_POST_FILES['filee']['tmp_name']));
 $result =  mysqli_query($db_connect,"SELECT * FROM candidate WHERE Inforeceipt='yes' ORDER BY candidateID ASC");
 $i = 0;
 while($data = mysqli_fetch_row($result)) 
 {
   $mailid[$i] = $data[5];
   $i = $i + 1;
 }
$tot=$i;
echo("<center>");
echo "Total Members=";
echo $tot;
echo("</center>");
echo("<br>");


$resul =  mysqli_query($db_connect,"SELECT * FROM checklist WHERE id='1'");
$row = mysqli_fetch_row($resul);
$chk=$row[1];
$cs=$row[1];



for($j=$cs;$j<$cs+$ddval;$j++)
  {
       if($j == $tot)
       break;
       $extra_header = "From:mail@certexams.com\r\nReply-#to:webmaster@anandsoft.com\r\nBounce-to:webmaster@anandsoft.com\r\n";
       $mailto=$mailid[$j];
       $mailsend = mail($mailto, $subject, $mbody, $extra_header);
       
         
  }
    
    if($j == $tot)
     {
    echo("<center>");
    echo "You had sent mail to all the members.";  
    echo("</center>");
     }
    $cs=$j;
    echo("<center>");
    echo "Mail has sent to $cs members";
    echo("</center>");
    $res =  mysqli_query($db_connect,"UPDATE checklist SET currentstatus='$cs'  WHERE id='1'");
    $res1 =  mysqli_query($db_connect,"UPDATE checklist SET increment='$ddval'  WHERE id='1'");
    $res2 =  mysqli_query($db_connect,"UPDATE checklist SET subject='$subject'  WHERE id='1'");
    

}
else
{
print("Please select the file to be Uploaded");
exit;
}

}

if($reset)
{
$res =  mysqli_query($db_connect,"UPDATE checklist SET currentstatus='0' WHERE id='1'");
$res1 =  mysqli_query($db_connect,"UPDATE checklist SET increment='0'  WHERE id='1'");
$res2 =  mysqli_query($db_connect,"UPDATE checklist SET subject='0'  WHERE id='1'");
    
}
?>

<html>
<?php
$resull =  mysqli_query($db_connect,"SELECT * FROM checklist WHERE id='1'");
$rown = mysqli_fetch_row($resull);
?>
<head>
<title>News Mailer</title>
<link REL=StyleSheet HREF="style.css" TYPE="text/css">
</head>
<body>
<p><center><i><strong><font face="arial" color="#999999" size="4">News Mailer</font></strong></i></p>
<hr size="1" color="#c0c0c0" width="75%" align="center">
<hr size="1" width="60%" noshade>
<br>
<center></center>
<center>
 <form  method="POST"  ENCTYPE="multipart/form-data" action="news_mailer.php">
         <table>
         
          <tr>
           <td class=label align="right">Subject:</td>
           <td><input type="text" name="subject" size="70" value="<?php print $rown[3]?>" ></td>
          </tr>
          <tr>
           <td class=label align="right">File: </td>
           <td><input type="file" name="filee" ></td>
          </tr>
   <tr><td class=label align="right">Select the number of customers</td>
<td ><select name="times">
   <option value="2">2</option>
   <option value="10">10</option>
   <option value="20">20</option>
   <option value="50">50</option>
   <option value="100">100</option>
   <option value="200">200</option>
   <option value="500">500</option>
   </select></td></tr>
          <tr><td></td><td></td></tr>
         <tr><td></td><td></td></tr>
         <tr><td></td><td></td></tr>
          <tr>
           <td align="center" colspan="2">
<input type="submit" name="submit" value="Send!">
<input type="submit" name="reset" value="Reset!" onmouseover="this.value=' This will reset all values in Database '" onmouseout="this.value='Reset'"></td>
</tr>
<tr><td>&nbsp;&nbsp;</td></tr>
<tr><td align="center" colspan="2"><a href="testmail.php">Test Mail</a></td></tr>
</table>
</form>
</center>
</body>
</html>







