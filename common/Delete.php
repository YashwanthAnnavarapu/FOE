<?php
session_start();
if(!isset($_SESSION['admin_username']))
	header("Location: index.php");
?>
<html>
<title>Delete.php</title>
	<style>
		#one
		{
			//top:10%;
			//left: 15%;
			width:70%;
			
			background-color: #FF0000;
			border-radius: 10px;
			padding:10px 10px 10px 10px;
			//position: absolute;
		}
		#two
		{
			border:none;
			//top:20%;
			//left: 10%;
			width:70%;
			//height:7%;
			//position: absolute;


		}
		#three
		{
			//top:40%;
			//left: 10%;
			width:90%;
			overflow:auto;
			//height:7%;
			//position: absolute;
		}
		#rollno_field
		{
			width:97%;
			padding:10px;
			font-size:20px;
			border-radius: 10px;
		}
	</style> 

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src = "http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.1.min.js"></script>
</head>
<script src='delete.js'>

</script>
<body style="background: #f1f1f1;">
	
	<center>
		<h1><?php echo $_SESSION['year-sem'];?></h1>
		<br><br><br>

		<form method="post" action="">
			<div id="one">
						<input type="text" name=""  placeholder="Roll Number" id="rollno_field">
						<br><br>
						<table>
							<tr><td>
								<input type="radio" id="radio_btn_response" name="radio_btn_response" checked="checked" 
								style="margin: 0 5px 0 30px;">Clear Response
							</td>
							<td>
								<input type="radio" id="radio_btn_response" name="radio_btn_response" style="margin: 0 5px 0 30px;" 
								>Remove Student Details Permanentely
							</td></tr>
						</table>
			</div>
			<div id="two">
				<br>
				<table>
					<tr>
						<th><input type="button" name="find" Value="SEARCH" style="padding:10px;font-size:20px;border-radius:10px" onclick="search()" class='btn btn-primary'></th>
					</tr>
				</table>
			</div>
		</form>
		<div id="three">
		</div>
	</center>
</body>
</html>