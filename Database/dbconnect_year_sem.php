<?php
function connect_ys()
{
	$conn=mysqli_connect("localhost","root","",$_SESSION['year-sem']);
	return $conn;
}
?>