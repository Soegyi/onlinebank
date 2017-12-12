<?php
include_once '../connect.php';
session_start();
$role=$_SESSION["role"];
if (!isset($_SESSION["userID"])or ($role !="Administrator")) {
    header("Location: login.php");
}

$acid = $_GET["userid"];

$query = "SELECT * FROM user u,account a,accounttype ac WHERE  u.`userid`=a.`userid` AND a.`AccountTypeID`=ac.`AccountTypeID` AND AccountNo=$acid";
$result = mysqli_query($connection, $query);

function Display($accountno, $balance) {
    $output = <<< HERE
        <tr>
            <td>
                $accountno
            </td>
         <td>$$balance</td>
        </tr>
      
HERE;
    echo $output;
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
        <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="../bootstrap/css/style.css" rel="stylesheet">
        <script language="javascript" src="../calendar/calendar.js"></script>
    </head>
    <body>
        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../bootstrap/js/bootstrap.js"></script>
        <nav class="navbar navbar-inverse navbar-fixed-top ">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        Online Banking System</a>
                </div>
                <div>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Personal Banking
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Saving Account</a></li>
                                <li><a href="#">Fixed Account</a></li>
                            </ul>
                        </li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out">&#32;</span>&#32;&#32;Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <br/><br/><br/><br/>
        <h2 class="text-center text-primary">Admin Control Panel</h2>
        <div class="container-fluid bg-grey">

            <div class="row">
                <div class="col-lg-2">
                    <ul class="nav nav-pills nav-stacked text-center">
                        <li ><a href="admin.php">Report</a></li>
                        <li class="active"><a href="manage.php">Manage Accounts</a></li>
                        <li><a href="history.php">Transaction History</a></li>
                        

                    </ul>
                </div>
                <div class="col-lg-10">

                    <ul class="nav nav-tabs nav-justified">
                        <li ><a href="manage.php">Admin Control Panel</a></li>
                        <li class="active"><a data-toggle="pill" href="#menu2">Manage Accounts</a></li>
                    </ul>

                    <div class="tab-content">

                        <div id="menu2" class="tab-pane fade in active">
                            
<?php
    $succ="";
while ($row = mysqli_fetch_array($result)) {
    $accountno = $row["AccountNo"];
    $balance = $row["Balance"];
    $owner = $row["OwnerName"];
    $nrc = $row["NRC"];
    $usrid = $row["userid"];
}
if (isset($_POST['btnupdateinfo'])) {

    $newowner = $_POST["ownername"];
    $newnrc = $_POST["nrc"];
    $query2 = "UPDATE user SET OwnerName='$newowner',NRC='$newnrc' WHERE userid='$usrid'";
    mysqli_query($connection, $query2);
    $succ="User Info is successfully updated !!";
//    header("location:updateuserinfo.php?userid=$acid");
    
}
?>

                               <h3>Account Info</h3>
                               <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="label label-success col-lg-offset-3"><?php echo $succ ?></span></h3>
                            <form enctype="multipart/form-data" class="form-horizontal col-lg-5 col-lg-offset-2" method="POST" action="">
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Owner Name</label>
                                    <div class="col-sm-9">
                                        <input name="ownername" type="text" value="<?php echo $owner ?>" class="form-control"  placeholder="Name of account owner">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">NRC</label>
                                    <div class="col-sm-9">
                                        <input name="nrc" type="text" value="<?php echo $nrc ?>" class="form-control" placeholder="NRC of owner">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-5 col-sm-10">
                                        <input name="btnupdateinfo" type="submit" class="btn btn-lg btn-success" value="Update Info">
                                    </div>
                                </div>

                            </form>
                            <br/>


                            <table class="table table-condensed"> 
                                <thead> 
                                    <tr> 
                                        <th>AccountID</th> 
                                        <th>Balance</th>
                                    </tr>
                                </thead>
<?php
Display($accountno, $balance);
?>
                            </table>


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