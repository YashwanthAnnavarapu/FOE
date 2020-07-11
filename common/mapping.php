<?php
$subject_map=Array();
include_once('../Database/dbconnect_openelective_subjects.php');
openelective();
if($sub_conn=openelective())
	{
		$query="select * from `".$_SESSION['year-sem']."`";
		$sub_res=mysqli_query($sub_conn,$query);
		for($i=0;$sub_row=mysqli_fetch_assoc($sub_res);$i++)
			$subject_map[$sub_row['nickname']]=$sub_row['seats'];
			// $subject_map[$sub_row['subject_name']]=$sub_row['seats'];
		mysqli_close($sub_conn);
	}
else
	die('oops connection problem ! --> '.mysqli_connect_error());
?>