<html>

<head>
<title>Editing Subscription</title>
<meta name="GENERATOR" content="Arachnophilia 4.0">
<meta name="FORMATTER" content="Arachnophilia 4.0">
</head>

<body bgcolor="#ffffff" text="#000000" link="#0000ff" vlink="#800080" alink="#ff0000">
<?
$datahost = "localhost";
$datauser = "certexam";
$datapasswd = "Exban01";
$base = "certexams_com_-_online";
 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

$page_name="editsubscription.php"; //  If you use this code with a different page ( or file ) name then change this 
$start=$_GET['start'];
if(strlen($start) > 0 and !is_numeric($start)){
echo "Data Error";
exit;
}


$eu = ($start - 0); 
$limit = 100;                                 // No of records to be shown per page.
$this1 = $eu + $limit; 
$back = $eu - $limit; 
$next = $eu + $limit; 


/////////////// WE have to find out the number of records in our table. We will use this to break the pages///////
$query2=" SELECT * FROM candidate  ";
$result2=mysqli_query($db_connect,$query2);
echo $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);_error();
$nume=$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);_num_rows($result2);
/////// The variable nume above will store the total number of records in the table////

/////////// Now let us print the table headers ////////////////

echo "<TABLE width=70% align=center  cellspacing=1 cellpadding=4 border=1> <tr>";
echo "<td>&nbsp;<font face='arial,verdana,helvetica' color='#000000' size='3'><center><b>CandidateID</b></center></font></td>";
echo "<td>&nbsp;<font face='arial,verdana,helvetica' color='#000000' size='3'><center><b>Name</b></center></font></td>";
echo "<td>&nbsp;<font face='arial,verdana,helvetica' color='#000000' size='3'><center><b>Edit</b></center></font></td></tr>";

////////////// Now let us start executing the query with variables $eu and $limit  set at the top of the page///////////
$query=" SELECT * FROM candidate  limit $eu, $limit ";
$result=mysqli_query($db_connect,$query);
echo $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);_error();

//////////////// Now we will display the returned records in side the rows of the table/////////
while($noticia = $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);_fetch_array($result))
{

echo "<tr >";
echo "<td align=left id='title'>&nbsp;<font face='Verdana' size='2'>$noticia[candidateID]</font></td>"; 
echo "<td align=left id='title'>&nbsp;<font face='Verdana' size='2'>$noticia[firstName] $noticia[lastName]</font></td>"; 
echo "<td align=left id='title'>&nbsp;"; 
print "<a href='editsubscrip.php?candidateID=$noticia[candidateID]'><font face='Verdana' size='2'>Edit</font></a>";
echo "</td></tr>";
}
echo "</table>";
////////////////////////////// End of displaying the table with records ////////////////////////

/////////////////////////////// 
if($nume > $limit ){ // Let us display bottom links if sufficient records are there for paging

/////////////// Start the bottom links with Prev and next link with page numbers /////////////////
echo "<table align = 'center' width='50%'><tr><td  align='left' width='30%'>";
//// if our variable $back is equal to 0 or more then only we will display the link to move back ////////
if($back >=0) { 
print "<a href='$page_name?start=$back'><font face='Verdana' size='2'>PREV</font></a>"; 
} 
//////////////// Let us display the page links at  center. We will not display the current page as a link ///////////
echo "</td>";


echo "<td  align='right' width='30%'>";
///////////// If we are not in the last page then Next link will be displayed. Here we check that /////
if($this1 < $nume) { 
print "<a href='$page_name?start=$next'><font face='Verdana' size='2'>NEXT</font></a>";} 
echo "</td></tr></table>";

}// end of if checking sufficient records are there to display bottom navigational link. 
?>

</body>

</html>
