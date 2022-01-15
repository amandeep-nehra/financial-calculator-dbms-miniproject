<?php

?>


<html>
    <head>
        <title>Welcome</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link type="text/css" rel="stylesheet" href="css/style.css">
    </head>
    <style>
body {
    background-image: url("bg.jpeg");
    margin:0; 
    padding:0;
    font-family: New Century Schoolbook, TeX Gyre Schola, serif;
    background-size:cover;
}
.heading h1{
    color: light blue;
    font-size: 80px;
    font-style: oblique;
    font-weight: bolder;
    font-family:Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;
    padding-left: 250px;
    padding-bottom:10px;
    float: center;
    padding-top: 70px; 
    border-bottom: 1px white;
  }
  .heading:hover{
    color: white;
    transition: 0.3s ease;
}
  .footer{
    color: grey;
    font-size: 15px;
    font-family:Arial;
   position: absolute;
   bottom:15px;
   right:45px;

  }
  .col-sm-6
  {
      bottom:-120px;
  }
</style>
    <body>
    <div class="heading">
        <h1> STOCKS MANAGEMENT DATABASE </h1>
    </div>

        <div class="col-sm-6">
            <a href="login.php">
                <input  type="button" class="btn btn-danger pull-right" value="Login">
            </a>
        </div>

        <div class="col-sm-6">
            <a href="register.php">
                <input  type="button" class="btn btn-success pull-left" value="Register">
            </a>
        </div>
        <div class="footer">
    All rights reserved @ Amandeep & Amulya</a>
</div>
    </body>

</html>
