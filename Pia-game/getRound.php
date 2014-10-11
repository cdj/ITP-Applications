<?php

$con = mysql_connect("localhost","ypz201","pIfT+iAaceh");
if (!$con)
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("ypz201", $con);

// get rounds
$sql="SELECT * FROM rounds ORDER BY round ASC";
$result = mysql_query($sql);

// if game over, return game over
$row = mysql_fetch_array($result);
$currentRound=0;
if($row['round']==0 && $row['complete'])
{
        //echo "game over";
}
else
{
    if($row['round']==0)
    {
        $row = mysql_fetch_array($result);
    }
    do
    {
        // for each round, check if round complete
        if($row['complete'])
        {
            //  if yes, loop for next round
            $currentRound=0;
        }
        else
        {
            //// if no, check to see if word exists
            //// logic for checking if complete
            //$sql1="SELECT * FROM game WHERE round=".$row['round']." AND field LIKE '".$row['word']."'";
            //$result1 = mysql_query($sql);
            //$numrows= mysql_num_rows ($result1);
            //
            //if($numrows>0)
            //{
            //    // if complete, set current round to 0 and update round completion status
            //    $currentRound=0;
            //    mysql_query("UPDATE rounds SET complete=1 WHERE round=".$row['round']);
            //}
            //else
            //{
                // if not, this is the current round
                $currentRound=$row['round'];
                break;
            //}
            
        }
    }
    while($row = mysql_fetch_array($result));
    
    if($currentRound==0)
    {
        // if no more rounds, set and return game over
        //echo "game over";
        mysql_query("REPLACE INTO rounds SET round=0, word='game over', complete=1");
    }
    else
    {
        //echo $currentRound;
    }
}
mysql_close($con);
?>