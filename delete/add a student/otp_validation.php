<?php
// include_once 'dbconnect.php';
session_start();
// $rollno=$_SESSION['rollno'];

if(isset($_SESSION['dbconnect']) && isset($_COOKIE['rollno']))
{
if($_SESSION['dbconnect']=="III-I")
	include_once 'dbconnect(III-I).php';
else if($_SESSION['dbconnect']=="III-II")
	include_once 'dbconnect(III-II).php';
else if($_SESSION['dbconnect']=="IV-I")
	include_once 'dbconnect(IV-I).php';
$rollno=$_COOKIE['rollno'];
$res=mysqli_query($conn,"select * from `registered_students_details` where rollno='$rollno'");
$data=mysqli_fetch_assoc($res);

if($data['otp']==$_POST['otp'])
	header('Location: OE_Form.php');
else
	die('OOPS your entered OTP is invalid...!');
// echo $_SESSION['rollno'];
// echo $_SESSION['name'];
// echo $_SESSION['dept'];
}
else
	echo "Connection error";
?>
