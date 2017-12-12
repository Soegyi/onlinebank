<?php
include_once '../connect.php';
error_reporting(E_ALL ^ E_DEPRECATED);
session_set_cookie_params(0);
session_start();
$role=$_SESSION["role"];
if (!isset($_SESSION["userID"])or ($role !="Administrator")) {
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
                        <li> <span class="navbar-text">Welcome!</span></li>
                        <li class="active"><a href="#"><?php echo $_SESSION["userName"] ?></a></li>
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
                        <li><a href="manage.php">Manage Accounts</a></li>
                        <li class="active"><a href="history.php">Transaction History</a></li>
                        

                    </ul>
                </div>
                <div class="col-lg-10">

                    <ul class="nav nav-tabs nav-justified">
                        <li ><a href="manage.php">Admin Control Panel</a></li>
                        <li class="active"><a data-toggle="pill" href="#menu2">Transaction History</a></li>
                    </ul>

                    <div class="tab-content" style="overflow-y: scroll;height: 600px;">

                        <div id="menu2" class="tab-pane fade in active">
                            <h3>History of all transactions</h3>
<?php
$query = "SELECT *
FROM   account a,branch b,transactions t,transactiontype tc,USER u,accounttype at
WHERE  u.`userid`=a.`userid`
AND    u.`BranchCode`=b.`BranchCode`
AND    a.`AccountNo`=t.`AccountNo`
AND    a.AccountTypeID=at.AccountTypeID
AND    t.`TransactionTypeID`=tc.`TransactionTypeID`";
$result = mysqli_query($connection, $query);
                                echo '<table class="table table-bordered">';
                                echo '<thead>';
                                echo '<tr style="background-color: captiontext">';
                                echo '<th>TransactionID</th>';
                                echo '<th>Transaction Date</th>';
                                echo '<th>AccountNo</th>';
                                echo '<th>Recepient</th>';
                                echo '<th>Owner Name</th>';
                                echo '<th>Transaction-Type</th>';
                                echo '<th>Amount</th>';

                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                while ($row = mysqli_fetch_array($result)) {
                                    $tid = $row["TransactionID"];
                                    $date = $row["TransactionDate"];
                                    $aid = $row["AccountNo"];
                                    $recep = $row["Recepient"];
                                    $ttype = $row["TransactionTypeName"];
                                    $amount = $row["Amount"];
                                    $owner = $row["OwnerName"];
                                    echo '<tr>';
                                    echo '<td>' . $tid . '</td>';
                                    echo '<td>' . $date . '</td>';
                                    echo '<td>' . $aid . '</td>';
                                    echo '<td>' . $recep . '</td>';
                                    echo '<td class="text-uppercase">' . $owner . '</td>';
                                    echo '<td>' . $ttype . '</td>';
                                    echo '<td>' . $amount . '</td>';
                                    echo '</tr>';
                                }
                                echo '</tbody>';
                                echo '</table>';  

?>
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