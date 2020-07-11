<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Analysis</title>
	<style type="text/css">
		#one
		{
			top:20%;
			width:60%;
			left:25%;
			right:25%;
		}
	</style>
</head>
<body>
	<center>
		<div id="one">
			<h2><?php echo $_SESSION['year-sem'];?></h2>
			<img  width="80%">
		</div>
	</center>

	<script>
		function load()
		{
			//src="/FOE/common/Flask/DashBoard/III-I.png"
			var value=window.location.href;
			value=value.split("=");
			document.getElementsByTagName("img")[0].setAttribute("src","/FOE/DashBoard/"+value[1]+".png");
		}
		load();
	</script>
</body>
</html>