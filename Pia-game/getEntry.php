<?php
$currentround=$_GET["curRound"];
$currentrecord=$_GET["curRec"];
$con = mysql_connect("localhost","ypz201","pIfT+iAaceh");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("ypz201", $con);
//$result = mysql_query ("SELECT MAX(num) AS largestNum FROM game");
//$row= mysql_fetch_array ($result);
//$numrows=$row['largestNum'];
//do
//{
    $sql="SELECT * FROM game WHERE num>".$currentrecord." AND round=".$currentround." ORDER BY num ASC";
    $result = mysql_query($sql);
    $numresults=mysql_num_rows($result);
//}
//while($numresults==0);


while($row = mysql_fetch_array($result))
{
    echo "<div class=\"entry\" id=\"num".$row['num']."\">";
    echo $row['field'];
    echo "</div>";
}

mysql_close($con);
?>