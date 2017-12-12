<?php
    include_once 'connect.php';
    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Banking</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
     <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/style.css" rel="stylesheet">

  </head>
  <body>
    <script src="bootstrap/js/jquery.js"></script>
    <div class="container navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    Online Banking System</a>
            </div>
            <div>
              <ul class="nav navbar-nav navbar-right">
                  <li><a href="index.php">Home</a></li>
                <li><a  href="#">Personal Banking</a></li>
                <li class="active"><a href="faq.php">FAQs</a></li>
              </ul>
            </div>
        </div>
    


<div class="container">
    <h2><span class="label label-info">Frequently Ask Questions</span></h2>
    <br/>
    <h3>  <p class="label label-primary">How can I login into my account?</p><h3>
    <h4>  <p class="lead white">Click on <a href="login.php"><kbd>Log In</kbd></a> and enter UserName and Password for your account. </p></h4>
    <div class="row">
    <div class="col-md-7"> 
    <div class="thumbnail">
         <img src="picture/faq1.png" alt="...">
    </div>
    </div>
    </div>
    <h3>  <p class="label label-primary">Where can I find my current balance?</p><h3>
    <h4>  <p class="lead white">On Customer Panel, Click On <a href="login.php"><kbd>Balance Enquiry</kbd></a> tab and you will see your account status. </p></h4>
    <div class="row">
    <div class="col-md-7"> 
    <div class="thumbnail">
         <img src="picture/faq2.png" alt="...">
    </div>
    </div>
    </div>
    <h3>  <p class="label label-primary">How can I transfer my money to other account or card?</p><h3>
            <h4>  <p class="lead white">On Customer Panel, Click On <a href="login.php"><kbd>Transfer</kbd></a> tab or <button class="btn-primary">Transfer</button>
                    on your <kbd>Balance Enquiry</kbd> tab and choose a <strong>Transaction-Type</strong> and
                    enter your <i>Recepient</i>, also <kbd>Amount</kbd> to be transfer. Then click on <button class="btn btn-success">Transfer Money</button> to make fund transfer.
                </p></h4>
    <div class="row">
    <div class="col-md-7"> 
    <div class="thumbnail">
         <img src="picture/faq3.png" alt="...">
    </div>
    </div>
    </div>
    <h3>  <p class="label label-primary">Where can I look my transaction history?</p><h3>
    <h4>  <p class="lead white">On Customer Panel, Click On <a href="login.php"><kbd>Trannsaction History</kbd></a> tab and you can see the transactions you have done. </p></h4>
    <div class="row">
    <div class="col-md-7"> 
    <div class="thumbnail">
         <img src="picture/faq4.png" alt="...">
    </div>
    </div>
    </div>
    
</div>
    
   
  </body>
  <footer class="footer2">
            <div class="container" style="padding-top: 15px;"> 
                <center><h4><span class="label label-success white">© All Rights Reserved | Design by&nbsp; SOETHUHEIN</span></h4></center>
            </div>
        </footer>  
</html>