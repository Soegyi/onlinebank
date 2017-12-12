<?php
include_once 'connect.php';
session_set_cookie_params(0);
session_start();


if (!isset($_SESSION["userID"])or ($_SESSION["role"]!="User")){
    header("Location: login.php");
}


                
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
        <script>
            function ShowLoginError(optShow) {

                document.getElementById("message").style.display = optShow;
            }
            ;
        </script>

    </head>
    <body>
        <script src="bootstrap/js/jquery.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <div class="container navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    Online Banking System</a>
            </div>
            <div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">Home</a></li>
                    <li><a  href="#">Personal Banking</a></li>
                    <li><a target="_blank" href="faq.php">FAQs</a></li>
                    <li  class="active"><a href="#">LogIn</a></li>
                </ul>
            </div>
        </div>



        <div class="container text-center">
            <h1 class="white">Enter OTP Code</h1>

            <form class="form-horizontal col-lg-5 col-lg-offset-3" method="POST" action="#">
                <div class="col-sm-10 col-sm-offset-2"><h3> <span class="label label-danger"id="message" style=" display: none">
                            *** Invalid OTP code ***
                        </span></h3></div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" class="form-control" id="password" placeholder="enter OTP code from your email" name="otp" required="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="chkotp"  class="btn btn-success btn-lg btn-block">Validate</button>
                    </div>
                </div>
            </form>
     </div>
                <?php
        $uid = $_SESSION["userID"];
        $query = "select otp from user where userid = '$uid'";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($result)) {
            $otp = $row["otp"];
        }

        error_reporting(\E_ALL ^ \E_DEPRECATED);
        if (isset($_POST['chkotp'])) {
            if ($otp == $_POST["otp"]) {
                session_start();
                header("location:customer.php");
            } else {
                echo '<script language = "javascript">'
                , 'ShowLoginError("");'
                , '</script>';
            }
        }
        ?>

    </body>
    <footer class="footer2">
        <div class="container" style="padding-top: 15px;"> 
            <center><h4><span class="label label-success white">© All Rights Reserved | Design by&nbsp; SOETHUHEIN</span></h4></center>
        </div>
    </footer>  
</html>