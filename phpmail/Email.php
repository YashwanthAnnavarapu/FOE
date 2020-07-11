 <?php
 include_once 'smtpMailer.php';
	$to   ='yashwanthannavarapua9@gmail.com';
    $from = 'vjitopenelective@gmail.com';
    $name = '';
    $subj = 'VJIT OPEN ELECTIVE';
    $msg  = 'Your One Time Password is:'.'cars@123';
    
    $mail_response=smtpmailer($to,$from, $name ,$subj, $msg);
?>
html>
    <head>
        <title>Testing PHPMailer</title>
    </head>
    <body style="background: black;">
        <center><h2 style="padding-top:70px;color: white;"><?php echo $mail_response; ?></h2></center>
    </body>
    
</html>