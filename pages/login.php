<?php
  session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SplitABill</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <!-- CSS -->
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/login.css">
        <!-- FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville|Open+Sans:300,400|Roboto:200,300,400" rel="stylesheet">
        <!-- Scripts -->
        <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>

        <script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
        crossorigin="anonymous"></script>

        <script src="../js/login.js"></script>


        <!-- <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script> -->
    </head>
    <body>
        <!-- <div class="header-container"> -->
        <?php include("../modules/navbar.php"); ?>
        <!-- </div> -->

      <div class="body-container-wrap">

        <div class="main-container">
          <div class="login-box-wrap">
            <h2>Login to start Splitting.</h2>
            <form action="../modules/authenticate.php" method="post">
              <p class="error">
                <?php
                  if ($_GET['fail'])
                    echo "Incorrect username or password.";
                ?>
              </p>
              <input name="username" placeholder="Username"></input>
              <input name="password" type="password" placeholder="Password"></input>
              <div class="form-buttons-wrap">
                <input type="submit" value="Login"></input>
                <a href="./register.php"><button type="button">Register</button></a>
              </div>
            </form>
          </div>
        </div>

    </div>
        <div class="transparent-fill-div"></div>

        <footer class="wrapper">
            <h3>SplitABill @ Aaron Baw 2017</h3>
        </footer>

    </body>
</html>
