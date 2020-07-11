<?php
session_start();
	if(isset($_POST['w_submit']))
	{
		
	 $rollno =$_POST['rollno'];
	 $email =$_POST['email'];
	 if($_POST['year-semester']=="III-I")
	 	include_once 'dbconnect(III-I).php';
	 else if($_POST['year-semester']=="III-II")
	 	include_once 'dbconnect(III-II).php';
	 else if($_POST['year-semester']=="IV-I")
	 	include_once 'dbconnect(IV-I).php';
	else
	    die('oops connection problem ! --> '.mysqli_connect_error());
		if($conn)
		{
		 $otp=rand(111111,999999);
		 $validation_res=mysqli_query($conn,"select COUNT(*) from students_validation_details where rollno='$rollno'");
		 $validation_row=mysqli_fetch_assoc($validation_res);
		 if($validation_row['COUNT(*)']=='0')
		 {
		 	echo "<script>alert('You Details are Invalid........!');</script>";
		 	echo "<script>window.location.href='Welcome.html'</script>";
		 }
			if(mysqli_query($conn,"INSERT INTO registered_students_details VALUES('$rollno','$email','$otp')") && 
				$validation_row['COUNT(*)']=='1')
			{
				// mail($email,'OTP for OE','Your OTP is:'.$otp,"From:vjitopenelective@gmail.com");
				setcookie("rollno",$rollno,time()+800);
				setcookie("name",$_POST['name'],time()+800);
				$_SESSION['dbconnect']=$_POST['year-semester'];
				// $_SESSION['rollno']=$rollno;
				// $_SESSION['name']=$_POST['name'];
				
				if($rollno{7}=='5' || ($rollno{6}=='1' && $rollno{7}==2))
						$dept='CSE/IT';
				else if($rollno{7}=='1')
						$dept='CIVIL';
				else if($rollno{7}=='2')
						$dept='EEE';
				else if($rollno{7}=='3')
						$dept='MECH';
				else if($rollno{7}=='4')
						$dept='ECE';

				// $_SESSION['dept']=$dept;
				setcookie("dept",$dept,time()+800);
				header('Location: otp_page.html');
			}
			else
			{
				echo "<script>alert('Your Response is already Recorded....!');</script>";
				echo "<script>window.location.href='Welcome.html';</script>";
			}
		}
	}
?>