 <?php
 include_once 'smtpMailer.php';
	$to   =$_SESSION['email'];
    $from = 'vjitopenelective@gmail.com';
    $name = '';
    $subj = 'VJIT OPEN ELECTIVE';
    $msg  = 'Your One Time Password is:'.$otp;
    
    $mail_response=smtpmailer($to,$from, $name ,$subj, $msg);
?>
html>
    <head>
        <title>Testing PHPMailer</title>
    </head>
    <body style="background: black;">
        <center><h2 style="padding-top:70px;color: white;"><?php echo $response; ?></h2></center>
    </body>
    
</html>