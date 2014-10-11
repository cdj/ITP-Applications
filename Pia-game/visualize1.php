<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<script>
var currentRound=1;
var currentRec=-1;
var lastEntry=-1;

function setUp()
{
	setInterval(function(){getEntry()},200);
}

function getEntry()
{
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var entry = xmlhttp.responseText;
			if(entry.length>0)
			{
				lastEntry++;
				var newDiv = document.createElement('div');
				newDiv.setAttribute('id',lastEntry);
				newDiv.innerHTML = entry;
				document.body.appendChild(newDiv);
				var lastrecstart=entry.lastIndexOf("id=\"num");
				lastrecstart+=7
				var lastrecend=entry.indexOf("\"",lastrecstart);
				currentRec=entry.substring(lastrecstart,lastrecend);
			}
		}
	}
	xmlhttp.open("GET","getEntry.php?curRound="+currentRound+"&curRec="+currentRec,true);
	xmlhttp.send();
}
</script>
</head>

<body bgcolor="#000000" text="#FFFFFF" onload="setUp()" style="font-family:Arial; font-size:30px;">
</body>
</html>
