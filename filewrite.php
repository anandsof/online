<?php
   
   $today = date("D M j Y G:i:s");// Sat Mar 10 15:16 2001
   $file = "s$today.txt"; 

   //$file = "random.txt";
   //$j = 5; // No. of Random Numbers to be generated

   //open the file for appending
$submit = $_POST['submit'];
$startstring = $_POST['startstring'];
$randno = $_POST['randno'];
$j = $randno;
if($submit)
{ 
   if (!$file_handle_a = fopen($file,"a")) 
   {
   echo "Cannot open file"; 
   }  
   print("<b><center>$j Random Numbers From 100000 to 999999<br></b>");

   $random[1] = "";

   for($i = 1 ; $i <= $j; $i++) 
   { 
     $rand_present = 0; 
     $m = $i;
     $random_no = rand(100000,999999);
     //$random = "$startstring-$random";
     //print("$random");  
         
     //verify each number if is is present in the file here
     //$value_only_no = substr($value_entire,-4);
     
     if($i > 1)
     {
     for($n = 1 ; $n < $m; $n++) 
     {
        if($random_no == $random[$n])
        {          
          $rand_present = 1; 
          $i = $i - 1; 
        }
     }   
     }
 
     if($rand_present != 1)
     {  
         print("$random_no");
         print("<br>");
         $random[$i] = $random_no;
         $random_f = "$startstring-$random_no\n";
         if (!fwrite($file_handle_a, $random_f))
         {
          echo "Cannot write to file"; 
         }
      }
      else
      {
       print("The Random Number $random_no was already present and was  
       ignored<br>");   
      }  
        
 } 
   echo "$j Random numbers written to the file <b>$file</b><br>";   
   print("<a href=\"filewrite.php\">Generate Again</a></center>");
print<<<AAA
<script language="javascript">
location.href="dbasewrite.php?filename=$file";
</script>
AAA;
   fclose($file_handle_a);  
}
else
{
print<<<ENDL
<html>
<head>
<link REL=StyleSheet HREF="style.css" TYPE="text/css">
</head>
<body>
<p><center><i><strong><font face="arial" color="#999999" size="4">Random Number Generation</font></strong></i></p>
<hr size="1" color="#c0c0c0" width="75%" align="center">
<hr size="1" width="60%" noshade>
<br>
<form name="form" action="filewrite.php" method="POST">
<center><b><font color="203C70"></b></font></center>
<br>
<font color="203C70">
<table>
<tr>
<td class=label align="right">
No. Of Random Numbers:
</td>
<td>
<input type="text" name="randno">
</td>
</tr>
<tr>
<td class=label align="right">
Starting String:
</td>
<td>
<input type="text" name="startstring">
</td>
</tr>
<tr>
<td>
</td>
<td align="right">
<!--<input type="hidden" name="MAX_FILE_SIZE" value="30000"/>
-->
<input type="submit" name="submit" value="Generate">
</td>
</tr>
</table>
</form>
</font>
</body>
</html>
ENDL;
}
?> 
