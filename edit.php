<?php
 include('cookie.php');
?>
<html>
<head>
 <title>brains@work</title>
  <meta name="author" content="Ravishankar Bhatia" />
<link REL=StyleSheet HREF="myStyle.css" TYPE="text/css">
</head>
<body>

<form method="post" action="">
<table width=100%>
<tr>
<td>
How many required questions do you want on this test?<br>
<input type="text" name="num_required" value="8" size="3" maxlength="4">
<br><br>
Enter test start date<br>
<table border="0">
 <tr>
  <td>Month</td>
  <td>Day</td>
  <td>Year</td>
 </tr>
 <tr>
  <td>
<select name="start_month">
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>9</option>
<option>10</option>
<option>11</option>
<option>12</option>
</select>
</td>
<td>
<select name="start_day">
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>9</option>
<option>10</option>
<option>11</option>
<option>12</option>
<option>13</option>
<option>14</option>
<option>15</option>
<option>16</option>
<option>17</option>
<option>18</option>
<option>19</option>
<option>20</option>
<option>21</option>
<option>22</option>
<option>23</option>
<option>24</option>
<option>25</option>
<option>26</option>
<option>27</option>
<option>28</option>
<option>29</option>
<option>30</option>
<option>31</option>
</select>
</td>
<td>
<select name="start_year">
<option>2002</option>
<option>2003</option>
<option>2004</option>
</select>
</td>
</tr>
</table>
<br><br>
Enter test end date<br>
<table border="0">
 <tr>
  <td>Month</td>
  <td>Day</td>
  <td>Year</td>
 </tr>
 <tr>
  <td>
<select name="end_month">
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>9</option>
<option>10</option>
<option>11</option>
<option>12</option>
  </select>
</td>
<td>
<select name="end_day">
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>9</option>
<option>10</option>
<option>11</option>
<option>12</option>
<option>13</option>
<option>14</option>
<option>15</option>
<option>16</option>
<option>17</option>
<option>18</option>
<option>19</option>
<option>20</option>
<option>21</option>
<option>22</option>
<option>23</option>
<option>24</option>
<option>25</option>
<option>26</option>
<option>27</option>
<option>28</option>
<option>29</option>
<option>30</option>
<option>31</option>
</select>
</td>
<td>
<select name="end_year">
<option>2002</option>
<option>2003</option>
<option>2004</option>
</select>
</td>
</tr>
</table>
<br><br>
<input type="hidden" name="examid" value="">
<input type="submit" name="submit" value="Submit!">
  </td>
  </tr>
</table>
</form>

</body>
</html>
