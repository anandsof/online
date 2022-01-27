<?php
 include('cookie.php');
?>
<html>
<head>
<title>brains@work - Online Test</title>
</head>

<?php
 $ID = $_GET['ID'];

print <<< INDEX
<frameset  cols=220,100% border=0 frameSpacing=0 frameBorder=0>
   <frame name=left src="left.php?ID=$ID" noResize scrolling=no target="main">
<frame name=main src="takeTest.php?ID=$ID" noResize target="_self">
</frameset>

INDEX;

?>


<NOFRAMES>
<body>
  <p>This page uses frames, but your browser doesn't support them.<P>
   Maybe this is a good time to upgrade your browser!
  </body>
</NOFRAMES>

</HTML>
