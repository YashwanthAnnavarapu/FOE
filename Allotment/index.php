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
  <?php include_once('/xampp/htdocs/FOE/header.php'); ?>
<!-- Header End -->
  
  <!-- Home -->
  <div class="home" style="background-image:url(/FOE/images/slider_background.jpg);
     background-position: center;background-repeat: no-repeat;background-size: cover;">
    <center>
    <!-- form -->
      <form name="login"  method="post" class="login-form" action="Login_Validation.php" 
      style="width: 26%;right: 37%;">

              <div><img src="/FOE/images/professor.png" style="width: 25%;height: 15%;"></div>
              <br>
              <div class="txtb">
                <input type="text" name="rollno" size="40" placeholder="Rollno" required style="border-radius:7px;padding:5px;font-size: 15px;">
              </div>
              <br>
              <div class="txtb">
                <input type="password" name="password" placeholder="password" size="40" required style="border-radius:7px;padding:5px;font-size:15px;">
          <br><br>
              </div>

              <div>
                <center>
                <table width="70%"><tr align="center">
                  <td style="width:33.33%;">
                <input type="radio" id="III-I" name='year-semester' value="III-I"  checked>
                <label for="III-I"><font size="5" face="Times of Roman">III-I</font></label>
                  </td>
                  <td style="width:33.33%;">
                <input type="radio" id="III-II" name='year-semester' value="III-II">
                <label for="III-II"><font size="5" face="Times of Roman">III-II</font></label>
                  </td>
                  <td style="width:33.33%;">
                <input type="radio" id="IV-I" name='year-semester'  value="IV-I">
                <label for="IV-I"><font size="5" face="Times of Roman">IV-I</font></label>
                  </td>
                </tr></table></center>
              </div>

              <div>
                <br>
              <input type="submit" name="w_submit" class="logbtn" value="Login" style="border:5px solid #FFD700;border-radius: 15px;background-color:#FFD700;padding:0px 50px;color:#ffffff;font-size: 20px;">
            </div>
        </form>
    </center>
  </div>



  

  <!-- Footer start -->
  <?php include_once('/xampp/htdocs/FOE/footer.php')?>
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