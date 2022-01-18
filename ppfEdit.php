<?php
session_start();
include 'navigation.php';

$conn = connect();
$m = '';

$id = $_SESSION['userid'];
$sq = "SELECT * FROM user_login WHERE user_id='$id'";
$thisUser = mysqli_fetch_assoc($conn->query($sq));
// change rdId
if (isset($_GET['ppf_id'])) {
    $ppfId = $_GET['ppf_id'];
    $sql = "SELECT * from ppf WHERE ppf_id='$ppfId' limit 1";
    $res = mysqli_fetch_assoc($conn->query($sql));
}
// change everything including links VERY CAREFULLY!!!!
elseif (isset($_POST['ppf_id'])) {
    $ppfId = $_POST['ppf_id'];
    $bankName = $_POST['bank_name'];
    $ppfPrin = floatval($_POST['ppf_prin']);
    $ppfYear = floatval($_POST['ppf_year']);
    $ppfRate = floatval($_POST['ppf_rate']);

    if (isset($_POST['Submit'])) {
        $sql = "UPDATE ppf SET bank_name= '$bankName', ppf_prin= '$ppfPrin', ppf_year= '$ppfYear', ppf_rate= '$ppfRate'  WHERE ppf_id = '$ppfId';";
        if ($conn->query($sql) === true) {
            header('Location: ppfcal.php');
        } else {
            $m = "Connection Failure!";
            header("Location: ppfEdit.php?ppf_id=$ppfId");
        }
    }
}
// make sure you have floatval()
?>

<html>

<head>
    <title> PPF </title>
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
                        <h1> Edit PPF </h1>
                        <!-- change title -->
                        <h2> <?php echo $m; ?> </h2>
                    </div>
                    <div class="row pt-20">
                        <div class="col-sm-7">
                            <form method="POST" action="ppfEdit.php">
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
                                            <h2> PPF Principal:</h2>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 form-input pt-10">
                                        <input type="number" step="any" class="login-input" name="ppf_prin" value="<?php echo $res['ppf_prin']; ?>" placeholder="PPF Principal">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="pull-left">
                                            <h2> PPF Annual Rate of Interest:</h2>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 form-input pt-10">
                                        <input type="number" step="any" class="login-input" name="ppf_rate" value="<?php echo $res['ppf_rate']; ?>" placeholder="PPF Annual Rate of Interest">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="pull-left">
                                            <h2> PPF Years (min 15 years):</h2>
                                        </label>
                                    </div>
                                    <div class="col-sm-6 form-input pt-10">
                                        <input type="number" step="any" min="15" class="login-input" name="ppf_year" value="<?php echo $res['ppf_year']; ?>" placeholder="PPF Years">
                                    </div>
                                </div>
                                <!-- here change rdId after echo and again name -->
                                <input type="hidden" value="<?php echo $ppfId; ?>" name="ppf_id">
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
                <h2>About User</h2>
                <p>
                    Logged in as
                <h4><?php echo $thisUser['name'];  ?></h4> since <h4><?php echo date('F j, Y', strtotime($thisUser['created_at'])); ?></h4>
                </p>
            </div>
        </div>
    </div>

    <?php include('footer.php') ?>
</body>

</html>