<?php 
session_start();	
	echo '<script>alert("'.$_GET['msg'].'");</script>';

	if(isset($_SESSION['admin_username']))
		echo "<script>
			 window.location='http://localhost/FOE/admin/';
		     </script>";
	if(isset($_SESSION['mgmt_username']))
		echo "<script>
			 window.location='http://localhost/FOE/mgmt/';
		     </script>";
?>