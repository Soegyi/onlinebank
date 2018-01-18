<?php
include_once '../connect.php';
error_reporting(E_ALL ^ E_DEPRECATED);
session_set_cookie_params(0);
session_start();
$role=$_SESSION["role"];
if (!isset($_SESSION["userID"])or ($role !="Administrator")) {
    header("Location: login.php");
}



$username = $password = $email = $ownername = $accid = $balance = $address = $phone = $dob = "";
$show=$succed="";
if (isset($_POST['btncreate'])) {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $nrc = test_input($_POST["nrc"]);
    $email = test_input($_POST["email"]);
    $ownername = test_input($_POST["ownername"]);
    $accid = test_input($_POST["accid"]);
    $balance = test_input($_POST["balance"]);
    $address = test_input($_POST["address"]);
    $phone = test_input($_POST["phone"]);
    $dob = $_POST["birthday"];
    $branch = $_POST["branch"];
    $actype = $_POST["accounttype"];

    $password = password_hash($password, PASSWORD_BCRYPT);
    $role = mysqli_real_escape_string($connection, $_POST["role"]);
    $query = "INSERT into user(username,password,NRC,email,address,phono,BranchCode,OwnerName,DateOfBirth,Role)"
            . "VALUES('$username','$password','$nrc','$email','$address','$phone','$branch','$ownername','$dob','$role')";
    mysqli_query($connection, $query);

    $lastid = mysqli_insert_id($connection);

    $query2 = "INSERT INTO account(AccountNo,Balance,userid,AccountTypeID)"
            . "VALUES('$accid',$balance,$lastid,'$actype')";
    if (mysqli_query($connection, $query2)) {
        $succed="Account Created Successfully !!";
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
}

//filter
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
         <script src="../bootstrap/js/jquery.js"></script>
         <script src="../bootstrap/js/bootstrap.js"></script>
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
                        <li ><a href="admin.php">Report</a></li>
                        <li class="active"><a href="manage.php">Manage Accounts</a></li>
                        <li><a href="history.php">Transaction History</a></li>

                    </ul>
                </div>
                <div class="col-lg-10">

                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a data-toggle="pill" href="#home">Create Account</a></li>
                        <li><a data-toggle="pill" href="#menu1">Deposit</a></li>
                        <li><a data-toggle="pill" href="#menu2">Manage Accounts</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <h3>Create a new User Account</h3>
                            <h3><span class="label label-danger col-lg-offset-4"><?php echo $show ?></span></h3>
                             <h3>&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;<span class="label label-success col-md-offset-3"><?php echo $succed ?></span></h3>
                            <form enctype="multipart/form-data" class="form-horizontal col-lg-5 col-lg-offset-2" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
                                <div class="form-group">
                                    <label for="user" class="col-sm-3 control-label">Username</label>
                                    <div class="col-sm-9">
                                        <input name="username" type="text" class="form-control" id="user" value=""  placeholder="Username" required>

                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                                    <div class="col-sm-9">
                                        <input name="password" type="password" class="form-control" id="inputPassword3" placeholder="password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="account-type" class="col-sm-3 control-label">Role</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="accont-type" name="role">
                                            <option>Administrator</option>
                                            <option>User</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">   
                                    <label class="col-sm-3 control-label">Email</label> 
                                    <div class="col-sm-9"> 
                                        <input name="email" class="form-control" id="email" type="email" placeholder="Email address of the user"> 
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Owner Name</label>
                                    <div class="col-sm-9">
                                        <input name="ownername" type="text" class="form-control" id="name" placeholder="Name of account owner" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">NRC</label>
                                    <div class="col-sm-9">
                                        <input name="nrc" type="text" class="form-control" id="name" placeholder="NRC of owner" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="accountid" class="col-sm-3 control-label">AccountID</label>
                                    <div class="col-sm-9">
                                        <input name="accid" type="text" class="form-control" id="accountid" placeholder="1234 1234 1234 1234" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="account-type" class="col-sm-3 control-label">Account-Type</label>
                                    <div class="col-sm-9">

                                        <?php
                                        $sql = "select AccountTypeID,AccountTypeName from accounttype";
                                        $q = mysqli_query($connection, $sql);
                                        echo "<select class=\"form-control\" name=\"accounttype\" style=\"text-align:center\">";
                                        while ($row = mysqli_fetch_array($q)) {
//                                    echo "<option selected="selected" value='".$row['AccountTypeID']."'>".$row['AccountTypeName']."</option>";
                                            echo '<option selected="selected" value="' . $row['AccountTypeID'] . '">' . $row['AccountTypeName'] . ' </option>';
                                        }
                                        echo "</select>";
                                        ?>

                                    </div>
                                </div>
                                <div class="form-group">   
                                    <label class="col-sm-3 control-label">Balance</label> 
                                    <div class="col-sm-9"> 
                                        <input name="balance" class="form-control" id="focusedInput" type="number" placeholder="current balance of the owner" required> 
                                    </div> 
                                </div>

                                <div class="form-group">   
                                    <label class="col-sm-3 control-label">Address</label> 
                                    <div class="col-sm-9"> 
                                        <input name="address" class="form-control"  id="focusedInput" type="text" placeholder="Address of the owner" required=""> 
                                    </div> 
                                </div>
                                <div class="form-group">   
                                    <label class="col-sm-3 control-label">PhoneNo</label> 
                                    <div class="col-sm-9"> 
                                        <input name="phone"  class="form-control" id="focusedInput" type="text" placeholder="Contact Number of the owner" required=""> 
                                    </div> 
                                </div>
                                <div class="form-group">   
                                    <label class="col-sm-3 control-label">Date Of Birth</label> 
                                    <div class="col-sm-9"> 
                                        <span class="form-control">
<?php
require_once('../calendar/classes/tc_calendar.php');
$myCalendar = new tc_calendar("birthday", true);
//$myCalendar->setIcon("../calendar/images/iconCalendar.gif");
//$myCalendar->setDate(date('d'), date('m'), date('Y'));
$myCalendar->setPath("calendar/");
// $myCalendar->setYearInterval(1900, 1999);
// $myCalendar->setYearInterval(date('Y'),1900);
$myCalendar->dateAllow('1900-01-01', '1999-12-31');
//$myCalendar->setOnChange("myChanged('test')");
$myCalendar->writeScript();
?> 
                                        </span>
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <label for="branch" class="col-sm-3 control-label">BranchID</label>
                                    <div class="col-sm-9">

<?php
$sql = "select BranchCode,BranchName from branch";
$q = mysqli_query($connection, $sql);
echo "<select class=\"form-control\" name=\"branch\" style=\"text-align:center\">";
echo "<option size =30 >---> please select a branch <---</option>";
while ($row = mysqli_fetch_array($q)) {
    echo "<option value='" . $row['BranchCode'] . "'>" . $row['BranchName'] . "</option>";
}
echo "</select>";
?>

                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-6 col-sm-10">
                                        <button name="btncreate" type="submit" class="btn btn-lg btn-primary">Create</button>
                                    </div>
                                </div>
                            </form>
                            <!-- php for user create form-->

                        </div>



                        <div id="menu1" class="tab-pane fade">
<?php
$succed="";
if (isset($_POST["btnbalance"])) {
    $account = mysqli_real_escape_string($connection, $_POST["accountid"]);
    $amount = mysqli_real_escape_string($connection, $_POST['amount']);
    $query = "UPDATE account SET Balance=Balance + $amount WHERE AccountNo=$account";
    mysqli_query($connection, $query);

    $query = "INSERT INTO deposit(AccountNo,Amount) VALUES ('$account',$amount)";
    mysqli_query($connection, $query);
    $succed="$amount is successfully deposited to $account !!!";
}
?>                                   
                            <h3>Money Deposit</h3>
                            <h3><span class="label label-danger col-lg-offset-4"><?php echo $show ?></span></h3>
                             <h3>&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;<span class="label label-success col-md-offset-3"><?php echo $succed ?></span></h3>
                          
                            <form enctype="multipart/form-data" class="form-horizontal col-lg-5 col-lg-offset-2" method="POST" action="#" >
                                <div class="form-group">
                                    <label for="accountid" class="col-sm-3 control-label">AccountID</label>
                                    <div class="col-sm-9">
                                        <input name="accountid" type="text" class="form-control" id="accountid" placeholder="1234 1234 1234 1234" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="exampleInputAmount">Amount</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input name="amount" type="number" class="form-control" id="exampleInputAmount" placeholder="Amount" required >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-5 col-sm-10">
                                        <input name="btnbalance" type="submit" class="btn btn-lg btn-success" value="Update Balance">
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div id="menu2" class="tab-pane fade">
<?php
$query = "SELECT * FROM user u,account a,accounttype ac,branch b "
        . "WHERE  u.`userid`=a.`userid`"
        . " AND a.`AccountTypeID`=ac.`AccountTypeID` AND u.BranchCode=b.BranchCode";
$result = mysqli_query($connection, $query);

function Displayaccount($accountno, $balance, $owner, $opendate, $accountType, $branchname, $pho, $mail, $uid) {
    $output = <<< HERE
    <tr>
        <td>
          <a href="updateuserinfo.php?userid=$accountno">$accountno</a>
        </td>
         <td>$$balance</td>
         <td>$owner</td>
         <td>$opendate</td>
          <td>$accountType</td>
         <td>$branchname</td>
         <td>$pho</td>
         <td class="text-uppercase">$mail</td>
     
     <td>
         <a class="btn btn-primary" href="updateuserinfo.php?userid=$accountno" role="button">Update</a>
         <input type="submit" class="btn btn-danger" value="Delete" onclick="return confirm('Do you really want to delete this account!!?');" name="btndelete[$uid]">
    </td>
    </tr>    
HERE;
    echo $output;
}
?>
                            <h3>Account Info</h3>
                            <?php
                            $succed = "";
                            if (isset($_POST["btndelete"])) {
                                $delusr = key($_POST["btndelete"]);
                                $query = "DELETE FROM USER WHERE userid=$delusr";
                                mysqli_query($connection, $query);
                                $succed = "User is deleted successfully !!";
                                //header("location:manage.php");
                            }
                            ?>
                             <h3>&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;<span class="label label-success col-md-offset-3"><?php echo $succed ?></span></h3>
                             <form enctype="multipart/form-data" class="form-horizontal col-lg-12" method="POST" action="manage.php">
                                <table class="table table-condensed table-bordered"> 
                                    <thead> 
                                        <tr style="color: black;"> 
                                            <th>AccountID</th> 
                                            <th>Balance</th>
                                            <th>Owner Name</th>
                                            <th>Open Date</th>
                                            <th>Account Type</th>
                                            <th>Branch Name</th>
                                            <th>Phone</th>
                                            <th>NRC</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
<?php
while ($row = mysqli_fetch_assoc($result)) {
    $accountno = $row["AccountNo"];
    $balance = $row["Balance"];
    $uid = $row["userid"];
    Displayaccount($row["AccountNo"], $row["Balance"], $row["OwnerName"], $row["OpenDate"], $row["AccountTypeName"], $row["BranchName"], $row["phono"], $row["NRC"], $row["userid"]);
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
