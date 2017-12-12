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
        <link href="../bootstrap/css/style.css" rel="stylesheet">
        <script language="javascript" src="../calendar/calendar.js"></script>
        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../bootstrap/js/bootstrap.js"></script>
    </head>
    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        Online Banking System</a>
                </div>
                <div>
                    <ul class="nav navbar-nav navbar-right">
                        <li> <span class="navbar-text">Welcome!</span></li>
                        <li class="active"><a href="#"><span class="glyphicon glyphicon-user">&nbsp; </span><?php echo $_SESSION["userName"] ?></a></li>
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
                        <li class="active"><a href="admin.php">Report</a></li>
                        <li><a href="manage.php">Manage Accounts</a></li>
                        <li><a href="history.php">Transaction History</a></li>
                    </ul>
                </div>
                <div class="col-lg-10">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a data-toggle="pill" href="#home">Monthly</a></li>
                        <li><a data-toggle="pill" href="#menu1">Account</a></li>
                        <li><a data-toggle="pill" href="#menu2">Deposit</a></li>
                    </ul>

                    <div class="tab-content" style="overflow-y: scroll;height: 600px;">
                        <div id="home" class="tab-pane fade in active" >


                            <h3>Monthly Transaction Report</h3>
                            <form enctype="multipart/form-data" class="form-horizontal col-lg-5 col-lg-offset-2" method="POST" action="#">
                                <div class="form-group">   
                                    <label class="col-sm-3 control-label">From</label> 
                                    <div class="col-sm-8"> 
                                        <span class="form-control inpu-sm">
                                            <?php
                                            require_once('../calendar/classes/tc_calendar.php');
                                            $myCalendar = new tc_calendar("start", true);
                                            $myCalendar->setDate(date('d',1), date('m','1'), date('Y','2017'));
                                            $myCalendar->setPath("../calendar/");
                                            //$myCalendar->setYearInterval(2018,2017);
                                            $myCalendar->dateAllow('2017-1- 1', '2017-12-31');
                                            $myCalendar->writeScript();
                                            ?> 
                                        </span>
                                    </div> 
                                </div>
                                <div class="form-group">   
                                    <label class="col-sm-3 control-label">To</label> 
                                    <div class="col-sm-8"> 
                                        <span class="form-control">
                                            <?php
                                            require_once('../calendar/classes/tc_calendar.php');
                                            $myCalendar = new tc_calendar("end", true);
                                            $myCalendar->setDate(date('d'), date('m'), date('Y'));
                                            $myCalendar->setPath("calendar/");
                                            $myCalendar->setYearInterval(2017, 2020);
                                            //$myCalendar->dateAllow('2015-01-01', '2016-12-31');
                                            $myCalendar->writeScript();
                                            ?> 
                                        </span>
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-6 col-sm-8">
                                        <button name="btngenerate" type="submit" class="btn btn-lg btn-primary">Generate Report</button>
                                    </div>
                                </div>
                            </form>
                           
                            <?php
                            if (isset($_POST["btngenerate"])) {
                                $from = $_POST["start"];
                                $to = $_POST["end"];

                                $query = "SELECT *
FROM   account a,branch b,transactions t,transactiontype tc,USER u,accounttype at
WHERE  u.`userid`=a.`userid`
AND    u.`BranchCode`=b.`BranchCode`
AND    a.`AccountNo`=t.`AccountNo`
AND    a.AccountTypeID=at.AccountTypeID
AND    t.`TransactionTypeID`=tc.`TransactionTypeID`
AND    DATE(TransactionDate) BETWEEN '$from' AND '$to'";

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
                              
                            }
                            ?>
                            
                        </div>
                        <div id="menu1" class="tab-pane fade">

                            <?php
                            $total="";
                            $que="SELECT COUNT(AccountNo) AS Allaccount FROM account";
                            $res=  mysqli_query($connection, $que);
                            $fetch=  mysqli_fetch_array($res);
                            $total=$fetch["Allaccount"];
                            
                            $query = "SELECT * FROM user u,account a,accounttype ac,branch b "
                                    . "WHERE  u.`userid`=a.`userid`"
                                    . " AND a.`AccountTypeID`=ac.`AccountTypeID` AND u.BranchCode=b.BranchCode";
                            $result = mysqli_query($connection, $query);

                            function Displayaccount($accountno, $balance, $owner, $opendate, $accountType, $branchname, $pho, $mail) {
                                $output = <<< HERE
    <tr>
        <td>$accountno</td>
         <td>$$balance</td>
         <td>$owner</td>
         <td>$opendate</td>
          <td>$accountType</td>
         <td>$branchname</td>
         <td>$pho</td>
         <td>$mail</td>
     
     
    </tr>
      
HERE;
                                echo $output;
                            }
                            ?>
                            <h3>Accounts Report</h3>
                            <h3 class="">There are <span class="label label-default"><?php echo $total ?></span> accounts in our banks.</h3>
                            <form>
                                <table class="table table-condensed"> 
                                    <thead> 
                                        <tr> 
                                            <th>AccountID</th> 
                                            <th>Balance</th>
                                            <th>Owner</th> 
                                            <th>Opendate</th>
                                            <th>Account Type</th>
                                            <th>Branch</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                        </tr> 
                                    </thead> 
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $accountno = $row["AccountNo"];
                                            $balance = $row["Balance"];
                                            $uid = $row["userid"];



                                            Displayaccount($row["AccountNo"], $row["Balance"], $row["OwnerName"], $row["OpenDate"], $row["AccountTypeName"], $row["BranchName"], $row["phono"], $row["email"]);
                                        }if (isset($_POST["btndelete"])) {
                                            $query = "DELETE FROM USER WHERE userid=$uid";
                                            mysqli_query($connection, $query);
                                        }
                                        ?>        

                                    </tbody> 
                                </table> 
                            </form>
                        </div>
                        <div id="menu2" class="tab-pane fade">

                            <?php
                            $query = "SELECT * FROM deposit d,account a,accounttype ac,USER u,branch b
WHERE  b.`BranchCode`=u.`BranchCode`
AND    a.`userid`=u.`userid`
AND    ac.AccountTypeID=a.`AccountTypeID`
AND    a.`AccountNo`=d.AccountNo";
                            $result = mysqli_query($connection, $query);

                            function Displaydeposit($accountno, $owner, $depositdate, $accountType, $branchname, $amount,$approve) {
                                $output = <<< HERE
    <tr>
        <td>$accountno</td>
         <td>$owner</td>
         <td>$depositdate</td>
          <td>$accountType</td>
         <td>$branchname</td>
         <td>$amount</td>
         <td>$approve</td>
         
     
     
    </tr>
      
HERE;
                                echo $output;
                            }
                            ?>        
                            <h3>Deposit Report</h3>

                            <table class="table table-condensed"> 
                                <thead> 
                                    <tr style="background-color: captiontext"> 
                                        <th>AccountID</th> 
                                        <th>OwnerName</th>
                                        <th>Date Of Deposit</th> 
                                        <th>Account Type</th>
                                        <th>Branch Name</th>
                                        <th>Amount</th>
                                        <th>Approved By</th>

                                    </tr> 
                                </thead> 
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $accountno = $row["AccountNo"];
                                        $balance = $row["Balance"];
                                        Displaydeposit($row["AccountNo"], $row["OwnerName"], $row["DateOfDeposit"], $row["AccountTypeName"], $row["BranchName"], $row["Amount"],$_SESSION["userName"]);
                                    }
                                    ?>   
                                </tbody> 
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