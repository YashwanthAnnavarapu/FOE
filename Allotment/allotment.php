<html>
<head>
	<title>Open Elective Allotment</title>
	<link rel="stylesheet" href="allotment.css">
	<script>
		window.onload = function show()
		{
			<?php
				session_start();
				include_once '../Database/dbconnect_year_sem.php';
				$conn=connect_ys();	
				if(isset($_COOKIE['rollno']))
				{
					if($conn)
					{
						$query="select * from alloted_student_details where rollno='".$_COOKIE['rollno']."'";
						$query_map="select * from track_no_of_seats";

						$res=mysqli_query($conn,$query);
						$res_map=mysqli_query($conn,$query_map);

						while($row_map=mysqli_fetch_assoc($res_map))
							$subject[$row_map['nickname']]=$row_map['subject_name'];

						if($row=mysqli_fetch_assoc($res))
						{
							echo "document.getElementById('rollno').innerHTML='".$row['rollno']."';".
								  "document.getElementById('name').innerHTML='".$row['name']."';".
								  "document.getElementById('branch').innerHTML='".$row['department']."';".
								  "document.getElementById('sub_allot').innerHTML='".$subject[$row['subject_allocated']]."';".
								  "document.getElementById('priority1').innerHTML='1.".$subject[$row['p1']]."';".
								  "document.getElementById('priority2').innerHTML='2.".$subject[$row['p2']]."';".
								  "document.getElementById('priority3').innerHTML='3.".$subject[$row['p3']]."';".
								  "document.getElementById('priority4').innerHTML='4.".$subject[$row['p4']]."';".
								  "document.getElementById('priority5').innerHTML='5.".$subject[$row['p5']]."';".
								  "document.getElementById('priority6').innerHTML='6.".$subject[$row['p6']]."';".
								  "document.getElementById('priority7').innerHTML='7.".$subject[$row['p7']]."';".
								  "document.getElementById('priority8').innerHTML='8.".$subject[$row['p8']]."';".
								  "document.getElementById('priority9').innerHTML='9.".$subject[$row['p9']]."';"
							;	
						}
					}
					else
						echo "alert('There is a Problem');";
				}
				else
					header("Location: index.php");
			?>
		}

	</script>
	
</head>
<body>
	<div id="one">
		<fieldset>
				<center>
							<div><img src="vjit-logo.png" width="100%" style="border-radius: 10px;"></img></div>
							<br>
							<div><img src="oea.png" width="100%"></img></div>
							<br>
						<div id='two'>
<table width='95%' class="bg-pad1">
	<tr>
		<td width='40%'>
			<table>
				<tr><th class="label-style">ROLLNO</th></tr>
				<tr><th class="label-style">NAME</th></tr>
				<tr><th class="label-style">BRANCH</th></tr>
				<tr><th class="label-style">SUBJECT ALLOTED</th></tr>
			</table>
		</td>
		<td>
			<table>
				<tr><td class="label-style" id='rollno'></td></tr>
				<tr><td class="label-style" id='name'></td></tr>
				<tr><td class="label-style" id='branch'></td></tr>
				<tr><td class="label-style" id='sub_allot'></td></tr>
			</table>
		</td>
	</tr>
	<tr >
		<td valign="top">
			<table>
				<tr><th width="250px"  class="label-style">SUBJECTS OPTED</th></tr>
			</table>
		</td>
		<td class="label-style">
			<table>
				<tr><td id="priority1" class='label-style2'></td></tr>
				<tr><td id="priority2" class='label-style2'></td></tr>
				<tr><td id="priority3" class='label-style2'></td></tr>
				<tr><td id="priority4" class='label-style2'></td></tr>
				<tr><td id="priority5" class='label-style2'></td></tr>
				<tr><td id="priority6" class='label-style2'></td></tr>
				<tr><td id="priority7" class='label-style2'></td></tr>
				<tr><td id="priority8" class='label-style2'></td></tr>
				<tr><td id="priority9" class='label-style2'></td></tr>
				
			</table>
		</td>
	</tr>
</table>
			      		</div>
				</center>
		</fieldset>
	</div>
</body>
</html>