<?php
    session_start();
     // register global variables
    if ($_SESSION['userName'])
    {
    $userName = $_SESSION['userName'];
    $sess_id = $_SESSION['PHPSESSID'];
    }
 $naresh_sess = $_COOKIE['PHPSESSID'];

 $uname = $_GET['uname'];
 $activeid = $_GET['acid']; 
 include('config.inc');
 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);
//$result =  mysqli_query($db_connect,"DELETE FROM active WHERE activeid = '$activeid'");
#print("sessid -- $naresh_sess");
$result =  mysqli_query($db_connect,"UPDATE active set ndate = CURDATE(), ntime=now(), status='loggedout' WHERE value='$naresh_sess'");
// print("UserName = $userName <BR> Session ID = " . session_id());
    
    $_SESSION['userName'] = '';
    
    session_destroy(); 
    // setcookie('userName');
    $name = 'userName';
    setcookie($name, '', time()-43200);
    // setcookie('userName', '', time()-43200);
    // setcookie('userName', null, time()-3600);
    // setcookie('userName', '', time()-100);
    header("Location: index.html");
   
?>
