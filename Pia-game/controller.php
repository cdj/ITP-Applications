<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<?php
include 'getRound.php'; 
$nextRound=$_GET["nextRound"];

$con = mysql_connect("localhost","ypz201","****");
if (!$con)
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("ypz201", $con);

?>
</head>
<body style="font-size: x-large">
<?php
if(is_numeric($nextRound))
{
	if($nextRound==0)
	{
		// mark all rounds complete
		mysql_query("REPLACE INTO rounds SET round=0, word='game over', complete=1");
		echo "<h1>Game Over</h1>";
	}
	elseif(($currentRound+1)==$nextRound)
	{
		mysql_query("REPLACE INTO rounds SET round=".($currentRound+1).", word='next round', complete=0");
		mysql_query("REPLACE INTO rounds SET round=".$currentRound.", word='finished round', complete=1");
		echo "<h1>Moved on to next round</h1>";
	}
	mysql_close($con);
}
else
{
?><h1>Current Round: <?php echo $currentRound; ?></h1><?php
}
?>
	<br/>
	<br/>
	<a href="controller.php?nextRound=<?php echo $currentRound+1; ?>">New Round</a>
	<br/>
	<br/>
	<br/>
	<a href="controller.php?nextRound=0">End Game</a>
</body>
</html>
