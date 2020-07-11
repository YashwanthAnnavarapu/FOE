<?php
session_start();
if(!(isset($_SESSION['dbconnect'])))
  header("Location: Welcome.html");

include_once 'openelective_subjects.php';
// $semister=mysqli_connect('localhost','root','','iv-i');
if(($target=mysqli_connect('localhost','root','',$_SESSION['dbconnect'])) and isset($_POST['Confirm']))
  {
    $table=$_SESSION['dbconnect'];
    for($i=1;$i<=4;$i++)
      if($find_sub=mysqli_query($con_sub,"select * from `$table` where sub_code='".$_POST['final'.$i]."'"))
      {
          $row=mysqli_fetch_assoc($find_sub);
          $store_sub_names[$i]=$row['subject_name'];
      }
      $rollno=$_COOKIE['rollno'];
      $dept=$_COOKIE['dept'];
      if($rollno{6}=='0' && $rollno{7}=='5')
        $dept='CSE';
      else if($rollno{6}=='1' && $rollno{7}=='2')
        $dept='IT';
      $query="insert into `students_submission_form_details` values('".$_COOKIE['rollno']."','".$_COOKIE['name']."',80.12,'".$dept."','".$store_sub_names[1]."','".$store_sub_names[2]."','".$store_sub_names[3]."','".$store_sub_names[4]."')";
    if(mysqli_query($target,$query))
    {
      echo "<script>alert('Your response is recorded....!');</script>";
      echo "<script>location.href='Welcome.html'</script>";
    }
    else
      echo "<script>alert('Error......!');</script";
  }
else
  die('OOPS DataBase error connection'.mysqli_connect_error());

setcookie("rollno","",time()-3600);
setcookie("name","",time()-3600);
setcookie("dept","",time()-3600);
?>
