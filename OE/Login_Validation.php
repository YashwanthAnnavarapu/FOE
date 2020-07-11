<?php
session_start();

function is_connected()
{
    $connected = fsockopen("www.google.com", 80); 
    //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;

}

	if(isset($_POST['w_submit']) && is_connected())
	{
		
	 $rollno =strtoupper($_POST['rollno']);
	 $email =$_POST['email'];
	 if($_POST['year-semester']=="III-I")
	 	include_once '../Database/dbconnect(III-I).php';
	 else if($_POST['year-semester']=="III-II")
	 	include_once '../Database/dbconnect(III-II).php';
	 else if($_POST['year-semester']=="IV-I")
	 	include_once '../Database/dbconnect(IV-I).php';
	else
	    die('oops connection problem ! --> '.mysqli_connect_error());
		if($conn)
		{
		 $otp=rand(111111,999999);
		 $validation_res=mysqli_query($conn,"select COUNT(*) from students_validation_details where 
		 	rollno='$rollno'and email='$email'");
			 $validation_row=mysqli_fetch_assoc($validation_res);
			 {
				$cook_res=mysqli_query($conn,"select * from students_validation_details where 
				rollno='16911A0505'");
				$cook_row=mysqli_fetch_assoc($cook_res);
				setcookie("name",$cook_row['name'],time()+800);
				setcookie("percentage",$cook_row['percentage'],time()+800);
				// $temp=$cook_row['name'];
				// echo "<script>alert('$temp');</script>";
				// $temp=$cook_row['percentage'];
				// echo "<script>alert('$temp');</script>";
			 }
			 if($validation_row['COUNT(*)']=='0')
			 {
			 	echo "<script>alert('You Details are Invalid........!');</script>";
			 	echo "<script>window.location.href='index.php'</script>";
			 }
			// checking the student details from submission form
			$recheck_res=mysqli_query($conn,"select COUNT(*) from students_submission_form_details where rollno='$rollno'");
			$recheck_row=mysqli_fetch_assoc($recheck_res);

			if( $validation_row['COUNT(*)']=='1'
				&& 
				(mysqli_query($conn,"INSERT INTO registered_students_details VALUES('$rollno','$email','$otp')") || $recheck_row['COUNT(*)']==0 ) 
				)
			{

				if($recheck_row['COUNT(*)']==0)// UPDATING OTP IF FORM IS NOT SUBMITTED BUT REGISTERED
					mysqli_query($conn,"UPDATE registered_students_details SET otp='$otp' WHERE 
						rollno='$rollno'");

				//mail($email,'OTP for OE','Your OTP is:'.$otp,"From:vjitopenelective@gmail.com");
				setcookie("rollno",$rollno,time()+800);
				// setcookie("name",$_POST['name'],time()+800);
					
				
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
				echo "<script>alert('".$_COOKIE['dept']."');</script>";
				header('Location: otp_page.html');
			}
			else
			{
				echo "<script>alert('Your Response is already Recorded....!');</script>";
				echo "<script>window.location.href='index.php';</script>";
			}
		}
	}
	else
		{
			echo "<script>alert('OOPS the system is not Connected to Internet.......!');</script>";
			echo "<script>window.location.href='index.php';</script>";
		}
?>