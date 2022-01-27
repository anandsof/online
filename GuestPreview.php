<?php
  session_start();
  $name = "userName";
  $value = "Guest";
  session_register($name);
  $cookie = base64_encode(serialize($value));
  setcookie($name, $cookie, time()+43200);
?>
<html>
<head>
<title>brains@work-Online Test</title>
  <meta name="author" content="Ravishankar Bhatia">
 <meta name="copyright" content="Anandsoft.com">

<script type="text/javascript">

var columntype=""
var defaultsetting=""

function getCurrentSetting(){
if (document.body)
return (document.body.cols)? document.body.cols : document.body.rows
}

function setframevalue(coltype, settingvalue){
if (coltype=="rows")
document.body.rows=settingvalue
else if (coltype=="cols")
document.body.cols=settingvalue
}
function resizeFrame(contractsetting){
if (getCurrentSetting()!=defaultsetting)
setframevalue(columntype, defaultsetting)
else
setframevalue(columntype, contractsetting)
}

function init(){
if (!document.all && !document.getElementById) return
if (document.body!=null){
columntype=(document.body.cols)? "cols" : "rows"
defaultsetting=(document.body.cols)? document.body.cols : document.body.rows
}
else
setTimeout("init()",100)
}
setTimeout("init()",100)
</script>

</head>

<?php
 $ID = 2;
 $uname = 'Guest';
 print <<< INDEX
<frameset  cols="220,100%"  border=0 frameSpacing=0 frameBorder=0>
   <frame name=left scrolling="auto" src="Guestleft.php?ID=$ID&uname=$uname" noResize scrolling=no target="main">
<frame name=main src="Guest_takeTest.php?ID=$ID" noResize target="_self">
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
