<?php
 include('config.inc');

  $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

  $scoreid = $_POST['scoreid'];
  $questionid = $_POST['questionid'];

   $result= mysqli_query($db_connect,"SELECT * FROM question WHERE questionid = '$questionid'");
 while ($row = mysqli_fetch_row($result))
 {
  $i = 1;
  for ($col = 2 ; $col <= 7 ; $col++)
  {
     if ($row[$col])
     {
	if($row[14] == 'dd') 
      	{
        	$match = explode(" -1-1-1- ",$row[$col]);
        	$Q[$i] = $match[0];
        	$A[$i] = $match[1];
		$j = $i - 1;
		$dd = dd.$j;
                $drop1[$j] = $_POST[$dd];
                $i++;
      	}
     }
   } 
 }
  

 // $dd = $_POST['dd'];

  if ($drop1)
  {
    if (is_array($drop1))
    {
     reset ($drop1);
     while ( list($key, $value) = each($drop1))
     {
      $match = explode("-",$value);
        	$drop[$match[0]] = $match[1];
	print($drop[$match[0]]." = ".$match[1]."<BR>");
     }
    }
    else 
      print(" $dd");
  }   
 
for($i = 1, $a = 'a' ; $i <= count($drop) ; $i++, $a++)
{
 if ($drop[$i])
 {
  $choice[$i] = $Q[$i];
  $choice[$i] .= " -1-1-1- ";
  $choice[$i] .= $drop[$i];
 }
}

  $query = mysqli_query($db_connect,"INSERT INTO dragdrop (scoreid, questionid,choice1, choice2, choice3, choice4, choice5, choice6) VALUES ('$scoreid','$questionid','$choice[1]','$choice[2]','$choice[3]','$choice[4]','$choice[5]','$choice[6]' )");
  if(mysqli_affected_rows())
  {
    $query = mysqli_query($db_connect,"UPDATE dragdrop set
                 scoreid = '$scoreid',
                 choice1 = '$choice[1]',
                 choice2 = '$choice[2]',
                 choice3 = '$choice[3]',
                 choice4 = '$choice[4]',
                 choice5 = '$choice[5]',
                 choice6 = '$choice[6]' 
                WHERE questionid = '$questionid' AND scoreid = '$scoreid'");
   }

   $result = mysqli_query($db_connect,"UPDATE temp SET 
	       answer = 'Yes'
            WHERE scoreid = '$scoreid' and questionid = '$questionid'");

print <<< DRAG
<script Language="javascript">	
	parent.close();
</script>
DRAG;
?>
