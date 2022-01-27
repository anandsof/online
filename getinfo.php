<?php
 include('config.inc');

  $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

  $result = mysqli_query($db_connect,"select MAX(questionid) from question");
  $row = mysqli_fetch_row($result);
  $groupName = $row[0];
  echo $groupName;

?>
