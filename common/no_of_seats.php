<?php
	include_once('../Database/dbconnect_year_sem.php');
	$available=connect_ys();
	$a_res=mysqli_query($available,"SELECT * FROM `track_no_of_seats`");
	$str="";

	while($a_row=mysqli_fetch_assoc($a_res))
	{
		$str=$str."<td style='border:3px solid black;text-align:center;' class='show_seats_live'><b>".$a_row['nickname']."</b> = ".$a_row['available']."<td>";
	}
	// echo "<script>document.getElementById('no_of_seats').innerHTML=$str;</script>";
	echo $str;
?>