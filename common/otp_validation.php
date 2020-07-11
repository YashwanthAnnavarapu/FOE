<?php
session_start();
if(!isset($_SESSION['admin_username']))
	header("Location: index.php");

include_once('../Database/admin_db.php');
$conn=$admin_conn;
$eid=$_SESSION['eid'];
$res=mysqli_query($conn,"select * from openelective_users where employee_id='$eid'");
$data=mysqli_fetch_assoc($res);

if($data['otp']==$_POST['otp'])
	header('Location: allot_seats.php');
else
	die('OOPS your entered OTP is invalid...!');
?>
