<?php
session_start();
if(!isset($_SESSION['admin_username']))
	header("Location: index.php");
	if(isset($_GET['id'])!=null&&$_GET['id']!="")
	{
		$str=$_GET['id'];
		$arr=explode(",",$str);
		//echo $arr[$i]."<br>";
		include_once('../Database/dbconnect_openelective_subjects.php');
		$conn=openelective();
		echo '<table id="hash" class="table table-striped table-bordered table-hover table-condensed">';
		echo "<tr><td></td><th>Id</th><th>Name</th><th>Percentage</th><th>Department</th><th>Priority 1</th><th>Priority 2</th><th>Priority 3</th><th>Priority 4</th></tr>";
		$k=0;
		for($i=0;$i<count($arr);$i++)
		{
			echo "<tr>";
			$q=mysqli_query($conn,"select * from target where rollno='$arr[$i]'");
				while($row=mysqli_fetch_assoc($q))
				{
				echo "<td><input type='checkbox' name='c_del' value='".$row['rollno']."'></td><td>".$row['rollno']."</td><td>".$row['name']."</td><td align='center'>".$row['percentage']."</td><td align='center'>".$row['department']."</td><td align='center'>".$row['p1']."</td><td align='center'>".$row['p2']."</td><td align='center'>".$row['p3']."</td><td align='center'>".$row['p4']."</td>";
				$k=$k+1;
				}
		}
		if($k==0)
		echo "<td colspan='9' align='center'>No Data Found</td>";
		echo "</tr>";
		echo "</table>";
		if($k>0)
		echo "<input type='button' class='btn btn-warning' value='Delete'  onclick='del()'>";
	}
	
	if(isset($_GET['str'])!=null&&$_GET['str']!="")
	{
	$str=$_GET['str'];
	$arr=explode(";",$str);
	$conn=mysqli_connect("localhost","root","","openelective");
		for($i=0;$i<count($arr);$i++)
		{
		if(mysqli_query($conn,"delete from target where rollno='$arr[$i]'"))
		echo $arr[$i]." Deleted successfully <br>";
		else
		echo $arr[$i]." Error while Deleting<br>";
		}
	}
?>