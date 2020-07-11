<?php 
session_start();
    if(isset($_POST['submit']))
    {
        $email=$_POST['email'];
        // if($_POST['user']=='admin')
        // 	$conn=mysqli_connect("localhost","root","","admin_users");
        // else if($_POST['user']=='mgmt')
        // 	$conn=mysqli_connect("localhost","root","","mgmt_users");
        
        if($_POST['user']=='admin')
		{
			include_once('../Database/admin_db.php');
	       	$conn=$admin_conn;
	       	$_SESSION['user_forgot']='admin';
	    }
		else if($_POST['user']=='mgmt')
		{
		   	include_once('../Database/mgmt_db.php');
	       	$conn=$mgmt_conn;
		   	$_SESSION['user_forgot']='mgmt';
		   	echo '<script>alert("");</script>';
		}

        $query="select COUNT(*) from openelective_users where email='".$email."'";
        $result=mysqli_query($conn,$query);
        $row=mysqli_fetch_assoc($result);
        if($row['COUNT(*)']=='1')
        {
            setcookie("email",$email,time()+800);
            $otp=rand(111111,999999);
            mysqli_query($conn,"update openelective_users set otp='".$otp."' where email='".$email."'");
            mail($email,'OTP to Change Password','Your OTP is:'.$otp,"From:vjitopenelective@gmail.com");
            echo '<script>window.location.href="/FOE/common/forgot_password_validation.php";</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Forgot Password</title>
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
		            <input type="email" name="email" size="40" placeholder="Your Email Id" required style="border-radius:7px;padding:5px;font-size: 15px;">
		            <?php echo '<input type="text" name="user" hidden value="'.$_GET['user'].'"';?>

		          </div>

		          <br><br>

		          <div>
		          <input type="submit" name="submit" class="logbtn" value="Forgot Password" style="border:5px solid #FFD700;border-radius: 15px;background-color:#FFD700;padding:0px 50px;color:#ffffff;font-size: 20px;">
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