<?php
session_start();
$rollno=$_POST['rollno'];
$password=$_POST['password'];

if($rollno!=$password)// password is wrong
	{
		echo "<script>alert('Check Your Rollno and password');
			window.location.href='index.php';
			</script>";
	}

else //password is correct
{
	$_SESSION['year-sem']=$_POST['year-semester'];
	include_once '/xampp/htdocs/FOE/Database/dbconnect_year_sem.php';
	if($conn=connect_ys())
	{

		if($result=mysqli_query($conn,"select COUNT(*) from alloted_student_details where rollno='$rollno'"))
		{
			// $_SESSION['year-sem']=$_POST['year-semester'];
			// echo "<script>alert('$check')</script>";
			setcookie('rollno',$rollno,time()+(150));
			if($row=mysqli_fetch_assoc($result)['COUNT(*)'])
			{
				echo "<script>alert('2')</script>";
				$_SESSION['table']="alloted_student_details";
				header('Location: allotment.php');
			}
		
			else if($result=mysqli_query($conn,"select COUNT(*) from  students_submission_form_details where rollno='$rollno'"))
			{
				if($row=mysqli_fetch_assoc($result)['COUNT(*)'])
				{
					$_SESSION['table']="students_submission_form_details";
					echo "<script>alert('3')</script>";
					header('Location: allotment.php');
				}
			}
		}
		else
			echo "<script>alert('Contact Admin..........!')</script>";

	}
	else
		echo "<script>alert('Your Details are Invalid..........!')</script>";
}
?>