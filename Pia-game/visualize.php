<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<script>
var currentRound=1;
var currentRec=-1;
var lastEntry=-1;
var numRecs=0;
var scrollPosition=1;
var scrollingId;
var getEntryId;
var getRoundId;

function setUp()
{
	getRound();
	document.getElementById("messages").style.top = window.innerHeight/2-15;
	scrollingId = setInterval(function(){textScroller()},400);
	getEntryId = setInterval(function(){getEntry()},500);
	getRoundId = setInterval(function(){getRound()},1000);
}

function textScroller()
{
	numRecs=document.getElementById("messages").childNodes.length;
	if(numRecs>scrollPosition)
	{
		document.getElementById("messages").style.top=(window.innerHeight/2-15)-(30*scrollPosition);
		scrollPosition++;
		document.getElementById("messages").childNodes[scrollPosition-1].className="entry";
		document.getElementById("messages").childNodes[scrollPosition].className="entryHighlight";
	}
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
                                var isFirst=false;
                                if (document.getElementById("messages").childNodes.length==0)
                                {
                                    isFirst=true;
                                }
				lastEntry++;
				document.getElementById("messages").innerHTML += entry;
				//var newDiv = document.createElement('div');
				//newDiv.setAttribute('id',lastEntry);
				//newDiv.innerHTML = entry;
				//document.body.appendChild(newDiv);
				var lastrecstart=entry.lastIndexOf("id=\"num");
				lastrecstart+=7;
				var lastrecend=entry.indexOf("\"",lastrecstart);
				currentRec=entry.substring(lastrecstart,lastrecend);
                                if(isFirst)
                                {
                                    document.getElementById("messages").childNodes[0].className="entryHighlight";
                                }
			}
		}
	}
	xmlhttp.open("GET","getEntry.php?curRound="+currentRound+"&curRec="+currentRec,true);
	xmlhttp.send();
}

function getRound()
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
			var newRound = xmlhttp.responseText;
			
			//currentRound = xmlhttp.responseText;
			
			if(!isNaN(parseFloat(newRound)) && isFinite(newRound) && newRound!="")
			{
				if(newRound>currentRound)
				{
					document.getElementById("messages").innerHTML = "";
					currentRec=-1;
					lastEntry=-1;
					document.getElementById("messages").style.top = window.innerHeight/2-15;
					currentRound=newRound;
				}
				else
				{
					if(newRound==0)
					{
						currentRound=newRound;
						clearInterval(scrollingId);
						clearInterval(getEntryId);
						clearInterval(getRoundId);
						document.getElementById("messages").innerHTML = "Game Over";
						document.getElementById("messages").style.top = window.innerHeight/2-15;
					}
				}
			}
		}
	}
	xmlhttp.open("GET","currentRound.php",true);
	xmlhttp.send();
}
</script>
<style>
    #messages
    {
        position: absolute;
        text-align: center;
        width: 100%;
        font-family: Arial;
    }
    .entry
    {
        font-size: 30px;
    }
    .entryHighlight
    {
        font-size: 45px;
    }
    body
    {
	background-color: #231f20;
    }
</style>
</head>

<body text="#FFFFFF" onload="setUp()">
	<div id="messages"></div>
</body>
</html>
