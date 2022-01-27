<?php
   session_start();
    // register global variables
    print("hello");
    if ($_SESSION['userName'])
    {
      $userName = $_SESSION['userName'];
      $_SESSION['userName'] = $userName;
      print(" hello ---- $userName");
    }
    else
     {
       print("hai ---- $userName");
       exit;
       header("Location: index.php"); 
       
     }
    if (isset($_COOKIE['userName']))
     {
       print("hi3333 ---- $value  ------ $userName");
       exit; 
       $value = unserialize(base64_decode($_COOKIE['userName']));
     
     }
    else
     {
     print("hai444 ---- $userName");
     exit;
     header("Location: index.php"); 
     }
?>
