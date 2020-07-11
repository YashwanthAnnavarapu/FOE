<?php 
session_start();
    if(isset($_POST['w_submit']))
    {
    	if($_SESSION['user_forgot']=='admin')
		{
			include_once('../Database/admin_db.php');
	       	$conn=$admin_conn;
		}

		else if($_SESSION['user_forgot']=='mgmt')	
		{
			include_once('../Database/mgmt_db.php');
	       	$conn=$mgmt_conn;
		}
        // $conn=mysqli_connect("localhost","root","","admin_users");
        $query="select * from openelective_users where email='".$_COOKIE['email']."'";
        // echo $query;
        $result=mysqli_query($conn,$query);
        $row=mysqli_fetch_assoc($result);
        if($row['otp']==$_SESSION['otp'])
        {
            echo '<script>window.location.href="/FOE/common/changepassword.php";</script>';
        }
        else
            echo '<script>alert("Entered OTP is Wrong...!!");</script>';

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Course Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/FOE/styles/bootstrap4/bootstrap.min.css">
<link href="/FOE/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/FOE/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="/FOE/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="/FOE/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="/FOE/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="/FOE/styles/responsive.css">
</head>
<body >

	
	<!-- Home -->
	<div class="home" style="background-image:url(/FOE/images/slider_background.jpg);
		 background-position: center;background-repeat: no-repeat;background-size: cover;">
		<center>
		<!-- form -->
			<form name="login"  method="post" class="login-form">
		          <div class="txtb">
                    <h2 cstyle="color:#FFFFFF";>Enter the OTP sent to your Registered Mail</h2>
                    <br>
		            <input type="password" name="otp" size="40" placeholder="Enter the OTP" required style="border-radius:7px;padding:5px;font-size: 15px;">
		          </div>

		          <br>

		          <div>
		          <input type="submit" name="w_submit" class="logbtn" value="Submit" style="border:5px solid #FFD700;border-radius: 15px;background-color:#FFD700;padding:0px 50px;color:#ffffff;font-size: 20px;">
		        </div>
		    </form>
		</center>
	</div>


</div>

	<script src="/FOE/js/jquery-3.2.1.min.js"></script>
	<script src="/FOE/styles/bootstrap4/popper.js"></script>
	<script src="/FOE/styles/bootstrap4/bootstrap.min.js"></script>
	<script src="/FOE/plugins/greensock/TweenMax.min.js"></script>
	<script src="/FOE/plugins/greensock/TimelineMax.min.js"></script>
	<script src="/FOE/plugins/scrollmagic/ScrollMagic.min.js"></script>
	<script src="/FOE/plugins/greensock/animation.gsap.min.js"></script>
	<script src="/FOE/plugins/greensock/ScrollToPlugin.min.js"></script>
	<script src="/FOE/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
	<script src="/FOE/plugins/scrollTo/jquery.scrollTo.min.js"></script>
	<script src="/FOE/plugins/easing/easing.js"></script>
	<script src="/FOE/js/custom.js"></script>
</body>
</html>