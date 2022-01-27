<?php
   session_start();
    // register global variables
    if ($_SESSION['userName'])
    {
      $userName = $_SESSION['userName'];
      $_SESSION['userName'] = $userName;
    }
    else
      header("Location: index.php"); 

    if (isset($_COOKIE['userName']))
     {
       $value = unserialize(base64_decode($_COOKIE['userName']));
     }
    else
     header("Location: index.php"); 
?>
