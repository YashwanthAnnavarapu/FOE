<?php
session_start();
if(!isset($_SESSION['admin_username']))
	header("Location: index.php");

	if(isset($_GET['id'])!=null && $_GET['id']!="")
	{
		$str=$_GET['id'];
		$arr=explode(",",$str);
		include_once('../Database/dbconnect_year_sem.php');
		$conn=connect_ys();
		echo '<table id="hash" class="table table-striped table-bordered table-hover table-condensed">';
		echo "<tr><td>*</td><th>RollNo</th><th>Name</th><th>Percentage</th><th>Department</th></tr>";
		$count=0;
		for($i=0;$i<count($arr);$i++)
		{
			echo "<tr>";
			$q=mysqli_query($conn,"select * from students_submission_form_details where rollno='$arr[$i]'");
				while($row=mysqli_fetch_assoc($q))
				{

				echo "<td><input type='checkbox' name='c_del' value='".$row['rollno']."'></td><td>".$row['rollno']."</td><td>".$row['name']."</td><td align='center'>".$row['percentage']."</td><td align='center'>".$row['department']."</td>";
				$count=$count+1;
				}
		}
		if($count==0)
			echo "<td colspan='9' align='center'>No Data Found</td>";

		echo "</tr>";
		echo "</table>";

		if($count>0)
			echo "<input type='button' class='btn btn-warning' value='Delete' onclick='del()'>";
	}

	if(isset($_GET['ids'])!=null && $_GET['ids']!="")
	{
		$count=0;
		$ids="(".$_GET['ids'].")";
		$display=$_GET['ids'];
		$conn=mysqli_connect("localhost","root","",$_SESSION['year-sem']);

		if($_GET['radio_btn_response']=='CR')//CR-->Clear Response
		{
			mysqli_query($conn,"delete from registered_students_details where rollno in".$ids);
			mysqli_query($conn,"delete from students_submission_form_details where rollno in".$ids);
			$count=1;
		}
		else if($_GET['radio_btn_response']=='RSDP')//RSDP-->Remove Student Details Permanently
		{
			mysqli_query($conn,"delete from registered_students_details where rollno in".$ids);
			mysqli_query($conn,"delete from students_validation_details where rollno in".$ids);
			mysqli_query($conn,"delete from students_submission_form_details where rollno in".$ids);
			mysqli_query($conn,"delete from students_submission_form_details_backup where rollno in".$ids);
			mysqli_query($conn,"delete from alloted_student_details where rollno in".$ids);
			$count=1;
		}
		
		if($count==1)
			echo "(".str_ireplace("'","",$display).")---> Deleted successfully,<br>";
		else
			echo $ids."---> Error while Deleting";
	}
?>