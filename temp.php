<?php 

include('config.inc');

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);


 $examid = $_GET['examid'];
 $cid = $_GET['cid'];
 $randQ = $_GET['randQ'];

 if ($action = $_GET['action'])
 {
  $start = $_GET['start'];
  $end = $_GET['end'];
 }

 $result =  mysqli_query($db_connect,"INSERT INTO scores (scoreid, candidateID, examid, date, time) VALUES (NULL, '$cid', '$examid', CURDATE(), CURTIME())");

  $query = mysqli_query($db_connect,"SELECT LAST_INSERT_ID()");
  $row = mysqli_fetch_row($query);
  $scoreid = $row[0];

  $result =  mysqli_query($db_connect,"SELECT questions FROM exam WHERE examid='$examid'");
  $row = mysqli_fetch_row($result);
  $questions = $row[0];

 $result =  mysqli_query($db_connect,"SELECT questionid FROM question WHERE examid='$examid' and question.used = 1 order by questionid");

        $count = 0;

        // put the question_ids of each question into an array

        while ($row = @mysqli_fetch_object($result))
        {
            $q[++$count] = $row->questionid;
        }

	// If user selected for random Questions
	if ($randQ == "true") 
	{

        // initialize random number check array
        $check = array();


        // for each question
        for ($i = 1; $i <= $count; $i++)
        {
            do {
                $flag = FALSE;

                // get a random number between 1 and $count
                    $rand = mt_rand(1, $count);

                // iterate through our hash array to make sure the number hasn't already been picked
                foreach($check as $value)
                {
                    // if it has...
                    if ($value == $rand)
                    {
                    // go through the loop again and pick another number
                        $flag = TRUE;
                        break;
                    }
                }
            } while ($flag);

  // hash the picked number in the $check array so it can be checked for future iterations
            $check[$i] = $rand;

            // store the question id in an array

           $ques[$i] = $q[$rand];
     }
    }// End of if randQ
    else 
    {
	 for($i = 1 ; $i <= $count ; $i++)
         {
            $ques[$i] = $q[$i];
         }
    }


 if($start && $end)
  ;
 else 
  {   $start = 1;  $end = $questions; }
     
  for ($i = $start; $i <= $end ; $i++)
  {
     $result =  mysqli_query($db_connect,"insert into temp (sno, scoreid, questionid,answer, markQuestion ) values (NULL,'$scoreid','$ques[$i]','','')");
  }

  header('Location: '."exam.php?scoreid=$scoreid&examid=$examid&action=$action");
 exit;
?>

