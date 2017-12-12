<?php
include_once 'connect.php';

error_reporting(E_ALL ^ E_DEPRECATED);
session_set_cookie_params(0);
session_start();
if (!isset($_SESSION["userID"])or ($_SESSION["role"]!="User")) {
    header("Location: login.php");
}
$success="";
$uid = $_SESSION["userID"];
$query = "SELECT *
FROM   USER u,account a,accounttype ac,branch b
WHERE  u.`userid`=a.`userid`
AND    a.`AccountTypeID`=ac.`AccountTypeID`
AND    u.`BranchCode`=b.`BranchCode`
AND    u.`userid`='$uid'";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_array($result)) {
    $accountno = $row["AccountNo"];
    $owner = $row["OwnerName"];
    $nrc = $row["NRC"];
    $odate=  date($row["OpenDate"]);
    $email=$row["email"];
    $addr=$row["address"];
    $pho=$row["phono"];
    
    
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
        <script language="javascript" src="calendar/calendar.js"></script>
    </head>
    <body>
        <script src="bootstrap/js/jquery.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <nav class="navbar navbar-inverse navbar-fixed-top ">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        Online Banking System</a>
                </div>
                <div>
                    <ul class="nav navbar-nav navbar-right">
                        <li> <span class="navbar-text">Welcome!</span></li>
                        <li class="active"><a href="profile.php"><?php echo $owner ?></a></li>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Personal Banking
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Saving Account</a></li>
                                <li><a href="#">Fixed Account</a></li>
                            </ul>
                        </li>
                        <li><a target="_blank" href="faq.php">FAQS</a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out">&#32;</span>&#32;&#32;Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <br/><br/><br/><br/>
        <h2 class="text-center text-primary">Customer Control Panel</h2>
        <div class="container-fluid bg-grey">

            <div class="row">
                <div class="col-lg-2">
                    <ul class="nav nav-pills nav-stacked text-center">
                        <li ><a href="customer.php">Transaction</a></li>
                        <li class="active"><a href="profile.php">Update Profile</a></li>
                        

                    </ul>
                </div>
                <div class="col-lg-10">

                    <ul class="nav nav-tabs nav-justified">
                        <li ><a href="customer.php">Customer Control Panel</a></li>
                        <li class="active"><a data-toggle="pill" href="#menu2">Update Profile</a></li>
                    </ul>

                    <div class="tab-content">
                        <?php

if (isset($_POST['btnupdate'])) {

    $newemail=  mysqli_real_escape_string($connection,$_POST["email"]);
    $newaddr=  mysqli_real_escape_string($connection,$_POST["addr"]);
    $newpho=  mysqli_real_escape_string($connection,$_POST["phone"]);
    $query2 = "UPDATE user SET email='$newemail',address='$newaddr',phono='$newpho' WHERE userid='$uid'";
    mysqli_query($connection, $query2);
    $success="Profile updated successfully";
       

}
?>

                        <div id="menu2" class="tab-pane fade in active">
                            <h3>Account Info</h3>
                            <h3><span class="label label-success col-lg-offset-4"><?php echo $success ?></span></h3>
                            <form enctype="multipart/form-data" class="form-horizontal col-lg-5 col-lg-offset-2" method="POST" action="#">
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">AccountID</label>
                                    <div class="col-sm-9">
                                        <input name="account" type="text" value="<?php echo $accountno ?>" class="form-control"  disabled="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Owner Name</label>
                                    <div class="col-sm-9">
                                        <input name="ownername" type="text" value="<?php echo $owner ?>" class="form-control"  disabled="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">NRC</label>
                                    <div class="col-sm-9">
                                        <input name="nrc" type="text" value="<?php echo $nrc ?>" class="form-control" disabled="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Open Date</label>
                                    <div class="col-sm-9">
                                        <input name="nrc" type="text" value="<?php echo $odate ?>" class="form-control" disabled="">
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input name="email" type="email" value="<?php echo $email ?>" class="form-control" required="">
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Address</label>
                                    <div class="col-sm-9">
                                        <input name="addr" type="text" class="form-control" value="<?php echo $addr ?>" >
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Contact No</label>
                                    <div class="col-sm-9">
                                        <input name="phone" type="text" value="<?php echo $pho ?>" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-5 col-sm-10">
                                        <input name="btnupdate" type="submit" class="btn btn-lg btn-success" value="Update Info">
                                    </div>
                                </div>

                            </form>
                            <br/>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <footer class="footer2">
            <div class="container" style="padding-top: 15px;"> 
                <center><h4><span class="label label-success white">© All Rights Reserved | Design by&nbsp; SOETHUHEIN</span></h4></center>
            </div>
        </footer> 
    </body>

</html>