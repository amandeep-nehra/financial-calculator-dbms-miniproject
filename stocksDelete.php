<?php
session_start();
include 'navigation.php';

$conn = connect();
$id = $_SESSION['userid'];
$sq = "SELECT * FROM user_login WHERE user_id='$id'";
$thisUser = mysqli_fetch_assoc($conn->query($sq));
// change rd_id and in location
if (isset($_GET['stock_id'])) {
    $stockId = $_GET['stock_id'];
} elseif ($_POST['Submit']) {
    $stockId = $_POST['stock_id'];
    $sql = "DELETE FROM stocks WHERE stock_id='$stockId' limit 1";
    $conn->query($sql);
    header("Location: stockscal.php");
}
// change rd_id
$sql = "SELECT * from stocks WHERE stock_id='$stockId' limit 1";
$res = mysqli_fetch_assoc($conn->query($sql));

?>

<html>

<head>
    <title> STOCKS </title>
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
                                        <h2> Stock Name:</h2>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo ucwords($res['stock_name']) ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h2> Opening Price:</h2>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo $res['open_price'] ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h2> Closing Price:</h2>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo $res['close_price'] ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h2> Dividend </h2>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo $res['dividend'] ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h2> Stocks Return:</h2>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h2 style="color: whitesmoke;"><?php echo $res['stock_return'] ?></h2>
                                </div>
                            </div>
                            <form method="POST" action="stocksDelete.php">
                                <!-- change the action link above and do changes below -->
                                <input type="hidden" value="<?php echo $res['stock_id']; ?>" name="stock_id">
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