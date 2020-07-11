<?php
session_start();
if(!(isset($_SESSION['mgmt_username'])))
	header("Location: index.php");
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
	<link rel="stylesheet" type="text/css" href="/FOE/styles/dropdown.css">
<!-- ****************************************************************************************** -->
	<script type="text/javascript" src="home.js"></script>
	
	<style type="text/css">
		#seven
		{
			position:absolute;
			top:5%;
			left:85%;
		}
	</style>

	<script>
		function check(index)
		{
			value=document.getElementById("year-sem").innerText;
			if(value!="Year-Sem")
			{
				if(index=='1')
					SubmittedList();
				else if(index=='2')
					AllotedStudentsList();
				else if(index=='3')
					Unalloted_Students();
				else if(index=='4')
					Track_Seats();
				else if(index=='5')
					Analysis();		
			}
			else
				alert("select year-semester");
		}

		function SubmittedList()
		{window.open("/FOE/common/ListGeneration.php?function=fun1()&title=Student's Submission List");}

		function AllotedStudentsList()
		{	window.open("/FOE/common/ListGeneration.php?function=fun2()&title=Alloted Students List");		}

		function Unalloted_Students()
		{	window.open("/FOE/common/ListGeneration.php?function=fun3()&title=Unalloted Students List");	}

		function Track_Seats()
		{			window.open("/FOE/common/Tracking.php");												}
		function Analysis()
		{	window.open("/FOE/common/Analysis.php");	}	
		function year_sem(value)
		{
			document.getElementById("year-sem").innerHTML=value;
			change(value);
		}									
	</script>
<!-- ********************************************************************************************** -->
</head>
<body>

<div class="super_container">

	<!-- Header -->

	<header class="header d-flex flex-row">
		<div class="header_content d-flex flex-row align-items-center">
			<!-- Logo -->
			<div class="logo_container">
				<div class="logo">
					<img src="../images/logo.png" alt="">
					<span>Open Elective</span>
				</div>
			</div>

			<!-- Main Navigation -->
			<nav class="main_nav_container">
				<div class="main_nav">
					<ul class="main_nav_list">
						<li class="main_nav_item"><a href="index.php">Home</a></li>
						<li class="main_nav_item"><a href="#">courses</a></li>
						<li class="main_nav_item">
							<div class="dropdown">
							  <button class="dropbtn" id="year-sem">Year-Sem</button>
							  <div class="dropdown-content">
							    <div onclick="year_sem('III-I')">III-I</div>
							    <div onclick="year_sem('III-II')">III-II</div>
							    <div onclick="year_sem('IV-I')">IV-I</div>
							  </div>
							</div>
						</li>
						<li class="main_nav_item">
							<div class="dropdown">
							  <button class="dropbtn"><?php echo ucwords($_SESSION['mgmt_username']);?></button>
							  <div class="dropdown-content">
							    <a href="changepassword.php">Change Password</a>
							    <a href="/FOE/common/logout.php">Logout</a>
							  </div>
							</div>
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="header_side d-flex flex-row justify-content-center align-items-center">
			<img src="../images/phone-call.svg" >
			<span>xxx xxx xxxx</span>
		</div>
	</header>

	</div>
	
	<!-- Home -->

	<div class="home">

		<!-- Hero Slider -->
		<div class="hero_slider_container">
			<div class="hero_slider owl-carousel">
				
				<!-- Hero Slide -->
				<div class="hero_slide">
					<div class="hero_slide_background" style="background-image:url(../images/slider_background.jpg)"></div>
				</div>
				
			</div>
		</div>

	</div>

	<div class="hero_boxes">
		<div class="hero_boxes_inner" style='top: -414px;'>
			<div class="container">
				<div class="row">
						<div class="col-lg-4 hero_box_col" onclick='check(1)'>
							<div class="hero_box d-flex flex-row align-items-center justify-content-start">
								<img src="../images/books.png" >
								<div class="hero_box_content">
									<h2 class="hero_box_title">Submitted List</h2>
									<a onclick='check(1)' class="hero_box_link">Login</a>
								</div>
							</div>
						</div>

						<div class="col-lg-4 hero_box_col" onclick='check(2)'>
							<div class="hero_box d-flex flex-row align-items-center justify-content-start">
								<img src="../images/paper.png">
								<div class="hero_box_content">
									<h2 class="hero_box_title">Alloted List</h2>
									<a onclick='check(2)' class="hero_box_link">Login</a>
								</div>
							</div>
						</div>

						<div class="col-lg-4 hero_box_col" onclick='check(3)'>
							<div class="hero_box d-flex flex-row align-items-center justify-content-start">
								<img src="../images/exam.png">
								<div class="hero_box_content">
									<h2 class="hero_box_title">Unalloted List</h2>
									<a onclick='check(3)' class="hero_box_link">Login</a>
								</div>
							</div>
						</div>
				</div>
				<br><br>
				<div class="row">
					<div class="col-lg-4 hero_box_col" onclick='check(4)'>
						<div class="hero_box d-flex flex-row align-items-center justify-content-start">
							<img src="../images/chair.png" >
							<div class="hero_box_content">
								<h2 class="hero_box_title">Track No. of Seats</h2>
								<a onclick='check(4)' class="hero_box_link">Login</a>
							</div>
						</div>
					</div>

					<div class="col-lg-4 hero_box_col" onclick='check(5)'>
						<div class="hero_box d-flex flex-row align-items-center justify-content-start">
							<img src="../images/analysis.png" >
							<div class="hero_box_content">
								<h2 class="hero_box_title">Analysis</h2>
								<a onclick='check(5)' class="hero_box_link">Login</a>
							</div>
						</div>
					</div>

					<div class="col-lg-4 hero_box_col">
						<a href="/FOE/common/Flask/Excel File/File Formats/Student_Validation_Format.xlsx" download="students_data.xlsx">
							<div class="hero_box d-flex flex-row align-items-center justify-content-start">
								<img src="../images/download.png" >
								<div class="hero_box_content">
									<h2 class="hero_box_title">Download Excel File Format</h2>
									<a class="hero_box_link" >Login</a>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
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