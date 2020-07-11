<?php
	session_start();
	 include_once '../Database/mgmt_db.php';

	if(isset($_SESSION['mgmt_username']))
		header("Location: home.php");

	if(isset($_POST['w_submit']))
	{
		$email=$_POST['email'];
		$password=$_POST['password'];
		$res=mysqli_query($mgmt_conn,"select * from `openelective_users` where email='$email'");
		$row=mysqli_fetch_assoc($res);
		if($row['password']==md5($password))
		{
      		$_SESSION['eid']=$row['employee_id'];
			$_SESSION['mgmt_username']=$row['name'];
			$_SESSION['email']=$email;
			header("Location: home.php");
		}
		else
		{
			echo "<script>alert('Invalid Username or Password');</script>";
			echo "<script>window.location.href='http://localhost/FOE/admin/';</script>";
		}
	}
?>
