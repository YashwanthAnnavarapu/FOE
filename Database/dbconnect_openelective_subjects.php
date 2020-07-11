<?php
function openelective()
{
if(!($con_sub=mysqli_connect("localhost","root","","openelective")))
     die('oops connection problem ! --> '.mysqli_connect_error());
 return($con_sub);
}
?>