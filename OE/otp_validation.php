<?php
// include_once 'dbconnect.php';
session_start();
// $rollno=$_SESSION['rollno'];

if(isset($_SESSION['dbconnect']) && isset($_COOKIE['rollno']))
{
if($_SESSION['dbconnect']=="III-I")
	include_once '../Database/dbconnect(III-I).php';
else if($_SESSION['dbconnect']=="III-II")
	include_once '../dbconnect(III-II).php';
else if($_SESSION['dbconnect']=="IV-I")
	include_once '../dbconnect(IV-I).php';
$rollno=$_COOKIE['rollno'];
$res=mysqli_query($conn,"select * from `registered_students_details` where rollno='$rollno'");
$data=mysqli_fetch_assoc($res);

if($data['otp']==$_POST['otp'])
	header('Location: OE_Form.php');
else
	echo "<script>alert('OOPS your entered OTP is Wrong...!');window.location.href='index.php';</script>";

}
else
	echo "<script>alert('Connection errror...!');window.location.href='index.php';</script>";
?>
