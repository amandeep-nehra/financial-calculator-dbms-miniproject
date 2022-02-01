<?php
session_start();
include 'navigation.php';

$conn = connect();
$m = '';

$id = $_SESSION['userid'];
$sq = "SELECT * FROM user_login WHERE user_id='$id'";
$thisUser = mysqli_fetch_assoc($conn->query($sq));
// change rdId
if (isset($_GET['rd_id'])) {
    $rdId = $_GET['rd_id'];
    $sql = "SELECT * from rd WHERE rd_id='$rdId' limit 1";
    $res = mysqli_fetch_assoc($conn->query($sql));
}
// change everything including links VERY CAREFULLY!!!!
elseif (isset($_POST['rd_id'])) {
    $rdId = $_POST['rd_id'];
    $bankName = $_POST['bank_name'];
    $rdPrin = floatval($_POST['rd_prin']);
    $rdTen = floatval($_POST['rd_tenure']);
    $rdRate = floatval($_POST['rd_rate']);

    if (isset($_POST['Submit'])) {
        $sql = "UPDATE rd SET bank_name= '$bankName', rd_prin= '$rdPrin', rd_tenure= '$rdTen', rd_rate= '$rdRate'  WHERE rd_id = '$rdId';";
        if ($conn->query($sql) === true) {
            header('Location: rdcal.php');
        } else {
            $m = "Connection Failure!";
            header("Location: rdEdit.php?rd_id=$rdId");
        }
    }
}
// make sure you have floatval()
?>

<html>

<head>
    <title> RD </title>
    <!-- change title -->
    <link rel="stylesheet" type="text/css" href="css/products.css">
</head>

<body>
    <div class="row" style="padding-top: 50px;">
        <div class="leftcolumn">
            <div class="row">
                <section style="padding-left: 20px; padding-right: 20px;">
                    <div class="col-sm-3">
                        <div class="card card-yellow">
                            <a href="rdcal.php">RD Calculator</a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card card-yellow">
                            <a href="fdcal.php">FD Calculator</a>
                        </div>
                    </div>
                    <div class="col-sm-3 ">
                        <div class="card card-yellow">
                            <a href="ppfcal.php">PPF Calculator</a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card card-yellow">
                            <a href="stockscal.php">Stocks Calculator</a>
                        </div>
                    </div>
                </section>
            </div>
            <div class="pt-20 pl-20">
                <div class="col-sm-12">
                    <div class="text-center">
                        <h2> Edit RD </h2>
                        <!-- change title -->
                        <h4> <?php echo $m; ?> </h4>
                    </div>
                    <div class="row pt-20">
                        <div class="col-sm-7">
                            <form method="POST" action="rdEdit.php">
                                <!-- edit link above -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="pull-left">
                                            <h4> Bank Name:</h4>
                                            <!-- from here, change all h4-->
                                        </label>
                                    </div>
                                    <div class="col-sm-6 form-input pt-10">
                                        <!-- change name, value, placeholder -->
                                        <input type="text" class="login-input" name="bank_name" value="<?php echo $res['bank_name']; ?>" placeholder="Bank Name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="pull-left">
                                            <h4> Monthly Investment Amount:</h4>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 form-input pt-10">
                                        <input type="number" step="any" class="login-input" name="rd_prin" value="<?php echo $res['rd_prin']; ?>" placeholder="RD Principal">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="pull-left">
                                            <h4> Annual Rate of Interest (in %):</h4>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 form-input pt-10">
                                        <input type="number" step="any" class="login-input" name="rd_rate" value="<?php echo $res['rd_rate']; ?>" placeholder="RD Annual Rate of Interest">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="pull-left">
                                            <h4> Tenure (in Years)</h4>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 form-input pt-10">
                                        <input type="number" step="any" class="login-input" name="rd_tenure" value="<?php echo $res['rd_tenure']; ?>" placeholder="RD Tenure">
                                    </div>
                                </div>
                                <!-- here change rdId after echo and again name -->
                                <input type="hidden" value="<?php echo $rdId; ?>" name="rd_id">
                                <div class="row">
                                    <div class="text-center">
                                        <input class="btn btn-success" type="submit" name="Submit" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rightcolumn">
            <div class="card text-center">
                <h2><b>Recurring Deposit Calculator</b></h2>
                <p>
                    RD or Recurring Deposits are an investment tool which allows investors to make regular monthly payments and save money for the long term.
                </p>
                <p>
                    Investors can choose the tenure of the deposit and the minimum monthly payment they wish to make according to their convenience.
                    Interest on RD is compounded quarterly, in most banks.
                </p>
            </div>
        </div>
    </div>

    <?php include('footer.php') ?>
</body>

</html>