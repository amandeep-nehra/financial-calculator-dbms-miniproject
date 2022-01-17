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
            <div class="pt-20 pl-20">
                <div class="col-sm-12" style="background-color: #282828; ">
                    <div class="text-center">
                        <h1> Edit RD </h1>
                        <!-- change title -->
                        <h2> <?php echo $m; ?> </h2>
                    </div>
                    <div class="row pt-20">
                        <div class="col-sm-7">
                            <form method="POST" action="rdEdit.php">
                                <!-- edit link above -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="pull-left">
                                            <h2> Bank Name:</h2>
                                            <!-- from here, change all h2-->
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
                                            <h2> RD Principal:</h2>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 form-input pt-10">
                                        <input type="number" class="login-input" name="rd_prin" value="<?php echo $res['rd_prin']; ?>" placeholder="RD Principal">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="pull-left">
                                            <h2> RD Annual Rate of Interest:</h2>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 form-input pt-10">
                                        <input type="number" class="login-input" name="rd_rate" value="<?php echo $res['rd_rate']; ?>" placeholder="RD Annual Rate of Interest">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="pull-left">
                                            <h2> RD Tenure (in Years):</h2>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 form-input pt-10">
                                        <input type="number" class="login-input" name="rd_tenure" value="<?php echo $res['rd_tenure']; ?>" placeholder="RD Tenure">
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

    </div>

    <?php include('footer.php') ?>
</body>

</html>