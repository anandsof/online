<?php
$submit = $_POST['submit'];
$c1 = $_POST['C1'];
if($submit)
{
print("in submit <br>");
if($c1)
{
print("checked yar");
}
else
{
print("not checked yar");
}
}
else
{
print<<<AAA
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title>New Page 1</title>
<script language="javascript">
function validate()
{
if(document.form.C1.checked)
{
alert("checked yar");
}
else
{
alert(" not checked yar");
}
}
</script>
</head>
<body>
<html>
<form name="form" method="POST" action="example_check.php">
<p><input type="checkbox" name="C1">
<input type="submit" value="Submit" name="submit"><input type="reset" value="Reset" name="B2"></p>
</form>
&nbsp;
<p><!-- <br>
<p align="right"><font color=BLACK>&copy; anandsoft.com</font></p> -->
<p>
AAA;
}
?>
</body>
