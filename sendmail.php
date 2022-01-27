<?php
$totalamt = $_POST['answer'];
$name=$_POST['T1'];
$email=$_POST['email'];
$phone=$_POST['P1'];

if (isset($_POST['num[0]']))
 {
$product1=1;
}
else
$product1=0;

if (isset($_POST['num[1]']))
 {
$product2=1;
}
else
$product2=0;


$p1=$_POST['num[0]'];
if($p1)
{
echo("hello");
}

echo($name);
echo("<br>");
echo($email);
echo("<br>");
echo($phone);
echo("<br>");
echo($totalamt);
echo("<br>");
echo("p1");
echo($p1);
?>
