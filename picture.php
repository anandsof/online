<?php
 include('config.inc');

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

 $imageid = $_GET['imageid'];

    if (isset($imageid)) 
    {
        $result = mysqli_query($db_connect,"SELECT filetype, filename FROM images WHERE imageid = $imageid");

        if ($row = mysqli_fetch_row($result))
        {
            header("Content-type: $row[0]");
	    $data = fread(fopen("images/".$row[1],"r"), filesize("images/".$row[1]));

	    echo "$data";
        } else
        {
            echo "ERROR INVALID IMAGE";
        }

    }
    else
    {
        echo "ERROR NO Image ID";
    }
?>
