<?php
session_start();
if(!(isset($_SESSION['admin_username'])))
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
	<!-- <link rel="stylesheet" href="home.css"> -->
	<script type="text/javascript" src="home.js"></script>
	
	<style type="text/css">
		#seven
		{
			position:absolute;
			top:5%;
			left:85%;
		}
		/*######################################################Toggle Slider Start##############################################*/
		.switch {
		  position: relative;
		  display: inline-block;
		  width: 50px;
		  height: 18px;
		}

		.switch input { 
		  opacity: 0;
		  width: 0;
		  height: 0;
		}

		.slider {
		  position: absolute;
		  cursor: pointer;
		  top: 0;
		  left: 0;
		  right: 0;
		  bottom: 0;
		  background-color: #a1a1a1;
		  -webkit-transition: .4s;
		  transition: .4s;
		}

		.slider:before {
		  position: absolute;
		  content: "";
		  height: 10px;
		  width: 10px;
		  left: 4px;
		  bottom: 4px;
		  background-color: white;
		  -webkit-transition: .4s;
		  transition: .4s;
		}

		input:checked + .slider {
		  background-color: #2196F3;
		}

		input:focus + .slider {
		  box-shadow: 0 0 1px #2196F3;
		}

		input:checked + .slider:before {
		  -webkit-transform: translateX(30px);
		  -ms-transform: translateX(30px);
		  transform: translateX(30px);
		}

		/* Rounded sliders */
		.slider.round {
		  border-radius: 34px;
		}

		.slider.round:before {
		  border-radius: 50%;
		}
		/*########################################################Toggle Slider End##############################################*/
		</style>
	</style>

	<script>
		function check(index)
		{
			if(document.getElementById("year-sem").innerText!="Year-Sem")
			{
				if(index=='1')
					SubmittedList();
				else if(index=='2')
					AllotedStudentsList();
				else if(index=='3')
					Unalloted_Students();
				else if(index=='4')
					allot_seats();
				else if(index=='5')
					Track_Seats();
				else if(index=='6')
					remove_student();
				else if(index=='7')
					Analysis();
				// else if(index=='7')
				// 	window.open("url2.php");
			}
			else
				alert("select year-semester");
		}

		function SubmittedList()
		{window.open("/FOE/common/ListGeneration.php?function=fun1()&title=Student's Submission List");}

		function AllotedStudentsList()
		{	window.open("/FOE/common/ListGeneration.php?function=fun2()&title=Alloted Students List");}

		function Unalloted_Students()
		{	window.open("/FOE/common/ListGeneration.php?function=fun3()&title=Unalloted Students List");}
		function allot_seats()								
		{
			window.location.href="/FOE/common/allot_seats.php";
		}
		function manual_process()								
		{
			window.location.href="/FOE/common/Flask/manual_data_file_upload.php";
		}
		function Track_Seats()
		{	window.open("/FOE/common/Tracking.php");	}

		function Analysis()
		{	window.open("/FOE/common/Analysis.php");	}	
		function students_data_file_upload()								
		{
			window.location.href="/FOE/common/Flask/students_data_file_upload.php";
		}
		function subjects_upload()
		{
			window.location.href="/FOE/common/Flask/subjects_data_file_upload.php";
		}
		function remove_student()
		{
		window.location.href="/FOE/common/Delete.php";
		}
		function year_sem(value)
		{
			document.getElementById("year-sem").innerHTML=value;
			change(value);
		}	
		function toggle()
		{
			tog();
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
							  <button class="dropbtn"><?php echo ucwords($_SESSION['admin_username']);?></button>
							  <div class="dropdown-content">
							    <a href="/FOE/common/changepassword.php">Change Password</a>
							    <a href="/FOE/common/logout.php">Logout</a>
							  </div>
							</div>
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="header_side d-flex flex-row justify-content-center align-items-center">
			<img src="../images/phone-call.svg" alt="">
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
		<div class="hero_boxes_inner" style="top:-414px;">
			<div class="container" style="overflow-y:scroll;height:400px;">
				<div class="row">
						<div class="col-lg-4 hero_box_col" onclick='check(1)'>
							<div class="hero_box d-flex flex-row align-items-center justify-content-start">
								<img src="../images/books.png" >
								<div class="hero_box_content">
									<h2 class="hero_box_title">Submitted List</h2>
									<a onclick='check(1)' class="hero_box_link">(Excel file Download Avaiable)</a>
								</div>
							</div>
						</div>

						<div class="col-lg-4 hero_box_col" onclick='check(2)'>
							<div class="hero_box d-flex flex-row align-items-center justify-content-start">
								<img src="../images/paper.png">
								<div class="hero_box_content">
									<h2 class="hero_box_title">Alloted List</h2>
									<a onclick='check(2)' class="hero_box_link">(Excel file Download Avaiable)</a>
								</div>
							</div>
						</div>

						<div class="col-lg-4 hero_box_col" onclick='check(3)'>
							<div class="hero_box d-flex flex-row align-items-center justify-content-start">
								<img src="../images/exam.png">
								<div class="hero_box_content">
									<h2 class="hero_box_title">Unalloted List</h2>
									<a onclick='check(3)' class="hero_box_link">(Excel file Download Avaiable)</a>
								</div>
							</div>
						</div>
				</div>
				<br><br>
				<div class="row">
					<div class="col-lg-4 hero_box_col" onclick='check(4)'>
						<div class="hero_box d-flex flex-row align-items-center justify-content-start">
							<img src="../images/allot-seats.png" >
							<div class="hero_box_content">
								<h2 class="hero_box_title">Seat Allotment</h2>
								<a onclick='check(4)' class="hero_box_link">(Auto Allotment)</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 hero_box_col">
							<div class="hero_box d-flex flex-row align-items-center justify-content-start">
								<img src="../images/keyboard.png" onclick='manual_process()'>
								<div class="hero_box_content">
									<h2 class="hero_box_title" onclick='manual_process()'>Manual Allocation File Upload</h2>
									<u><a class="hero_box_link" href="/FOE/common/Flask/Excel File/File Formats/Manual_File_Format.xlsx" download="manual_data.xlsx">Download File Format</a></u>
								</div>
							</div>
						</div>
					<div class="col-lg-4 hero_box_col" onclick='check(5)'>
						<div class="hero_box d-flex flex-row align-items-center justify-content-start">
							<img src="../images/chair.png" >
							<div class="hero_box_content">
								<h2 class="hero_box_title">Track No. of Seats</h2>
								<a onclick='check(5)' class="hero_box_link">(Status)</a>
							</div>
						</div>
					</div>	
				</div>
				<br><br>
				<div class="row">
						<div class="col-lg-4 hero_box_col" onclick='check(7)'>
							<div class="hero_box d-flex flex-row align-items-center justify-content-start">
								<img src="../images/analysis.png" >
								<div class="hero_box_content">
									<h2 class="hero_box_title">Subject Demand</h2>
									<a onclick='check(7)' class="hero_box_link">(Analysis)</a>
								</div>
							</div>
						</div>
						<div class="col-lg-4 hero_box_col">
							<div class="hero_box d-flex flex-row align-items-center justify-content-start">
								<img src="../images/upload.png" onclick='students_data_file_upload()'>
								<div class="hero_box_content">
									<h2 class="hero_box_title" onclick='students_data_file_upload()'>Upload Student's Data</h2>
									<u><a class="hero_box_link" href="/FOE/common/Flask/Excel File/File Formats/Students_Validation_Format.xlsx" download="students_data.xlsx">Download File Format</a></u>
								</div>
							</div>
						</div>

						<div class="col-lg-4 hero_box_col">
							<div class="hero_box d-flex flex-row align-items-center justify-content-start">
								<img src="../images/upload.png" onclick="subjects_upload()">
								<div class="hero_box_content">
									<h2 class="hero_box_title" onclick="subjects_upload()">Subject's Modification</h2>
									<u><a class="hero_box_link" href="/FOE/common/Flask/Excel File/File Formats/Subjects_File_Format.xlsx" download="subjects_data.xlsx">Download File Format</a></u>
								</div>
							</div>
						</div>			
				</div>
				<br><br>
				<div class="row">
						<div class="col-lg-4 hero_box_col" onclick='check(6)'>
							<div class="hero_box d-flex flex-row align-items-center justify-content-start">
								<img src="../images/books.png" >
								<div class="hero_box_content">
									<h2 class="hero_box_title">Remove Student Details</h2>
									<a onclick='check(6)' class="hero_box_link">(Delete Responses)</a>
								</div>
							</div>
						</div>
						<!-- <div class="col-lg-4 hero_box_col" onclick=''>
							<div class="hero_box d-flex flex-row align-items-center justify-content-start">
								<img src="../images/books.png">
								<div class="hero_box_content">
									<h2 class="hero_box_title">Access</h2>
									<table style="width: 150px;">
										<tr>
											<td><h3>III-I</h3></td>
											<td>
												<label class="switch">
												  <input type="checkbox" id='tg1' onclick="toggle()">
												  <span class="slider round"></span>
												</label>
											</td>
										</tr>
										<tr>
											<td><h3>III-II</h3></td>
											<td>
												<label class="switch">
												  <input type="checkbox" id='tg2' onclick="toggle()">
												  <span class="slider round"></span>
												</label>
											</td>
										</tr>
										<tr>
											<td><h3>IV-I</h3></td>
											<td>
												<label class="switch">
												  <input type="checkbox" id='tg3' onclick="toggle()">
												  <span class="slider round"></span>
												</label>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div> -->
				</div>
			</div>
		</div>
	</div>

<!-- Footer start -->
	<?php include_once('../footer.php')?>
<!-- Footer end-->

		</div>
	</footer>

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