<?php
include_once('../Database/dbconnect_year_sem.php');
if(!($conn=connect_ys()))
{
     die("OOP's connection problem.......!".mysqli_connect_error());
}
?>