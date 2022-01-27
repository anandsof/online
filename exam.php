<?php
 include('cookie.php');
?>
<html>
<head>
<title></title>
</head>

<?php
 $scoreid = $_GET['scoreid'];
 $examid = $_GET['examid'];
 $action = $_GET['action'];
?>

<frameset framespacing="0" frameborder="0" border="false" rows="35,*,25">
  <frame name="ExamScreenTop" scrolling="no" noresize src="TestScreenTop.php?<?php print("scoreid=$scoreid&examid=$examid&action=$action") ?>"
  marginwidth="0" marginheight="0" target="_self">
  <frame name="QuestionScreen" bordercolor="black" scrolling="auto" src="QuestionScreen.php?<?php print("scoreid=$scoreid&examid=$examid&action=$action") ?>" marginwidth="5"
  marginheight="5">
  <frame name="QuestionScreen" scrolling="no" src="bottom1.html">
  <noframes>

  <body>
  <p>This page uses frames, but your browser doesn't support them.</p>
  </body>
  </noframes>
</frameset>
</html>
