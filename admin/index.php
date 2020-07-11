<?php 
session_start();
if(isset($_SESSION['admin_username']))
	header("Location: home.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Home</title>
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
<!-- Header End -->
	<?php include_once('../header.php'); ?>
<!-- Header End -->
	
	<!-- Home -->
	<div class="home" style="background-image:url(/FOE/images/slider_background.jpg);
		 background-position: center;background-repeat: no-repeat;background-size: cover;">
		<center>
		<!-- form -->
			<form name="login"  method="post" class="login-form" action="admin_login_validation.php" 
			style="width: 26%;right: 37%;">

		          <div><img src="/FOE/images/professor.png" style="width: 25%;height: 15%;"></div>
		          <br>
		          <div class="txtb">
		            <input type="email" name="email" size="40" placeholder="Email" required style="border-radius:7px;padding:5px;font-size: 15px;">
		          </div>
		          <br>
		          <div class="txtb">
		            <input type="password" name="password" placeholder="Password" size="40" required style="border-radius:7px;padding:5px;font-size:15px;">
					<br><br>
					<u><a href="/FOE/common/forgot_password.php?user=admin">Forgot password</a></u>...? <u><a href="/FOE/common/signup.php?signup=1">Sign Up</a></u>

		          <div>
		          	<br>
		          <input type="submit" name="w_submit" class="logbtn" value="Login" style="border:5px solid #FFD700;border-radius: 15px;background-color:#FFD700;padding:0px 50px;color:#ffffff;font-size: 20px;">
		        </div>
		    </form>
		</center>
	</div>

<!-- Footer start -->
	<?php include_once('../footer.php')?>
<!-- Footer end-->


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