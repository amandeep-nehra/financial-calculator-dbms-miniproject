<?php
session_start();
include('navigation.php');

$date = date('Y-m-d', strtotime('-7 days'));
$m = '';
$conn = connect();

$id = $_SESSION['userid'];
$sq = "SELECT * FROM user_login WHERE user_id='$id'";
$thisUser = mysqli_fetch_assoc($conn->query($sq));

if (isset($_POST['submit'])) {
    if ($thisUser['password'] == $_POST['pass']) {
        $sq = "UPDATE user_login SET ";
        if (isset($_POST['uname'])) {
            $uName = $_POST['uname'];
            if ($uName != $thisUser['name']) {
                $sq .= "name = '$uName',";
            }
        }
        if (isset($_POST['email'])) {
            $uEmail = $_POST['email'];
            if ($uName != $thisUser['email']) {
                $sq .= "email = '$uEmail',";
            }
        }
        if (isset($_POST['npass']) && $_POST['npass'] != '' && isset($_POST['cpass']) && $_POST['cpass'] != '') {
            if ($_POST['npass'] == $_POST['cpass']) {
                $pass = $_POST['npass'];
                if ($pass != $thisUser['password']) {
                    $sq .= "password= '$pass',";
                }
            }
        }
        $sq = substr($sq, 0, -1);
        $sq .= " WHERE user_id='$id'";
        $conn->query($sq);
        $m = 'User\'s Information Successfully Updated!';
    } else {
        $m = "Credentials mismatch!";
    }
}

$sql = "SELECT * from user_login";
$res = $conn->query($sql);
?>

<html>

<head>
    <title> Users </title>
    <link rel="stylesheet" type="text/css" href="css/users.css">
</head>

<body>
    <div class="row" style="padding-top: 50px;">
        <div class="leftcolumn">
            <div class="row">
                <section style="padding-left: 20px; padding-right: 20px;">
                    <div class="col-sm-3">
                        <div class="card card-green">
                            <a href="rdcal.php">RD Calculator</a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card card-yellow">
                            <a href="fdcal.php">FD Calculator</a>
                        </div>
                    </div>
                    <div class="col-sm-3 ">
                        <div class="card card-blue">
                            <a href="ppfcal.php">PPF Calculator</a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card card-red">
                            <a href="stockscal.php">Stocks Calculator</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="rightcolumn">
            <div class="card text-center">
                <h2>About User</h2>
                <p>
                    Logged in as
                <h4><?php echo $thisUser['name'];  ?></h4> since <h4><?php echo date('F j, Y', strtotime($thisUser['created_at'])); ?></h4>
                </p>
            </div>

            <div class="card text-center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProduct">
                    Update Your Info
                </button>
                <h1><?php echo $m; ?></h1>
                <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <button style="background-color: #ffce00;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h2 class="modal-title" id="exampleModalScrollableTitle"><?php echo $thisUser['name']; ?></h2>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="dashboard.php" enctype="multipart/form-data">
                                    <div class="form-group pt-20">
                                        <div class="col-sm-4">
                                            <label for="uname" class="pr-10"> User Name</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input name="uname" type="text" class="login-input" placeholder="User Name" id="uname" value="<?php echo $thisUser['name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group pt-20">
                                        <div class="col-sm-4">
                                            <label for="email" class="pr-10"> Email </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input name="email" type="text" class="login-input" placeholder="Email Address" value="<?php echo $thisUser['email']; ?>" id="buy" required>
                                        </div>
                                    </div>

                                    <div class="form-group pt-20">
                                        <div class="col-sm-4">
                                            <label for="pass" class="pr-10"> Password</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input name="pass" class="login-input" type="password" id="pass" required>
                                        </div>
                                    </div>
                                    <div class="form-group pt-20">
                                        <div class="col-sm-4">
                                            <label for="npass" class="pr-10">New Password</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input name="npass" class="login-input" type="text" id="npass">
                                        </div>
                                    </div>
                                    <div class="form-group pt-20">
                                        <div class="col-sm-4">
                                            <label for="cpass" class="pr-10">Confirm New Password</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input name="cpass" class="login-input" type="text" id="cpass">
                                        </div>
                                    </div>
                                    <div class="form-group" style="text-align: center;">
                                        <button type="submit" value="submit" name="submit" class="btn btn-success">Change</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php include('footer.php') ?>
</body>

</html>