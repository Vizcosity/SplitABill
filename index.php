<?php
  session_start();
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SplitABill</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <!-- CSS -->
        <link rel="stylesheet" href="./css/font-awesome.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/landing.css">
        <!-- FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville|Open+Sans:300,400|Roboto:200,300,400" rel="stylesheet">
        <!-- Scripts -->
        <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
        <script src="./js/landing.js"></script>
        <!-- <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script> -->
    </head>
    <body>

      <?php

        $indexPage = true;
        include("./modules/navbar.php");

       ?>

      <div class="body-container-wrap">

        <div class="main-container">
          <div class="bg-image">
            <div class="overwash"></div>
          </div>

          <div class="title-headings">
            <h1 class="title">SplitABill</h1>
            <p class="tagline">Split Bills <i>not</i> people.</p>
            <hr nosade>
          </div>
          <div class="newuserbox-container">
            <form action="">
              <a href="./pages/login.php" class="account-exists">Already have an account?</a>
              <div style="display: flex;">
                <input name="name" placeholder="Name, please.">
                <div class="input-icon-box" style=><i class="fa fa-arrow-right" aria-hidden="true"></i></div></form>
              </div>
            </form>
            <!-- <a href="">I already have an account</a> -->
          </div>

          </div>
        </div>



        <!-- This is here to create empty space for the fixed footer beneath -->
        <!-- <div class="transparent-fill-div"></div> -->

        <footer class="wrapper">
            <h3>SplitABill @ Aaron Baw 2017</h3>
        </footer>
      <!-- </div> -->
      <!-- <div class="bg-image"></div> -->

    </body>
</html>
