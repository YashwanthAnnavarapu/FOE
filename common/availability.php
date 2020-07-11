<?php
session_start();
include_once('../Database/dbconnect_year_sem.php');
$conn=connect_ys();
$query="select * from track_no_of_seats order by sno";
$res=mysqli_query($conn,$query);

$print="<center><table class='table table-striped table-bordered table-hover table-condensed'>
	<tr><th><h3>Sno.</h3></th><th><h3>Subject Name</h3></th><th><h3>Short Form</h3></th><th><h3>Branch</h3></th><th><h3>Seats</h3></th><th><h3>Seats Alloted</h3></th><th><h3>Available</h3></th></tr>";

	for($i=1;$row=mysqli_fetch_assoc($res);$i++)
		$print=$print."<tr><td>$i</td><td>".$row['subject_name']."</td><td>".$row['nickname']."</td><td>".$row['dept']."</td><td>".$row['seats']."</td><td>".($row['seats']-$row['available'])."</td><td>".$row['available']."</td></tr>";

$print=$print."</table></center>";
echo $print;
?>
