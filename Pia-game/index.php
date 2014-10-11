<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<style type="text/css">
.Round {
	font-family: Arial;
	font-size: 159px;
}
Round {
	font-family: Arial;
}
body p {
	font-family: Arial;
}
body {
	background-image: url();
	background-repeat: repeat;
	font-size: xx-small;
	background-color: #231f20;
}
.Round strong {
	font-size: 159px;
}
body,td,th {
	color: #FFF;
}
.kengdie {
	margin-top: -170px;
}
.inputRound {
	display: inline;
	width: 665px;
	height: 55px;
	margin-left: 10px;
	font-size: 30px;
	
}
.inputSubmit {
	display: inline;
	font-size: 50px;
	background: #231f20;
	color: #ffffff;
	width: 220px;
	height: 90px;
	margin-left: 10px;
	padding-top: 30px;
	border: none;
}

</style>
<body>

<div align="left">
  <?php include 'getRound.php'; ?>
  <?php
if($currentRound==0)
{
	echo "Game over!";
}
else
{
?>
</div>
<form action="insert.php" method="post">
  <h2 align="left" class="Round"><strong>Round</strong> <?php echo $currentRound; ?>:</h2>

	<div class="kengdie">
		<input type="text" name="field" class="inputRound" id="inputRound" max="140"/>
		<input type="hidden" name="round" value="<?php echo $currentRound; ?>" />
	    <input type="submit" class="inputSubmit" value ="SUBMIT"/>
	</div>
</form>
<div align="left">
  <?php
}
?>
</div>
<script type="text/JavaScript">
	document.getElementById('inputRound').focus();
</script>
</body>
</html>