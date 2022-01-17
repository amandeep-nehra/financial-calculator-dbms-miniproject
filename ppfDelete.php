<?php
session_start();
include 'navigation.php';

$conn = connect();
$id = $_SESSION['userid'];
$sq = "SELECT * FROM user_login WHERE user_id='$id'";
$thisUser = mysqli_fetch_assoc($conn->query($sq));
// change rd_id and in location
if (isset($_GET['ppf_id'])) {
    $ppfId = $_GET['ppf_id'];
} elseif ($_POST['Submit']) {
    $ppfId = $_POST['ppf_id'];
    $sql = "DELETE FROM ppf WHERE ppf_id='$ppfId' limit 1";
    $conn->query($sql);
    header("Location: ppfcal.php");
}
// change rd_id
$sql = "SELECT * from ppf WHERE ppf_id='$ppfId' limit 1";
$res = mysqli_fetch_assoc($conn->query($sql));

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
                        <h2 style="color: #fb607f;"> Selected one will be Deleted!</h2>
                    </div>
                    <div class="row pt-20">
                        <div class="col-sm-7">
                            <!-- change all names and placeholders -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h2> Bank Name:</h2>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo ucwords($res['bank_name']) ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h2> PPF Principal:</h2>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo $res['ppf_prin'] ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h2> PPF Rate:</h2>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo $res['ppf_rate'] ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h2> PPF Years:</h2>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo $res['ppf_year'] ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h2> PPF Return:</h2>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo $res['ppf_return'] ?></h2>
                                </div>
                            </div>
                            <form method="POST" action="ppfDelete.php">
                                <!-- change the action link above and do changes below -->
                                <input type="hidden" value="<?php echo $res['ppf_id']; ?>" name="ppf_id">
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