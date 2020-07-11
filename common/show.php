<?php
session_start();

if(!(isset($_SESSION['admin_username'])) && !(isset($_SESSION['mgmt_username'])))
    header("Location: /FOE/index.html");

include_once('../Database/dbconnect_year_sem.php');
$conn=connect_ys();
include_once('../Database/dbconnect_openelective_subjects.php');
$sub_conn=openelective();

if(isset($_GET['function']))
    $function=$_GET['function'];

    if(!isset($_GET['branch']))
    {
    echo "<br>
                    <center>
                        <table width='70%' style='background-color:#4CAF50;border-radius:20px;'>
                            <tr><td width='250px' class='bsd' align='center' >Branch</td>
                                <td align='' width='300px' id='branch_options'>
                                    <select onchange='$function' id='branch' align='center'>
                                        <option value='None'>None</option>
                                        <option value='*'>All</option>
                                        <option value='CSE'>Computer Science ad Engineering</option>
                                        <option value='IT'>Information Technology</option>
                                        <option value='ECE'>Electronics and Communication Engineering</option>
                                        <option value='EEE'>Electrical and Electronics Engineering</option>
                                        <option value='MECH'>Mechanical engineering </option>
                                        <option value='CIVIL'>Civil Engineering</option>
                                    </select>
                                </td>";

        if($function=="fun1()" || $function=="fun3()")
        {
            echo "</tr></table></center>";
        }
        else if($function=="fun2()")
        {
            $subjects=mysqli_query($sub_conn,"SELECT nickname FROM `".$_SESSION['year-sem']."`");
             echo   "<td align='center' class='bsd'>Subject</td>
                <td>
                    <select onchange='$function'  id='sub'>
                        <option value='None'>None</option>
                        <option value='*'>All</option>";
            while($row1=mysqli_fetch_assoc($subjects))
                    echo "<option value='".$row1['nickname']."'>".$row1['nickname']."</option>";

            echo "</select></td></tr></table></center>";
        }
    }
    if(!(isset($_GET['alloted_list'])))
            echo '<div id="tw"><br><br>
                        <table class="table table-striped table-bordered table-hover table-condensed">
                              <tr>
                                <th width="2%"  align="left">Sno.</th>
                                 <th width="7%"  align="center">Rollno</th>
                                 <th width="30%" align="center">Name</th>  
                                 <th width="5%"  align="center">%</th> 
                                 <th width="5%"  align="center">Branch</th>
                                 <th width="5%" align="center">Priority 1</th>  
                                 <th width="5%" align="center">Priority 2</th>
                                 <th width="5%" align="center">Priority 3</th>
                                 <th width="5%" align="center">Priority 4</th>
                                 <th width="5%"  align="center">Priority 5</th>
                                 <th width="5%" align="center">Priority 6</th>  
                                 <th width="5%" align="center">Priority 7</th>
                                 <th width="5%" align="center">Priority 8</th>
                                 <th width="5%" align="center">Priority 9</th>  
                              </tr>';
    else                        
             echo '<div id="tw"><br><br>
                        <table class="table table-striped table-bordered table-hover table-condensed">
                              <tr>
                                 <th width="2%"  align="left">Sno.</th>
                                 <th width="7%"  align="center">Rollno</th>
                                 <th width="30%" align="center">Name</th>  
                                 <th width="5%"  align="center">%</th> 
                                 <th width="5%"  align="center">Branch</th>
                                 <th width="5%" align="center">Subject Allocated</th> 
                                 <th width="5%" align="center">Priority 1</th>  
                                 <th width="5%" align="center">Priority 2</th>
                                 <th width="5%" align="center">Priority 3</th>
                                 <th width="5%" align="center">Priority 4</th>
                                 <th width="5%"  align="center">Priority 5</th>
                                 <th width="5%" align="center">Priority 6</th>  
                                 <th width="5%" align="center">Priority 7</th>
                                 <th width="5%" align="center">Priority 8</th>
                                 <th width="5%" align="center">Priority 9</th>
                              </tr>';                  


    //deciding the table to retrive the data
    if(isset($_GET['submitted_list']))
    {
        $check_res=mysqli_query($conn,"select COUNT(*) from students_submission_form_details_backup");
        $check_row=mysqli_fetch_assoc($check_res);

        if($check_row['COUNT(*)']>0)
            $table="students_submission_form_details_backup";
        else
            $table="students_submission_form_details";
    }
    else if(isset($_GET['unalloted_list']))
        $table="students_submission_form_details";
    else if(isset($_GET['alloted_list']))
        $table="alloted_student_details";

    //if branch is selected
    if(isset($_GET['branch']))
    {
        $branch=$_GET['branch'];
        if(isset($_GET['oe_sub']))
        {
            $sub=$_GET['oe_sub'];
            if($sub=="*" && $branch=="*")
                $query="select * from alloted_student_details";
            else if($sub!="*" && $branch=="*")
                $query="select * from alloted_student_details where subject_allocated='$sub'";
            else if($sub=="*" && $branch!="*")
                $query="select * from alloted_student_details where department='$branch'";
            else if($sub!="*" && $branch!="*")
                $query="select * from alloted_student_details where department='$branch' and subject_allocated='$sub'";
        }
        else if($branch=="*")
            $query="select * from $table";
        else if($branch!="*")
            $query="select * from $table where department='$branch'";
    }

    //If it is students subimitted_list or unalloted_list
    if((isset($_GET['submitted_list']) || isset($_GET['branch'])) && !(isset($_GET['oe_sub'])))   
    {
        $results=mysqli_query($conn,$query);
                            for($i=1;$row=mysqli_fetch_assoc($results);$i++)
                              echo '<tr>
                                         <td width="" align=""><small>'.$i.'</small></td>
                                         <td width="" align="center"><small>'.$row['rollno'].'</small></td>
                                         <td width="%" align="left"><small>'.$row['name'].'</small></td>
                                         <td width="5%" align="center">'.$row['percentage'].'</td>
                                         <td width="5%" align="center"><small>'.$row['department'].'</small></td>
                                         <td width="5%"><small>'.$row['p1'].'</small></td>
                                         <td width="5%"><small>'.$row['p2'].'</small></td>
                                         <td width="5%"><small>'.$row['p3'].'</small></td>
                                         <td width="5%"><small>'.$row['p4'].'</small></td>
                                         <td width="5%"><small>'.$row['p5'].'</small></td>
                                         <td width="5%"><small>'.$row['p6'].'</small></td>
                                         <td width="5%"><small>'.$row['p7'].'</small></td>
                                         <td width="5%"><small>'.$row['p8'].'</small></td>
                                         <td width="5%"><small>'.$row['p9'].'</small></td>
                                     </tr>';
        echo '</table></div>';
    }
    //If it is alloted_list
    else if(isset($_GET['oe_sub']))
    {
        $results=mysqli_query($conn,$query);
                        for($i=1;$row=mysqli_fetch_assoc($results);$i++)
                          echo '<tr>
                                     <td width="" align=""><small>'.$i.'</small></td>  
                                     <td width="7%" align="center"><small>'.$row['rollno'].'</small></td>  
                                     <td width="%" align="left"><small>'.$row['name'].'</small></td>  
                                     <td width="5%" align="center">'.$row['percentage'].'</td>  
                                     <td width="5%" align="center"><small>'.$row['department'].'</small></td>  
                                     <td width="5%" align="center"><small>'.$row['subject_allocated'].'</small></td>  
                                     <td width="5%"><small>'.$row['p1'].'</small></td>  
                                     <td width="5%"><small>'.$row['p2'].'</small></td>
                                     <td width="5%"><small>'.$row['p3'].'</small></td>
                                     <td width="5%"><small>'.$row['p4'].'</small></td>  
                                     <td width="5%"><small>'.$row['p5'].'</small></td>  
                                     <td width="5%"><small>'.$row['p6'].'</small></td>
                                     <td width="5%"><small>'.$row['p7'].'</small></td>
                                     <td width="5%"><small>'.$row['p8'].'</small></td> 
                                     <td width="5%"><small>'.$row['p9'].'</small></td> 
                                </tr>';
        echo '</table></div>';
    }
?>