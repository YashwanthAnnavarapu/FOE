<?php
include_once('../Database/dbconnect(feedback).php');
if($_POST['feedback']!=null)
{
	$query="insert into students_feedback values('".$_COOKIE['rollno']."','".$_POST['feedback']."')";
	$res=mysqli_query($feed_conn,$query);
}
setcookie("rollno","",time()-3600);
setcookie("name","",time()-3600);
setcookie("percentage","",time()-3600);
setcookie("dept","",time()-3600);
	header("Location: /FOE/About_us.php");
?>