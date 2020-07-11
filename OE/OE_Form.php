<?php
session_start();
if(!(isset($_SESSION['dbconnect'])))
  header("Location: Welcome.html");
?>
<html>
<head>
    <title>Open Elective Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	<script>

		function preback(){  window.history.forward(); }
		setTimeout("preback();",0);
		window.onunload()=function(){null};


		function fun()
		{
			var max=document.getElementById('no_of_subjects').innerHTML;
			var priority=new Array();
			for(i=0;i<=max;i++)
				priority[i]=i;
			var marked=new Array();
			var unmarked=new Array();
			var display=new Array();
			var i,j=1,k=1,l=0,count=0;

			for(i=1;i<=max;i++)
			{
				var x=document.getElementById("p"+i);
				if(x.value!="------SELECT------")
	  			{
					marked[x.value]=x.value;
	    			document.getElementById("p"+i).innerHTML="<option>"+x.value+"</option>"+"<option>------SELECT------</option>";
	    			count++;
	  			}
				else
					unmarked[k++]=i;
			}

			for(i=1;i<=max;i++)
				if(priority[i]!=marked[i])
					display[++l]=priority[i];

			var msg="<option>------SELECT------</option>";

			if(l>0)
				for(i=1;i<display.length;i++)
					if(display[i]<=9)
						msg+="<option>"+display[i]+"</option>";

			for(i=1;i<k;i++)
			 	document.getElementById("p"+unmarked[i]).innerHTML=msg;

			for(i=1;i<=max;i++)
				{
					var record=document.getElementById("p"+i).value;
					try
					{
						if(record>=1 && record<=9)
						{
							var new_msg="<option>"+record+"</option>"+msg;
					 		document.getElementById("p"+i).innerHTML=new_msg;
					 	}
				 	}
				 	catch(err)
				 	{
				 		continue;
				 	}
				}

			if(count==9);
				
			else
	  		{
	    		document.getElementById("priority_and_course_label").style.visibility="hidden";
				document.getElementById("confirm").style.visibility="hidden";
	      		for(i=1;i<=9;i++)
				{
					document.getElementById("sno"+i).innerHTML="";
					document.getElementById("opt"+i).innerHTML="";
				}
	  		}
		}

		function display()
		{
			var i,t,count=0;
			var max=document.getElementById('no_of_subjects').innerHTML;
			var a=new Array();
			a[0]='NULL';
			for(i=1;i<=max;i++)
				a[i]='';

			var pos=new Array();
			for(i=1;i<=max;i++)
				if((t=document.getElementById("p"+i).value)!= "------SELECT------" )
				{
					a[t]=document.getElementById("s"+i).innerText;
					count++;
					pos[t]=i;
				}

			if(count==9)
	  		{	
				for(i=1;i<=max;i++)
				{
					if(a[i]!='')
					{
						document.getElementById("sno"+i).innerHTML=i+".";
						document.getElementById("opt"+i).innerHTML=a[i];
						document.getElementById("final"+i).value=document.getElementById("s"+pos[i]).getAttribute("value");
					}
				}
				document.getElementById("priority_and_course_label").style.visibility="visible";
				document.getElementById("confirm").style.visibility="visible";
	  		}
			else
				alert('Please Select 9-Options...!');
		}
	</script>
</head>

	<body id='OE_Form_body_id'>
		<div id="divform">
			<fieldset>
			    <legend>Open Elective Form</legend>
				    <div id="student_details">
				    		<table style="width:98%">
				    			<tr>
				    				<td style="font-size:18px;text-indent :2em;" width=20%><b>ROLLNO</b></td>
				    				<td><input type="text" class="one" value="<?php echo $_COOKIE['rollno'];?>" disabled></td>
				    			</tr>
				    			<tr>
				    				<td style="font-size:18px;text-indent :2em;" width=20%><b>NAME</b></td>
				    				<td><input type="text" value="<?php echo $_COOKIE['name'];?>" disabled></td>
				    			</tr>
				    			<tr>
				    				<td style="font-size:18px;text-indent :2em;" width=20%><b>DEPARTMENT</b></td>
				    				<td><input type="text" value="<?php echo $_COOKIE['dept'];?>" disabled></td>
				    			</tr>
				    		</table>
					</div>
	    			<br>
				<center>
					<div>
						<?php
							// session_start();
							$dept=$_COOKIE['dept'];
							include_once('../Database/dbconnect_openelective_subjects.php');
							$con_sub=openelective();
							if($_SESSION['dbconnect']=="III-I")
							{
								include_once '../Database/dbconnect(III-I).php';
								$subjects="`".$_SESSION['dbconnect']."`";
							}
							else if($_SESSION['dbconnect']=="III-II")
							{
								include_once '../Database/dbconnect(III-II).php';
								$subjects="`".$_SESSION['dbconnect']."`";
							}
							else if($_SESSION['dbconnect']=="IV-I")
							{
								include_once '../Database/dbconnect(IV-I).php';
								$subjects="`".$_SESSION['dbconnect']."`";
							}
							$no_of_subjects=mysqli_fetch_assoc(mysqli_query($con_sub,"select count(*) from $subjects where dept!='$dept'"));
							$result=mysqli_query($con_sub,"select * from $subjects where dept!='$dept' group by dept");

							for($i=1;$row=mysqli_fetch_assoc($result);$i++)
								$b[$i]=$row['dept'];

						      echo "<h5><u>Classification of Departments</u>
						      		<u id='no_of_subjects' hidden>".$no_of_subjects['count(*)']."</u>
						      		</h5>";
						      echo "<form>";
									echo "<table style='border:1px solid black;padding:15px'>";
									echo "<tr><th>BRANCH</th><th style='width:400px;'>COURSE</th><th>No. of Seats</th><th style='width:150px;'>PRIORITY</th></tr>";

							for($serialno=1,$j=1;$j<$i;$j++)
							{
								echo "<tr>";
								echo "<td style='border:1px solid black;text-align:center'>".$b[$j]."</td>";
								echo "<td style='border:1px solid black' colspan='3'><table border='0'>";

								$subject_bool=mysqli_query($con_sub,"select * from $subjects where dept='$b[$j]'");

									for(;$record=mysqli_fetch_assoc($subject_bool);$serialno++)
									{
											echo "<tr>";
											echo "<td style='width:500px;font-size:20px' name='subject".$serialno."' id='s".$serialno."' value='".$record['nickname']."'>".$record['subject_name']."</td>";
											echo "<td style='border:0pxsolid black;width:100px;text-align:center;font-size:20px'>".$record['seats']."</td>";
											echo "<td style='text-indent:2em'>
												<select style='padding:5px;width:150px;font-size:15px;' name='select".$serialno."' class='".$record['sub_code']."' id='p".$serialno."'onchange='fun()'>
															<option>------SELECT------</option>
															<option>1</option>
															<option>2</option>
															<option>3</option>
															<option>4</option>
															<option>5</option>
															<option>6</option>
															<option>7</option>
															<option>8</option>
															<option>9</option>
												 </select></td>";
											echo "</tr>";
									}
								echo "</table></td>";
								echo "</tr>";
							}

								echo "</table>";
								echo "<select name='select".$serialno."' style='visibility:hidden'><option>NULL</option></select><br>";
								
								echo "</form>";
								echo "<button name='Click to View' onclick='display()'>Click to View</button><br><br>";
								echo "<table>";
								echo "<tr style='visibility:hidden' id='priority_and_course_label'><td style='font-size:20px;text-indent :2em;' align='center'><b>Priority</b></td><td style='font-size:20px;text-indent :2em;'><b>Course</b></td></tr>";

								for($i=1;$i<=9;$i++)
									echo "<tr><td align='center' id='sno".$i."' style='font-size:20px;text-indent :2em;'></td><td style='font-size:20px;text-indent :2em;'  id='opt".$i."'></td></tr>";

								echo "</table>";
						?>
					</div>
			</fieldset>	

					<div>
							<?php
								echo "<form name='Gambling' method='post'  action='OE_Form_Validation.php'>";
								echo "<center><input type='submit' name='Confirm' style='visibility:hidden;' id='confirm' value='Confirm'></center>";
								echo "<input type='text' name='final1' style='visibility:hidden;'  id='final1' value='hello1'>";
								echo "<input type='text' name='final2' style='visibility:hidden;'  id='final2' value='hello2'>";
								echo "<input type='text' name='final3' style='visibility:hidden;'  id='final3' value='hello3'>";
								echo "<input type='text' name='final4' style='visibility:hidden;'  id='final4' value='hello4'>";
								echo "<input type='text' name='final5' style='visibility:hidden;'  id='final5' value='hello5'>";
								echo "<input type='text' name='final6' style='visibility:hidden;'  id='final6' value='hello6'>";
								echo "<input type='text' name='final7' style='visibility:hidden;'  id='final7' value='hello7'>";
								echo "<input type='text' name='final8' style='visibility:hidden;'  id='final8' value='hello8'>";
								echo "<input type='text' name='final9' style='visibility:hidden;'  id='final9' value='hello9'>";
								echo "</form>";
							?>
					</div>
				</center>
		</div>
	</body>
</html>