<!doctype HTML>
<html>
<head>
	<style>
		body{
			background-size:100% 100%;
			background-repeat:norepeat;
			color: black;
			font:"Berlin Sans FB Demi";
			margin:0;
		}		
		#image{
			position:fixed;
			width:1500px;
			top:0;
			height:auto;
			z-index:2;
			opacity:1;
			animation: text 15s linear 1;
			animation-fill-mode: forwards;
			transform: scale(1);
			animation-delay:18s;
		}
		.bits{
			font-fanily: "Berlin Sans FB Demi";
			display: inline-block;
		}
		.tilt{
			background-color:rgb(4,71,150);
			color: rgb(202,242,254);
			font-size:12.5px;
			line-height:12.5px;
			position:fixed;
			top:180px;
			left:430px;
			width:530px;
			transform: skew(20.5deg,-8.7deg);
		}
	</style>
</head>
<body>
<img src='images/blink.png' id='image'>
<div class='tilt'>
<?php
	for ($i=1;$i<=2800;$i++){
		$r=rand(0,10);
		echo "<div id='m$i' class='bits'>" . (($r<6)?"0":"1") . "</div>";
	}
?>
</div>
<script>
setInterval(function(){changeNow()}, 50);

function changeNow(){
	var r1;
	var r2;
	for (var i=1; i<=500; i++){
		r1=Math.round(Math.random()*2798)+1;
		r2=Math.round(Math.random()*10);
		document.getElementById('m'+r1).innerHTML=((r2<6)?"0":"1");
	}
}
</script>
</body>
</html>

