<?php

$link = mysqli_connect ('localhost','root','','iii-i');

$query = 'select * from alloted_student_details';

$result = mysqli_query($link,$query);
$columnHeader = ''; 
	$i = 0;
	echo '<html><body><table><tr>';
	while ($i < mysqli_num_fields($result))
	{
		$feild_name = mysqli_fetch_field($result);
		// echo '<td>' . $feild_name->name . '</td>';
		$columnHeader.=$feild_name->name.'\t';
		$i += 1;
	}
echo "<script>alert('$columnHeader');</script>";
mysqli_close ($link);
?>