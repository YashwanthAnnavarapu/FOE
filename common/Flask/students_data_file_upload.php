<?php
   if(isset($_FILES['excel_file']) && isset($_POST['submit']))
   {
      $file_name =$_FILES['excel_file']['name'];
      $file_tmp = $_FILES['excel_file']['tmp_name'];

      //Checking file name
	  try
	  {
		  if($file_name=='students_data.xlsx')
		  {
			//Extration of file extension format in xls or xlsx (i.e refering to excel format)
			$upload_file_ext=explode('.',$file_name);
			$upload_file_ext=strtolower(end($upload_file_ext));

			$file_exts=array('xlsx');
			if(in_array($upload_file_ext,$file_exts) && move_uploaded_file($file_tmp,"Excel File/".$file_name))
			{
			  echo "<script>alert('File uploaded successfully');</script>";
			  echo "<script>window.open('http://localhost:5000/Excel_File_Format_Checking','_self');</script>";
			  // echo "<script>window.close();</script>";
			}

		  }
		  else 
			echo "<script>alert('File Uploading Failed, Please check the file name and upload it again...!!');</script>";  
	   }
	  catch(Exception $e)
	  {}
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>File Uploading</title>
   <style type="text/css">
      #one
      {
         top:25%;
      }
      #heading
      {
         top:7%;
         left:25%;
      }
      #two
      {
         width:50%;
      }
   </style>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
   <center>
      <div style="padding: 20px;">
         <h2>Upload Student Validation Data File</h2>
      </div>

      <div>
        <form action="" enctype="multipart/form-data" style="padding:10px;" method="post">
            <div class="custom-file mb-3" style="width: 50%">
               <input type="file" accept='.xls,.xlsx' class="custom-file-input" id="customFile" name="excel_file" onchange='filename()''>
               <label class="custom-file-label" for="customFile" align='left'>Choose file</label>
            </div>
            <div class="mt-3">
               <button type="submit" class="btn btn-primary" name='submit'>Submit</button>
            </div>
        </form>
      </div>

      <script>
      // Add the following code if you want the name of the file appear on select
      $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });
      </script>

      <div style="padding: 20px;border:1px solid black" id='two'>
         <h3>Instructions To Upload File</h3>
         <ul align='left'>
            <li>The name of the file must be 'students_data'</li>
            <li>The file extension should be in .xlsx format</li>
            <li>For Reference File Format <a href="Excel File/File Formats/Students_Validation_Format.xlsx" 
               download='students_data.xlsx'>Click Here</a>
            </li>
         </ul>
      </div>
   </center>
      
</body>
</html>

