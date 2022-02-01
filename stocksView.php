<?php
session_start();
include 'navigation.php';

$conn = connect();
$id = $_SESSION['userid'];
$sq = "SELECT * FROM user_login WHERE user_id='$id'";
$thisUser = mysqli_fetch_assoc($conn->query($sq));
// change rd_id to __id
if (isset($_GET['stock_id'])) {
    $id = $_GET['stock_id'];

    $sql = "SELECT * from stocks WHERE stock_id=$id limit 1";
    $res = mysqli_fetch_assoc($conn->query($sql));
}
?>

<html>

<head>
    <title> Stocks </title>
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
                        <!-- add changes -->
                        <h2> Stocks Investment Plan Details</h2>
                    </div>
                    <div class="row pt-20">
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h4> Stock Name:</h4>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h4><?php echo ucwords($res['stock_name']) ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h4> Purchase Price:</h4>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h4><?php echo $res['open_price'] ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h4> Market Cap</h4>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h4><?php echo $res['close_price'] ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h4> Dividend Yield (in %):</h4>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h4><?php echo $res['dividend'] ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h4> Volume of Stocks:</h4>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h4><?php echo $res['volume'] ?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="pull-left">
                                        <h4> Stocks Return:</h4>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <h4><?php echo $res['stock_return'] ?></h4>
                                </div>
                            </div>


                            <div class="row text-center">
                                <!-- change rd_id to __id, change even the links-->
                                <a href="stocksEdit.php?stock_id=<?php echo $res['stock_id']; ?>"><button class="btn btn-warning">Edit</button></a>
                                <a href="stocksDelete.php?stock_id=<?php echo $res['stock_id']; ?>"><button class="btn btn-danger">Delete</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rightcolumn">
            <div class="card text-center">
                <h2><b>Stocks and Their Return</b></h2>
                <p>
                    Total return, when measuring performance, is the actual rate of return of an investment or a pool of investments over a given evaluation period. Total return includes interest, capital gains, dividends, and distributions realized over a period.
                </p>
                <p>
                    Total return is expressed as a percentage of the amount invested. For example, a total return of 20% means the security increased by 20% of its original value due to a price increase, distribution of dividends (if a stock), coupons (if a bond), or capital gains (if a fund).
                </p>
                <p>
                    It is calculated as ROI = Current Dividend Yield + Capital Gains Yield.
                </p>
            </div>
        </div>
    </div>

    <?php include('footer.php') ?>
</body>

</html>