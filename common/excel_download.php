<?php
//http://localhost/fad/excel_download.php?branch=%27CSE%27&list=Student%27s%20Submission%20List
session_start();

if(!(isset($_SESSION['admin_username'])))
    header("Location: index.php");
else
{
	
	$filename=$_SESSION['year-sem']."-Students Data";
	$query='';
	$table_name='';
	$dept='';
	$subject='';
	$allow_download=0;
	$columnHeader='';
	include_once('../Database/dbconnect_year_sem.php');
	$conn=connect_ys();
	
	if($_GET['list']=="Student's Submission List")
	{
		$check_res=mysqli_query($conn,"select COUNT(*) from students_submission_form_details_backup");
        $check_row=mysqli_fetch_assoc($check_res);

        if($check_row['COUNT(*)']>0)
            $table_name="students_submission_form_details_backup";
        else
            $table_name="students_submission_form_details";

        $query="select * from ".$table_name;

		if($_GET['branch']=='None')
			$query='';
		else if($_GET['branch']!='*')
			$query=$query.' where department="'.$_GET['branch'].'"';

		$allow_download=1;
	}
	

	else if($_GET['list']=='Alloted Students List')
	{
		if($_GET['branch']!='None' && $_GET['oe_sub']!='None')
		{
			$table_name='alloted_student_details';
			$query='select * from '.$table_name;

			if($_GET['branch']!='*' && $_GET['oe_sub']!='*')
				$query=$query.' where department="'.$_GET['branch'].'" and subject_allocated="'.
				$_GET['oe_sub'].'"';

			//if branch is selected
			else if($_GET['branch']!='*')
			{
				$query=$query.'" where department="'.$_GET['branch'].'"';

				//if branch and subject both are selected
				if($_GET['oe_sub']!='*')
					$query=$query.' and subject_allocated="'.$_GET['oe_sub'].'"';

			}
			
			//only if subject is selected and branch is not selected
			else if($_GET['oe_sub']!='*')
					$query=$query.' subject_allocated="'.$_GET['oe_sub'].'"';

			$allow_download=1;
		}

	}
	else if($_GET['list']=='Unalloted Students List')
	{
		$table_name='students_submission_form_details';
		$query='select * from '.$table_name;
		if($_GET['branch']=='None')
			$query='';
		else if($_GET['branch']!='*')
			$query=$query.' where department="'.$_GET['branch'].'"';

		$allow_download=1;
	}


// Checking branch and subject
	if(isset($_GET['branch']) && $_GET['branch']!='None' && $_GET['branch']!='*')
		$filename=$filename."(".$_GET['branch'].")";

	if(isset($_GET['oe_sub']) && $_GET['oe_sub']!='None' && $_GET['oe_sub']!='*')
		$filename=$filename."-".$_GET['oe_sub'];

// https://razorsql.com/articles/mysql_column_names_values.html  

	if($allow_download==1)
	{
		$result = mysqli_query($conn,$query);
		
		$i=0;
		while ($i<mysqli_num_fields($result))
		{
			$field_name = mysqli_fetch_field($result);
			$columnHeader.=$field_name->name.",";
			$i+= 1;
		}
	 
		$setData = '';  

		while ($rec = mysqli_fetch_row($result)) {  
		    $rowData = '';  
		    foreach ($rec as $value) {  
		        $value = '"' . $value . '"' . ",";  
		        $rowData .= $value;  
		    }  
		    $setData .= trim($rowData) . "\n";  
		}  
  
  		// if($branch='')
  		// $filename=;
		header("Content-type: application/octet-stream");  
		header("Content-Disposition: attachment; filename=".$filename.".csv");  
		header("Pragma: no-cache");  
		header("Expires: 0");  
	  
		echo ucwords($columnHeader). "\n".$setData . "\n"; 
	}

}
// echo "<script>alert('$query');</script>";
?>