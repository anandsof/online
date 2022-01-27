<?php 

include('config.inc');

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);


 $scoreid = $_POST['scoreid'];

$query =  mysqli_query($db_connect,"SELECT candidateID FROM scores WHERE scoreid = '$scoreid'");
 $ID = mysqli_fetch_row($query);

if (!$_POST['action'])
{
 $result =  mysqli_query($db_connect,"SELECT * FROM temp WHERE scoreid = '$scoreid'");
 while ($val = mysqli_fetch_row($result))
 {
  $res =  mysqli_query($db_connect,"INSERT INTO test (scoreid, questionid, marks, answer,markQuestion) VALUES ('$val[1]','$val[2]','$val[5]','$val[3]','$val[4]')");
 }
}
else
{
 $result =  mysqli_query($db_connect,"DELETE FROM scores WHERE scoreid = '$scoreid'");
}

$result =  mysqli_query($db_connect,"DELETE FROM temp WHERE scoreid = '$scoreid'");


header('Location: '."takeTest.php?ID=$ID[0]");
exit;
?>
