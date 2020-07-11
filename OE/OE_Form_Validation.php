<?php
session_start();
if(!(isset($_SESSION['dbconnect'])))
  header("Location: Welcome.html");

include_once('../Database/dbconnect_openelective_subjects.php');
// $semister=mysqli_connect('localhost','root','','iv-i');
if(($target=mysqli_connect('localhost','root','',$_SESSION['dbconnect'])) and isset($_POST['Confirm']))
  {
    $table=$_SESSION['dbconnect'];
    for($i=1;$i<=9;$i++)
      $store_sub_names[$i]=$_POST['final'.$i];

      $rollno=$_COOKIE['rollno'];
      $dept=$_COOKIE['dept'];
      if($rollno{6}=='0' && $rollno{7}=='5')
        $dept='CSE';
      else if($rollno{6}=='1' && $rollno{7}=='2')
        $dept='IT';
      $query="insert into `students_submission_form_details` values('".$_COOKIE['rollno']."','".$_COOKIE['name']."',".$_COOKIE['percentage'].",'".$dept."','"
      .$store_sub_names[1]."','".$store_sub_names[2]."','".$store_sub_names[3]."','".$store_sub_names[4].
      "','".$store_sub_names[5]."','".$store_sub_names[6]."','".$store_sub_names[7]."','".$store_sub_names[8].
      "','".$store_sub_names[9]."')";
  if(mysqli_query($target,$query))
    {
      echo "<script>alert('Your response is recorded....!');</script>";
      // echo "<script>location.href='Welcome.html'</script>";
      echo "<script>window.location.href='feedback.html';</script>";
    }
    else
      echo "<script>alert('Error PLease Try Again......!');</script";
  }
else
  die('OOPS DataBase error connection'.mysqli_connect_error());


// setcookie("rollno","",time()-3600);
// setcookie("name","",time()-3600);
// setcookie("dept","",time()-3600);
?>
