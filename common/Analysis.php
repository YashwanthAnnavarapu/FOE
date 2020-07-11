
<?php
session_start();
	if(isset($_SESSION['admin_username']) || isset($_SESSION['mgmt_username']))
	{
			echo '<script>window.location.href="http://localhost:5000/Analysis_'.
			$_SESSION['year-sem'].'";</script>';
	}
			
?>