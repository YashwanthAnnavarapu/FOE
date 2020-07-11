<?php
  session_start();
if(!isset($_SESSION['admin_username']))
  header("Location: index.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style type="text/css">
  #two
  {
    left:25%;
      right:25%;
      width:50%;
    /*background-color:#ff8533;
    border-radius:15px;
    padding:10px;*/
  }
  form
  {
    background-color:#ff8533;
    border-radius:15px;
    padding:10px;
  }
 fieldset
 {
  border-radius:10px;
  padding:20px;
  border:5px solid black;
 }
  .try
  {
    border-radius:10px;
    padding: 10px;
    background-color: #ffffff;
  }

  </style>
  <script>
  </script>
</head>
<body>
  <center>
          <div>
            <h2>ALLOT SEATS TO STUDENTS:<?php echo $_SESSION['year-sem']; ?></h2>
          </div>
  </center>
  <div id="three">
          <center>
                <br>
                <div id='two'><fieldset style="">
                  <form action="algorithm.php" method='post'>
                      <table  width=100% id='student_details'>
                          <tr>
                              <th width="200px" align="center"  class="try" id="eid">Employee ID</th>
                              <th><input type="text" name="" style="width:350px;" class="try" value='<?php echo $_SESSION['eid']?>' DISABLED></th>
                          </tr>
                          <tr><th></th><th></th></tr>
                          <tr><th></th><th></th></tr>
                          <tr>
                            <th width="200px" align="centert" class="try" id='ename'>Employee Name</th>
                            <th><input type="text" name="" class="try" style="width:350px;" value='<?php echo $_SESSION['admin_username']?>' DISABLED></th>
                          </tr>
                          <tr><th></th><th></th></tr>
                          <tr><th></th><th></th></tr>
                          <tr><th></th><th></th></tr>
                          <tr>
                              <th colspan="2"><input type="submit" name="confirm" style="width:50%;border-radius:10px;padding:10px;  background-color:#33ff33;" value="CONFIRM TO ALLOT SEATS"></th>
                          </tr>
                        </table>
                    </form>
                </fieldset></div>
                    <br>
          </center>
    </div>
</body>
</html>