<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<body>
<h1 style="font-family: Arial; font-size: 150px">
<?php

// sanitize inputs!
$inputField = htmlspecialchars($_POST[field]);
$inputRound = htmlspecialchars($_POST[round]);

if(is_numeric($inputRound))
{
	include 'getRound.php';
	
	$con = mysql_connect("localhost","ypz201","pIfT+iAaceh");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db("ypz201", $con);
	
	if($currentRound==0)
	{
		// if game over, return game over
		echo "Game over!";
	}
	else
	{
		if($currentRound>$inputRound)
		{
			// check round is complete
			echo "Sorry, round ".$inputRound." is over!";
		}
		else
		{
			$sql="SELECT * FROM rounds WHERE round='".$inputRound."'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			if($row['complete'])
			{
				//  if yes, return error
				echo "Sorry, round ".$inputRound." is over!";
			}
			else
			{
				// check if it is the right word
				//if(strcasecmp($inputField,$row['word']))
				//{
				//	//  if yes, set round complete, return success
				//	if(mysql_query("UPDATE rounds SET complete=1 WHERE round=".$row['round'],$con))
				//	{
				//		die('Error: ' . mysql_error());
				//	}
				//	echo "Congratulations, you guessed correctly!";
				//}
				//else
				//{
				//	//  if no, return try again
				//	"Sorry, try again!";
				//}
				$sql="INSERT INTO game (field, round) VALUES ('".$inputField."', '".$inputRound."')";
				
				if (!mysql_query($sql,$con))
				{
					die('Error: ' . mysql_error());
				}
				else
				{
					echo "Thanks!";
				}
			}
		}
	?>
	<script type="text/JavaScript">
		window.setTimeout("location=('index.php');",3000);
	</script>
	<?php
	}
}
mysql_close($con);
?>
</h1>
</body>
</html>
