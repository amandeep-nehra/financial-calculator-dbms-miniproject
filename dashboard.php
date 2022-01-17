

<?php
    session_start();
    include ('navigation.php');

    $m='';
    $conn=connect();

    $id= $_SESSION['userid'];
    $sq= "SELECT * FROM users_info WHERE id='$id'";
    $thisUser= mysqli_fetch_assoc($conn->query($sq));

    if(isset($_POST['submit'])){
        if($thisUser['password']==$_POST['pass']){
            $sq= "UPDATE users_info SET ";
            if(isset($_POST['uname'])){
                $uName= $_POST['uname'];
                if($uName!= $thisUser['name']){
                    $sq .= "name = '$uName',";
                }
            }
            if(isset($_POST['email'])){
                $uEmail= $_POST['email'];
                if($uName!= $thisUser['email']){
                    $sq .= "email = '$uEmail',";
                }
            }
           
            if(isset($_POST['npass'])&& $_POST['npass']!=''&& isset($_POST['cpass'])&& $_POST['cpass']!=''){
                if($_POST['npass']==$_POST['cpass']){
                    $pass= $_POST['npass'];
                    if($pass!=$thisUser['password']){
                        $sq .="password= '$pass',";
                    }
                }
            }
            $sq= substr($sq, 0,-1);
            $sq .=" WHERE id='$id'";
            $conn->query($sq);
            $m= 'Users Information Successfully Updated!';
        } else{
            $m= "Credentials mismatch!";
        }
    }

    $sql= "SELECT * from users_info";
    $res= $conn->query($sql);

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
                        <a href="rd_cal.php">RD Calculator</a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card card-yellow" >
                        <a href="fd_cal.php">FD Calculator</a>
                        </div>
                    </div>
                    <div class="col-sm-3 " >
                        <div class="card card-blue" >
                        <a href="ppf_cal.php">PPF Calculator</a>
                        </div>
                    </div>
                    <div class="col-sm-3" >
                        <div class="card card-red" >
                        <a href="stocks_cal.php">Stocks Calculator</a>
                        </div>
                    </div>
                </section>
            </div>

    <?php include('footer.php')?>

    </body>
</html>
