<?php
session_start();
include 'navigation.php';

$conn = connect();
$id = $_SESSION['userid'];
$sq = "SELECT * FROM user_login WHERE user_id='$id'";
$thisUser = mysqli_fetch_assoc($conn->query($sq));
// change rd_id and in location
if (isset($_GET['fd_id'])) {
    $fdId = $_GET['fd_id'];
} elseif ($_POST['Submit']) {
    $fdId = $_POST['fd_id'];
    $sql = "DELETE FROM fd WHERE fd_id='$fdId' limit 1";
    $conn->query($sql);
    header("Location: fdcal.php");
}
// change rd_id
$sql = "SELECT * from fd WHERE fd_id='$fdId' limit 1";
$res = mysqli_fetch_assoc($conn->query($sql));

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
                <div class="col-sm-12">
                    <div class="text-center">
                        <h2 style="color: #fb607f;"> Selected one will be Deleted!</h2>
                    </div>
                    <div class="row pt-20">
                        <div class="col-sm-7">
                            <!-- change all names and placeholders -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h4> Bank Name:</h4>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h4 ><?php echo ucwords($res['bank_name']) ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h4> Investment Payout:</h4>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h4 ><?php echo $res['fd_prin'] ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h4> Annual Rate of Interest (in %):</h4>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h4 ><?php echo $res['fd_rate'] ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h4> Time Period (in Years):</h4>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h4 ><?php echo $res['fd_dur'] ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h4> Compounding Frequency:</h4>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h4 ><?php echo $res['compounding'] ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h4> Maturity Amount:</h4>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h4 ><?php echo $res['fd_return'] ?></h4>
                                </div>
                            </div>
                            <form method="POST" action="fdDelete.php">
                                <!-- change the action link above and do changes below -->
                                <input type="hidden" value="<?php echo $res['fd_id']; ?>" name="fd_id">
                                <div class="row">
                                    <div class="text-center">
                                        <input class="btn btn-danger" type="submit" name="Submit" value="Delete">
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