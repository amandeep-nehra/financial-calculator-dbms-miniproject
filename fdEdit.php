<?php
session_start();
include 'navigation.php';

$conn = connect();
$m = '';

$id = $_SESSION['userid'];
$sq = "SELECT * FROM user_login WHERE user_id='$id'";
$thisUser = mysqli_fetch_assoc($conn->query($sq));
// change rdId
if (isset($_GET['fd_id'])) {
    $fdId = $_GET['fd_id'];
    $sql = "SELECT * from fd WHERE fd_id='$fdId' limit 1";
    $res = mysqli_fetch_assoc($conn->query($sql));
}
// change everything including links VERY CAREFULLY!!!!
elseif (isset($_POST['fd_id'])) {
    $fdId = $_POST['fd_id'];
    $bankName = $_POST['bank_name'];
    $fdComp = intval($_POST['compounding']);
    $fdPrin = floatval($_POST['fd_prin']);
    $fdDur = floatval($_POST['fd_dur']);
    $fdRate = floatval($_POST['fd_rate']);

    if (isset($_POST['Submit'])) {
        $sql = "UPDATE fd SET bank_name= '$bankName', fd_prin= '$fdPrin', fd_dur= '$fdDur', fd_rate= '$fdRate', compounding='$fdComp' WHERE fd_id = '$fdId';";
        if ($conn->query($sql) === true) {
            header('Location: fdcal.php');
        } else {
            $m = "Connection Failure!";
            header("Location: fdEdit.php?fd_id=$fdId");
        }
    }
}
// make sure you have floatval()
?>

<html>

<head>
    <title> FD </title>
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
                <datalist id="complist">
                    <option value="1">
                    <option value="2">
                    <option value="4">
                    <option value="12">
                </datalist>
                <div class="col-sm-12">
                    <div class="text-center">
                        <h2> Edit FD </h2>
                        <!-- change title -->
                        <h4> <?php echo $m; ?> </h4>
                    </div>
                    <div class="row pt-20">
                        <div class="col-sm-7">
                            <form method="POST" action="fdEdit.php">
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
                                            <h4> Investment Payout:</h4>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 form-input pt-10">
                                        <input type="number" class="login-input" name="fd_prin" value="<?php echo $res['fd_prin']; ?>" placeholder="FD Principal">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="pull-left">
                                            <h4> Annual Rate of Interest (in %):</h4>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 form-input pt-10">
                                        <input type="number" class="login-input" name="fd_rate" value="<?php echo $res['fd_rate']; ?>" placeholder="FD Annual Rate of Interest">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="pull-left">
                                            <h4> Time Period (in Years):</h4>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 form-input pt-10">
                                        <input type="number" class="login-input" name="fd_dur" value="<?php echo $res['fd_dur']; ?>" placeholder="FD Duration">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="pull-left">
                                            <h4> Compounding Frquency: </h4>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 form-input pt-10">
                                        <input type="number" class="login-input" name="compounding" list="complist" value="<?php echo $res['compounding']; ?>" placeholder="Compounding">
                                    </div>
                                </div>
                                <!-- here change rdId after echo and again name -->
                                <input type="hidden" value="<?php echo $fdId; ?>" name="fd_id">
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
                <h2><b>Fixed Deposit Calculator</b></h2>
                <p>
                    Fixed deposit is a type of investment in which invested money is blocked for the tenure selected and there is a penalty charged if this amount has to be withdrawn before tenure is over i.e premature closure.
                </p>
                <p>
                    NOTE: Compounding Frequency values are 1: Annual, 2: Half-Yearly, 4:Quaterly, 12: Monthly.
                </p>
                <p>
                    Our calculator follows Cumulative Scheme. In a cumulative fixed deposit scheme, the interest amount is compounded over fixed amount, i.e. a Lump Sum invested ONCE the term of the deposit and paid at maturity.
                </p>

            </div>
        </div>
    </div>

    <?php include('footer.php') ?>
</body>

</html>