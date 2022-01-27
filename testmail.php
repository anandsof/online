<?php
$submit = $_POST['submit'];
if($submit)
{
$subject = $_POST['subject'];
$email1 = $_POST['Email'];
$email = preg_split("/[,]+/", $email1);
$ti=count($email);
$username = $_POST['username'];

if ($HTTP_POST_FILES['filee']['tmp_name'])
{
$name   = $HTTP_POST_FILES['filee']['name'];
$count = 0;
#$mbody = fread(fopen($HTTP_POST_FILES['filee']['tmp_name'],"r"),
#filesize($HTTP_POST_FILES['filee']['tmp_name']));
if ($handle = opendir("naresh")) 
{
   while (false !== ($file = readdir($handle))) 
   {   if ($file != "." && $file != "..") 
       {
        $count++;
       }
   }
   closedir($handle);
}
$count++;

$mbody = fread(fopen($HTTP_POST_FILES['filee']['tmp_name'],"r"), filesize($HTTP_POST_FILES['filee']['tmp_name']));
#print("$mbody<br>");
$extension = explode(".",$name);

$fd = fopen("naresh/".$count.".".$extension[1], "w");
$fout = fwrite($fd,$mbody);
fclose($fd);
}
else
{
print("File Error");
exit;
}
for($i=0;$i<$ti;$i++)
{
$extra_header = "From:mail@certexams.com\r\nReply-#to:webmaster@anandsoft.com\r\nBounce-to:webmaster@anandsoft.com\r\n";
$mailto = "$email[$i]";
$mailsend = mail($mailto, $subject, $mbody ,$extra_header);
}
print<<<AAA
<center>
Your mail with the subject <b>$subject</b> has been sent to 
<br>
</center>
AAA;
for($i=0;$i<$ti;$i++)
{
print<<<ABB
<center>
<b>$email[$i]</b>
<br>
</center>
ABB;
}
print<<<CCF
<center>
<a href="news_mailer.php">Back</a>
</center>
CCF;
}
else
{
print<<<ENDL
<html>
<head>
<title>Test News Mailer</title>
<link REL=StyleSheet HREF="style.css" TYPE="text/css">
<script language="JavaScript">
<!--
function validate_form() {
  validity = true; // assume valid
if (!check_email(document.nform.Email.value) ||
      !check_empty(document.nform.Email.value))
        { validity = false; alert('The Email address field has either been left empty, or else it is an invalid address. Please correct this before submitting your order.'); }

 else if (!check_empty(document.nform.subject.value))
        { validity = false; alert('Please Enter Subject'); }

  else if (!check_empty(document.nform.filee.value))
        { validity = false; alert('Please browse for any file that you want to send as email'); }

return validity;
}
function check_empty(text) {
  return (text.length > 0); // returns false if empty
}
function check_email(address) {
  if ((address == "")
    || (address.indexOf ('@') == -1)
    || (address.indexOf ('.') == -1))
      return false;
  return true;
}
// -->
  </script>
</head>
<body>
<p><center><i><strong><font face="arial" color="#999999" size="4">Test News Mailer</font></strong></i></p>
<hr size="1" color="#c0c0c0" width="75%" align="center">
<hr size="1" width="60%" noshade>
<br>
<center></center>
<center>
 <form id="nform" name="nform" method="POST" onsubmit="return validate_form()" ENCTYPE="multipart/form-data" action="testmail.php">
         <table>
         <tr>
           <td class=label align="right">Email-id:</td>
           <td><input type="text" name="Email" size="20"></td>
          </tr>
          <tr>
           <td class=label align="right">Subject:</td>
           <td><input type="text" name="subject" size="20"></td>
          </tr>
          <tr>
           <td class=label align="right">File: </td>
           <td><input type="file" name="filee"></td>
          </tr>
          <tr><td></td><td></td></tr>
         <tr><td></td><td></td></tr>
         <tr><td></td><td></td></tr>
          <tr>
           <td align="center" colspan="2">
<input type="submit" name="submit" value="Send!"></td>
</tr>
</table>
</form>
</center>
</body>
</html>
ENDL;
}
?>