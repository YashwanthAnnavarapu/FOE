<?php
session_start();
	if(isset($_SESSION['admin_username']))
	{
		echo '<script>window.location.href="http://localhost:5000/Subjects'.
		$_SESSION['year-sem'].'";</script>';
	}
			
?>