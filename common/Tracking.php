<?php
session_start();
if(!isset($_SESSION['admin_username']) && !isset($_SESSION['mgmt_username']))
	header("Location: /FOE/index.html");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Track No Of Seats</title>
	<script type="text/javascript" src="tracking.js"></script>
	<script type="text/javascript">
		function hello()
		{
			alert();
			document.getElementById('student-16911A0505').innerHTML="MY choice";
		}
	</script>
	<style type="text/css">
		#track
		{
			width:80%;
		}
	</style>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div>
		<center><u><h2>Track Number of Seats Available<?php echo ":".$_SESSION['year-sem']?></h2></u></center>
	</div>
	<br><br>
	<center>
		<div id='track'>
			
		</div>
	</center>
</body>
</html>