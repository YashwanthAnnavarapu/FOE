<?php
    session_start();    
    if(!(isset($_POST['confirm'])) || !(isset($_SESSION['admin_username'])))
        header("Location: ../admin/index.php");

    include_once 'sub_connect.php';
    include_once 'mapping.php';
    


    //***********************************************************************************************************************
    // check the backup
    $check_backup_result=mysqli_query($conn,"select COUNT(*) from students_submission_form_details_backup");
    $check_backup_row=mysqli_fetch_assoc($check_backup_result);
    if($check_backup_row['COUNT(*)']!=0)
    {
        echo '<script>alert("Seats are already alloted...!!");</script>';
        echo '<script>window.location.href="http://localhost/FOE/admin/home.php";</script>';
    }
    else
    {
        //BACK UP
        //***********************************************************************************************************************
        // maintaing the backup of student submission details
        $copy_res=mysqli_query($conn,"INSERT INTO students_submission_form_details_backup SELECT * FROM students_submission_form_details");
        //***********************************************************************************************************************


        //***********************************************************************************************************************
        // maintaing the records of admin who alloted seats to students 
        // $records_conn=mysqli_connect("localhost","root","","admin_users");
        include_once('../Database/admin_db.php');
        $records_conn=$admin_conn;
        date_default_timezone_set('Asia/Kolkata');
        $records_query="insert into `alloment_process_details` values('".$_SESSION['eid']."','".$_SESSION['admin_username']."','".$_SESSION['year-sem']."','".$_SESSION['email']."','".date("l jS \of F Y h:i:s A")."')";
        $records_result=mysqli_query($records_conn,$records_query);
        //***********************************************************************************************************************



        $results=mysqli_query($conn,"select * from students_submission_form_details ORDER BY percentage DESC");

        $insert_query="insert into alloted_student_details values";
        $values="";
        $del_rolls='(';
        $alloted_count=0;
        for($i=0;$row=mysqli_fetch_assoc($results);$i++)
        {
            $c=0;
            $sub_allocated="";
            try
            {
                if($subject_map[$row['p1']]!=0)
                {
                    $subject_map[$row['p1']]-=1;
                    $c=1;
                    $sub_allocated=$row['p1'];
                }
                else if($subject_map[$row['p2']]!=0)
                {
                    $subject_map[$row['p2']]-=1;
                    $c=1;
                    $sub_allocated=$row['p2'];
                }
                else if($subject_map[$row['p3']]!=0)
                {
                    $subject_map[$row['p3']]-=1;
                    $c=1;
                    $sub_allocated=$row['p3'];
                }
                else if($subject_map[$row['p4']]!=0)
                {
                    $subject_map[$row['p4']]-=1;
                    $c=1;
                    $sub_allocated=$row['p4'];
                }
                else if($subject_map[$row['p5']]!=0)
                {
                    $subject_map[$row['p5']]-=1;
                    $c=1;
                    $sub_allocated=$row['p5'];
                }
                else if($subject_map[$row['p6']]!=0)
                {
                    $subject_map[$row['p6']]-=1;
                    $c=1;
                    $sub_allocated=$row['p6'];
                }
                else if($subject_map[$row['p7']]!=0)
                {
                    $subject_map[$row['p7']]-=1;
                    $c=1;
                    $sub_allocated=$row['p7'];
                }
                else if($subject_map[$row['p8']]!=0)
                {
                    $subject_map[$row['p8']]-=1;
                    $c=1;
                    $sub_allocated=$row['p8'];
                }
                else if($subject_map[$row['p9']]!=0)
                {
                    $subject_map[$row['p9']]-=1;
                    $c=1;
                    $sub_allocated=$row['p9'];
                }


                if($c==1)
                {
                    $c=0;
                    $values=$values."('".$row['rollno']."','".$row['name']."'," .$row['percentage'].",'".$row['department']."','".$sub_allocated."','".$row['p1']."','".$row['p2']."','".$row['p3']."','".$row['p4'].
                    "','".$row['p5']."','".$row['p6']."','".$row['p7']."','".$row['p8']."','".$row['p9']."'),";

                    $del_rolls=$del_rolls."'".$row['rollno']."',";

                    $alloted_count+=1;
                }
            }
            catch(Exception $e)
            {   continue;   }

        }
        $del_rolls=substr($del_rolls,0,(strlen($del_rolls)-1));
        $del_rolls=$del_rolls.")";
        // echo $del_rolls;
        $insert_query=$insert_query.$values;
        $insert_query=substr($insert_query,0,-1);

        if($insert_results=mysqli_query($conn,$insert_query))
            echo "<script>alert('records inserted successfully');</script>";
        else
            echo "<script>alert('There is a problem while inserting the records');</script>";

        try
        {
 
            $query="delete from students_submission_form_details where rollno in".$del_rolls;
            $result=mysqli_query($conn,$query);
            echo "<script>alert('$alloted_count-Seats are successfully allocated to students');</script>";
        }

        catch(Exception $e)
        {
            echo "<script>alert('There is a problem while removing the records from database.......!');</script>";
        }

        finally
        {   
            $update_res=mysqli_query($conn,"select nickname,subject_name from track_no_of_seats");
            while($update_row=mysqli_fetch_assoc($update_res))
            {
                $query="update `track_no_of_seats` set available=".$subject_map[$update_row['nickname']]." where nickname='".$update_row['nickname']."'";
                $status_res=mysqli_query($conn,$query);
                // $query="update `track_no_of_seats` set avaiable=".$subject_map[$update_row['subject_name']]." where nickname='".$update_row['subject_name']."'";
                // $status_res=mysqli_query($conn,$query);
            }
            echo '<script>window.location.href="http://localhost/FOE/admin/home.php";</script>';
            mysqli_close($conn);
        }
    }
?>