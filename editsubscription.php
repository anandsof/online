<html>

<head>
<title>Editing Subscription</title>
<meta name="GENERATOR" content="Arachnophilia 4.0">
<meta name="FORMATTER" content="Arachnophilia 4.0">
</head>

<body bgcolor="#ffffff" text="#000000" link="#0000ff" vlink="#800080" alink="#ff0000">
<?
include('config.inc');

$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

$page_name="editsubscription.php";  
$start=$_GET['start'];
if(strlen($start) > 0 and !is_numeric($start)){
echo "Data Error";
exit;
}


$eu = ($start - 0); 
$limit = 100;                                 
$this1 = $eu + $limit; 
$back = $eu - $limit; 
$next = $eu + $limit; 



$query2=" SELECT * FROM candidate  ";
$result2=mysqli_query($db_connect,$query2);
//echo mysqli_error();
$nume=mysqli_num_rows($result2);


echo "<TABLE width=70% align=center  cellspacing=1 cellpadding=4 border=1> <tr>";
echo "<td>&nbsp;<font face='arial,verdana,helvetica' color='#000000' size='3'><center><b>CandidateID</b></center></font></td>";
echo "<td>&nbsp;<font face='arial,verdana,helvetica' color='#000000' size='3'><center><b>Name</b></center></font></td>";
echo "<td>&nbsp;<font face='arial,verdana,helvetica' color='#000000' size='3'><center><b>Edit</b></center></font></td></tr>";

$query=" SELECT * FROM candidate  limit $eu, $limit ";
$result=mysqli_query($db_connect,$query);


while($noticia = mysqli_fetch_array($result))
{

echo "<tr >";
echo "<td align=left id='title'>&nbsp;<font face='Verdana' size='2'>$noticia[candidateID]</font></td>"; 
echo "<td align=left id='title'>&nbsp;<font face='Verdana' size='2'>$noticia[firstName] $noticia[lastName]</font></td>"; 
echo "<td align=left id='title'>&nbsp;"; 
print "<a href='editsubscrip.php?candidateID=$noticia[candidateID]'><font face='Verdana' size='2'>Edit</font></a>";
echo "</td></tr>";
}
echo "</table>";


if($nume > $limit ){


echo "<table align = 'center' width='50%'><tr><td  align='left' width='30%'>";

if($back >=0) { 
print "<a href='$page_name?start=$back'><font face='Verdana' size='2'>PREV</font></a>"; 
} 
echo "</td>";


echo "<td  align='right' width='30%'>";

if($this1 < $nume) { 
print "<a href='$page_name?start=$next'><font face='Verdana' size='2'>NEXT</font></a>";} 
echo "</td></tr></table>";

} 
?>

</body>

</html>
