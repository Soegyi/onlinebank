<?php
include_once 'connect.php';
error_reporting(E_ALL ^ E_DEPRECATED);
//session_set_cookie_params(0);
session_start();
if (!isset($_SESSION["userID"])or ($_SESSION["role"]!="User")){
    header("Location: login.php");
}
$show="";
$succed="";
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
    $balance = $row["Balance"];
    $owner = $row["OwnerName"];
    $nrc = $row["NRC"];
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
        <link href="bootstrap/css/style.css" rel="stylesheet">
        <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                $('#my_se').change(function () {
                    if ($(this).val() === 'TT100') {
                        $('#second').attr('disabled', 'disabled');
                    }
                    else if ($(this).val() === 'TT102') {
                        $('#second').attr('disabled', 'disabled');
                    }
                    else if ($(this).val() === 'Choose') {
                        $('#second').attr('disabled', 'disabled');
                    }
                    else {
                        $('#second').attr('disabled', false);
                    }
                });

            });
        </script>
    </head>
    <body>


        <nav class="navbar navbar-inverse navbar-fixed-top ">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        Online Banking System</a>
                </div>
                <div>
                    <ul class="nav navbar-nav navbar-right">
                        <li> <span class="navbar-text">Welcome!</span></li>
                        <li class="active"><a href="profile.php"><span class="glyphicon glyphicon-user">&nbsp; </span><?php echo $owner ?></a></li>
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
        <h2 class="text-center text-primary">Customer Panel</h2>
        <div class="container-fluid bg-grey">
            <div class="row">
                <div class="col-lg-2">
                    <ul class="nav nav-pills nav-stacked text-center">
                        <li class="active"><a href="customer.php">Transaction</a></li>
                        <li><a href="profile.php">Update Profile</a></li>
                        
                    </ul>
                </div>
                <div class="col-lg-10">

                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a data-toggle="pill" href="#home">Tranfer</a></li>
                        <li><a data-toggle="pill" href="#menu1">Balance Enquiry</a></li>
                        <li><a data-toggle="pill" href="#menu2">Transaction History</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <h2>&nbsp&nbsp;<span class="label label-info">Fund Transfer</span></h2>
                            <?php
                           
                            
                            if (isset($_POST["btntransfer"])) {
                                if ($_POST["transaction"] === 'TT100') {
                                    $trans = $_POST["transaction"];
                                    $recepient = mysqli_real_escape_string(($connection), $_POST["recepient"]);
                                    $money = mysqli_real_escape_string(($connection), $_POST["amount"]);
                                   
                                    $aquery="SELECT * FROM account WHERE AccountNo='$recepient'";
                                    $res=  mysqli_query($connection, $aquery);
                                    if(mysqli_num_rows($res)>0 && $accountno!=$recepient){
                                            if($balance>$money && $money>0){
                                        $query = "INSERT INTO transactions(TransactionTypeID,Amount,Recepient,AccountNo)"
                                            . "VALUES('$trans',$money,'$recepient','$accountno')";
                                    mysqli_query($connection, $query);
                                    $query = "UPDATE account SET Balance=Balance + $money WHERE AccountNo=$recepient";
                                    mysqli_query($connection, $query);
                                    $query = "UPDATE account SET Balance=Balance - $money WHERE AccountNo=$accountno";
                                    mysqli_query($connection, $query);
                                        $succed="Money is successfully transferred to $recepient !!";
                                            }
                                             else {
                                                 $show="Invalid Amount of Money !!";
                                             }
                                    }
                                     else { 
                                         $show="Invalid AccountID !!!";
                                     }
                                    
                                    
                                } else if ($_POST["transaction"] === 'TT102') {
                                    $trans = $_POST["transaction"];
                                    $card = mysqli_real_escape_string($connection, $_POST["recepient"]);
                                    $money = mysqli_real_escape_string(($connection), $_POST["amount"]);
                                    $query="SELECT * FROM cards WHERE CardNo='$card'";
                                    $res=  mysqli_query($connection, $query);
                                    if(mysqli_num_rows($res)>0){
                                        if($money<$balance && $money>0){
                                            $query = "INSERT INTO transactions(TransactionTypeID,Amount,Recepient,AccountNo)"
                                                    . "VALUES('$trans',$money,'$card','$accountno')";
                                            mysqli_query($connection, $query);

                                            $query = "UPDATE cards SET Balance=Balance + $money WHERE CardNo=$card";
                                            mysqli_query($connection, $query);

                                            $query = "UPDATE account SET Balance=Balance - $money WHERE AccountNo=$accountno";
                                            mysqli_query($connection, $query);
                                            $succed="Money is successfully transferred to CardNo - $card ";
                                        }
                                        else {
                                            $show="Invalid Amount of Money !!";
                                        }
                                    }
                                    else {
                                        $show="Invalid CardNo !!!";
                                    }
                                } else if (($_POST["transaction"] === 'TT101')) {
                                            $trans = $_POST["transaction"];
                                            $nrc = mysqli_real_escape_string($connection, $_POST["recepient"]);
                                            $money = mysqli_real_escape_string(($connection), $_POST["amount"]);
                                            $bran = $_POST["branch"];

                                            if($bran!=''){
                                               
                                                if(preg_match("/^[0-9]{1}\/[a-zA-Z]{6}[(][N][)](\d{6}$)/i",$nrc) or (preg_match("/^[0-9]{2}\/[a-zA-Z]{6}[(][N][)](\d{6}$)/i",$nrc))){
                                                    if($balance>$money && $money>0){
                                                    $query = "INSERT INTO transactions(TransactionTypeID,Amount,Recepient,AccountNo)"
                                                    . "VALUES('$trans',$money,'$nrc','$accountno')";
                                            mysqli_query($connection, $query);

                                            $query = "INSERT INTO nrcrecepient(NRC,BranchCode)VALUES('$nrc','$bran')";
                                            mysqli_query($connection, $query);

                                            $query = "UPDATE account SET Balance=Balance - $money WHERE AccountNo=$accountno";
                                            mysqli_query($connection, $query);
                                            $succed="Money is successfully transferred to '$nrc'";
                                                    }
                                                    else {
                                                        $show="Invalid Money Amount!!";
                                                    }
                                                }
                                                else {
                                                    $show="Invalid NRC !!!";
                                                }
                                            }
                                            else {
                                                $show="Please choose a branch !!";
                                            }
                                            }
                            
                                
                                 else {
                                     $show="Please select a transaction-type first";
                                 }
                            }
                            ?>
                            <h3><span class="label label-danger col-lg-offset-4"><?php echo $show ?></span></h3>
                             <h3>&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;<span class="label label-success col-md-offset-3"><?php echo $succed ?></span></h3>
                            <form enctype="multipart/form-data" class="form-horizontal col-lg-5 col-lg-offset-2" method="POST" action="#"  >
                                <div class="form-group">
                                    <label for="branch" class="col-sm-3 control-label">TransactionType</label>
                                    <div class="col-sm-9">
                            <?php
                            $sql = "select TransactionTypeID,TransactionTypeName from transactiontype";
                            $q = mysqli_query($connection, $sql);
                            echo "<select id='my_se' name=\"transaction\" class=\"form-control\" style=\"text-align:center\">";
                            echo "<option>Choose</option>";
                            while ($row = mysqli_fetch_array($q)) {
//                                    echo "<option value=' ".$row['BranchCode']."'>".$row['BranchName']."</option>";
                                echo '<option value="' . $row['TransactionTypeID'] . '">' . $row['TransactionTypeName'] . ' </option>';
                            }
                            echo "</select>";
                            ?>

                                    </div>

                                </div>

                                <div class="form-group">   
                                    <label class="col-sm-3 control-label">Recepient</label> 
                                    <div class="col-sm-9"> 
                                        <input maxlength="20" name="recepient" class="form-control" id="focusedInput" type="text" placeholder="AccountID/CardID/NRC" required> 
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="exampleInputAmount">Amount</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <div class="input-group-addon">$</div>
                                            <input name="amount" type="number" class="form-control" id="exampleInputAmount" placeholder="Amount" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="branch" class="col-sm-3 control-label">BranchID</label>
                                    <div class="col-sm-9">
<?php
$sql = "select BranchCode,BranchName from branch";
$q = mysqli_query($connection, $sql);
echo "<select id='second' name=\"branch\" class=\"form-control\" style=\"text-align:center\">";
echo "<option value=''>Choose</option>";
while ($row = mysqli_fetch_array($q)) {
    echo '<option value="' . $row['BranchCode'] . '">' . $row['BranchName'] . ' </option>';
}
echo "</select>";
?>

                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-7 col-sm-10">
                                        <input name="btntransfer" type="submit" class="btn btn-lg btn-success" value="Transfer Money">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="menu1" class="tab-pane fade">
<?php
$query = "SELECT *
                                FROM   USER u,account a,accounttype ac,branch b
                                WHERE  u.`userid`=a.`userid`
                                AND    a.`AccountTypeID`=ac.`AccountTypeID`
                                AND    u.`BranchCode`=b.`BranchCode`
                                AND    u.`userid`='$uid'";
$result = mysqli_query($connection, $query);

function Displayaccount($accountno, $balance, $owner, $opendate, $accountType, $branchname, $pho, $mail) {
    $output = <<< HERE
    <tr>
        <td>
          <a href="profile.php?userid=$accountno">$accountno</a>
        </td>
         <td>$$balance</td>
         <td>$owner</td>
         <td>$opendate</td>
          <td>$accountType</td>
         <td>$branchname</td>
         <td>$pho</td>
         <td>$mail</td>
     
     <td>
         <a href="customer.php" class="btn btn-primary">Transfer</a>
    </td>
    </tr> 
HERE;
    echo $output;
}
?>
                              <h2>&nbsp&nbsp;<span class="label label-success">Balance Enquiry</span></h2>


                            <form class="form-horizontal col-lg-10" >
                                <table class="table table-bordered"> 
                                    <thead> 
                                        <tr style="background-color: captiontext;"> 
                                            <th>AccountID</th> 
                                            <th>Balance</th>
                                            <th>Owner Name</th>
                                            <th>Open Date</th>
                                            <th>Account Type</th>
                                            <th>Branch Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
<?php
while ($row = mysqli_fetch_array($result)) {
    Displayaccount($row["AccountNo"], $row["Balance"], $row["OwnerName"], $row["OpenDate"], $row["AccountTypeName"], $row["BranchName"], $row["phono"], $row["email"]);
}
?>

                                </table>   
                            </form>

                        </div>
                        <div id="menu2" class="tab-pane fade">
                                    <?php
                                    $query = "SELECT *
FROM   account a,branch b,transactions t,transactiontype tc,USER u
WHERE  u.`userid`=a.`userid`
AND    u.`BranchCode`=b.`BranchCode`
AND    a.`AccountNo`=t.`AccountNo`
AND    t.`TransactionTypeID`=tc.`TransactionTypeID`
AND    u.`userid`='$uid'";

                                    $result = mysqli_query($connection, $query);

                                    function Displaytransaction($date, $aid, $recep, $ttype, $amount) {
                                        $output = <<< HERE
                            <tr>
                                 <td>$date</td>
                                 <td>$aid</td>
                                 <td>$recep</td>
                                  <td>$ttype</td>
                                 <td>$$amount</td>
                            </tr> 
HERE;
                                        echo $output;
                                    }
                                    ?>                     

                            <h3>&nbsp&nbsp;<span class="label label-primary">Transaction History</span></h3>
                            <form class="form-horizontal col-lg-10" >
                                <table class="table table-bordered"> 
                                    <thead> 
                                        <tr style="background-color: captiontext;"> 
                                            <th>Date</th>
                                            <th>AccountID</th> 
                                            <th>Recepient</th>
                                            <th>TransactionType</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
<?php
while ($row = mysqli_fetch_array($result)) {
    Displaytransaction($row["TransactionDate"], $row["AccountNo"], $row["Recepient"], $row["TransactionTypeName"], $row["Amount"]);
}
?>

                                </table>   
                            </form>

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