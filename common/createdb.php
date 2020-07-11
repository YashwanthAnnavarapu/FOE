<?php
session_start();
	if(isset($_SESSION['admin_username']) || isset($_SESSION['mgmt_username']))
	{
		$_SESSION['year-sem']=$_GET['year']."-".$_GET['semester'];
		echo $_SESSION['year-sem'];
	}
	else
		header("Location: index.php");
?>
