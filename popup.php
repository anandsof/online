<?php
$answer = $_GET['answer'];
$feedback = $_GET['feedback'];
print<<<AAA
<body>
<html><body><table>
AAA;
if($answer)
{
print<<<BBB
<tr>
<td width="160" align="right" valign="bottom">
<b>The Correct Answer is:</b>
</td>
<td>
$answer
</td>
</tr>
BBB;
}
if($feedback)
{
print<<<CCC
<tr>
<td width="160" align="right" valign="bottom">
<b>Feedback:</b>
</td>
<td>
$feedback
</td>
</tr>
CCC;
}
print<<<DDD
<tr>
<td>
</td>
<td align="right">
<a href="javascript:history.go(-1)">Go back</a>
</td>
</tr>
</table>
</body>
</html>
DDD;
?>