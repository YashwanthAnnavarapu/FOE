<?php
session_start();
if(!(isset($_SESSION['admin_username'])) && !(isset($_SESSION['mgmt_username'])))
    header("Location: /FOE/index.html");
  // if(!(isset($_SESSION['admin_username'])))
  //   header("Location: /FOE/index.html");

  // if(!(isset($_SESSION['mgmt_username'])))
  // header("Location: /FOE/index.html");
?>
<!DOCTYPE html>
<script src="ListGeneration.js" type="text/javascript"></script>
<script type="text/javascript">
    // function excel_download()
    // {
    //  var branch=document.getElementById("branch").value;
    //  var oe_sub='NULL';
    //  try
    //  {
    //   oe_sub=document.getElementById("sub").value;
    //  }
    // catch(err){}
    //  var title=document.getElementById("title").innerText;
    //  // alert(title);


    // // if(window.XMLHttpRequest)
    // //   xmlhttp=new XMLHttpRequest();
    // // else
    // //   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

    //  // xmlhttp.onreadystatechange=function()
    //  // {
    //  //  if(this.readyState==4&&this.status==200);
    //  //  {
    //  //    document.getElementById("crazy").innerHTML=this.responseText;
    //  //    alert(this.responseText);
    //  //  }

    //  // };
    //  // xmlhttp.open("GET","excel_download.php?branch="+branch+"&list="+title+"&oe_sub="+oe_sub,true);
    //  // xmlhttp.send();
    //  window.open("excel_download.php?branch="+branch+"&list="+title+"&oe_sub="+oe_sub);
    // }
</script>
<html>
  <head>
    <title>List Generation</title>
    <style>
      #one
      {
        position:absolute;
        width:100%;
        text-align:center;
      }
      #two
      {
        top:23%;
        left:5%;
        width:80%;
        position:absolute;
      }
      #tw
      {
        left:1%;
        width:97%;
        position: absolute;
      }
	#branch,#sub
	{
	padding:10px;
	border-radius:10px;
	}
	.bsd
  {
  padding:17px;
  font-size:20px
  }
    </style>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  </head>
  <body>

      <div id="">
            <center>
          <font size="10" face="Times of Roman">Vidya Jyothi Institute of Technology</font><br>
            An Autonomous Institution
            <br>
            (Accredited by NAAC & NBA, Approved by AICTE, Permanently Affiliated to JNTUH, Hyderabad)

    </center>
          <br><br>
          
            <table  width='100%'>
              <tr width="33%">
              <td id='crazy'></td>
              <td align='center' width="33%">
              <u><font size="5" face="Times of Roman" id='title'>
                <?php 
                  echo $_GET['title']."</font><font size='5' face='Times of Roman'> :".$_SESSION['year-sem'];
                ?></font></u></td>
              <td width="33%" >
                <a style="padding: 0px 0px 0px 50px;" href=""> 
                 
                  <img src="/FOE/images/excel.png" width='5.7%' height="5%" onclick='excel_download()'>
                  <u><font size="4" face="Times of Roman" onclick='excel_download()'>Download</font></u>
                   
                </a>
              </td></tr>
            </table>
          <br>
      </div>
              
      <center>
      <div id='one'>
        
      </div>
      <div id="two">
      </div>
    </center>
  </body>
</html> 