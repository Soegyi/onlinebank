<?php
include_once 'connect.php';
session_set_cookie_params(0);
session_start();
session_destroy();
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
            <h1 class="white">LogIn to your Account</h1>
            <h3 class="white">After login an OTP code will be sent to your email address</h3>

            <form class="form-horizontal col-lg-5 col-lg-offset-3" method="POST" action="#">
                <div class="col-sm-10 col-sm-offset-2"><h3> <span class="label label-danger"id="message" style=" display: none">
                            *** Invalid username or password ***
                        </span></h3></div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" class="form-control" id="inputEmail3" placeholder="username" name="username" required="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" class="form-control" id="password" placeholder="password" name="password" required="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="btnsignin"  class="btn btn-success btn-lg btn-block">Sign in</button>
                    </div>
                </div>
            </form>
        </div>
<?php
error_reporting(\E_ALL ^ \E_DEPRECATED);
if (isset($_POST['btnsignin'])) {
    $user = mysqli_real_escape_string($connection, $_POST["username"]);
    $password = mysqli_real_escape_string($connection, $_POST["password"]);
    $query = mysqli_real_escape_string($connection, "SELECT userid,username,password,Role from user WHERE username=?");
    ($stmt = mysqli_prepare($connection, $query));

    /* bind parameters for markers */
    mysqli_stmt_bind_param($stmt, "s", $user);

    /* execute query */
    mysqli_stmt_execute($stmt);

    /* bind result variables */

    mysqli_stmt_store_result($stmt);
    $num_row = mysqli_stmt_num_rows($stmt);
    if ($num_row > 0) {
        mysqli_stmt_bind_result($stmt, $userid, $usr, $passw, $role);
        mysqli_stmt_fetch($stmt);
        if (password_verify($password, $passw)) {
            if ($role == 'Administrator') {
                session_start();
                $_SESSION["userID"] = $userid;
                $_SESSION["userName"] = $user;
                $_SESSION["role"] = $role;
                header("location:admin/manage.php");
            } else {
                $query = "select email from user where userid = '$userid'";
                $result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_array($result)) {
                    $mail = $row["email"];
                }
                $otp = strtoupper(bin2hex(openssl_random_pseudo_bytes(3)));
                $query = "update user set otp = '$otp' where userid = $userid";
                mysqli_query($connection, $query);
                $subject = "sending One Time PassWord";
                $body = "this email send for one time password. your one time password is  " . $otp;
                $header = "From :postmaster@localhost";
                mail($mail, $subject, $body, $header);
                

                session_start();
                $_SESSION["userID"] = $userid;
                $_SESSION["userName"] = $user;
                $_SESSION["role"] = $role;
                header("location:checkotp.php");
            }
        } else {
            echo '<script language = "javascript">'
            , 'ShowLoginError("");'
            , '</script>';
        }
    } else if ($num_row <= 0) {
        echo '<script language = "javascript">'
        , 'ShowLoginError("");'
        , '</script>';
    }

    /* close statement */
    mysqli_stmt_close($stmt);
}

/* close connection */
mysqli_close($connection);
?>

    </body>
    <footer class="footer2">
        <div class="container" style="padding-top: 15px;"> 
            <center><h4><span class="label label-success white">© All Rights Reserved | Design by&nbsp; SOETHUHEIN</span></h4></center>
        </div>
    </footer>  
</html>