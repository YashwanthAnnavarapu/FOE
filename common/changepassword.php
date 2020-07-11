<?php 
session_start();
    if(isset($_POST['w_submit']))
    {
        $length=strlen($_POST['new_password']);
        if($length>=6)
        {
            if($_POST['new_password']==$_POST['confirm_password'])
            {
            	$conn='';
				if(isset($_SESSION['email']))
					$email=$_SESSION['email'];
				else if(isset($_COOKIE['email']))
					$email=$_COOKIE['email'];

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
				
                $query="update openelective_users set password='".md5($_POST['new_password'])."' where email='".$email."'";
				mysqli_query($conn,$query);
				setcookie('email','',time()-1000);
				session_destroy();
                echo "<script>alert('Password Changed Successfully');</script>";
                echo '<script>window.location.href="/FOE/common/logout.php";</script>';
            }
            else
                echo "<script>alert('Recheck the Password');</script>";
        }
        else
        {
            echo "<script>alert('Password must be atleast 6-characters');</script>";
        }
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Change Password</title>
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

<script>
	function show_password()
	{
		
		var np=document.getElementById('np');
		var cp=document.getElementById('cp');

		if(np.type=='password')
		{
			np.type='text';
			cp.type='text';
		}
		else
		{
			np.type='password';
			cp.type='password';
		}
	}
	function check_password()
	{
		
		var np=document.getElementById('np');
		var cp=document.getElementById('cp');
		temp=document.getElementById('match');
		if(np.value==cp.value)
		{
			temp.innerHTML='Password Matched';
			temp.style.color='green';
			document.getElementById('submit').style.visibility='visible';
		}
		else
		{
			temp.style.color='red';
			temp.innerHTML="Password Not Matched";
			document.getElementById('submit').style.visibility='hidden';
		}
	}

</script>
</head>
<body >

	
	<!-- Home -->
	<div class="home" style="background-image:url(/FOE/images/slider_background.jpg);
		 background-position: center;background-repeat: no-repeat;background-size: cover;">
		<center>
		<!-- form -->
			<form name="login"  method="post" class="login-form">
		          <div class="txtb">
		            <input type="password" id='np' name="new_password" size="40" placeholder="New Password" required style="border-radius:7px;padding:5px;font-size: 15px;">
		          </div>

		          <br>
		          <div class="txtb">
		            <input type="password" id='cp' name="confirm_password" size="40" placeholder="Confirm Password"  required style="border-radius:7px;padding:5px;font-size: 15px;'" oninput='check_password()'>
		          </div>
		          <br>
		          <h4 id='match' style="color: white;"></h4>
		      	
		          <input type="checkbox"  onclick="show_password()"> Show Password

		          <div>
		          	<br><br>
		          <input type="submit" id='submit' name="w_submit" class="logbtn" value="Change Password" style="border:5px solid #FFD700;border-radius: 15px;background-color:#FFD700;padding:0px 50px;color:#ffffff;font-size: 20px;visibility:hidden;" 
		          		>
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