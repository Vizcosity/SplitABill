<?php

// session_save_path("/tmp");

session_start();

// include("../modules/groupJoinModule.php");

include("../modules/database.php");

// If get param set, redirect to join module with appended token.
if (isset($_GET['token']))
  header("Location: ../modules/groupJoinModule.php?token=".$_GET['token']);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SplitABill - Join Group</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <!-- CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/joinGroup.css">

        <!-- FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville|Open+Sans:300,400|Roboto:200,300,400" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


        <!-- Scripts -->
        <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
          <!-- Materialize -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>

        <!-- Clipboard js framework for copying join tokens to clipboard -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.6.0/clipboard.min.js"></script>
        <script src="../js/joinGroup.js"></script>
    </head>
    <body>
        <!-- <div class="header-container"> -->
        <?php include("../modules/navbar.php"); ?>

        <!-- </div> -->

      <div class="body-container-wrap">

        <div class="main-container">

            <div class="main-content-wrap">

              <div class="header-wrap">
                <i class="material-icons">group_add</i>
                <p>Join a group by adding a token or joining via link.</p>
              </div>

              <p style="color: red">
                <?php
                  if (isset($_GET['message']))
                    echo escape($_GET['message']);
                ?>
              </p>

              <div class="token-input-wrap">
                <form action="../modules/groupJoinModule.php" method="post">
                  <input name="token" id="tokenInput" style="padding: 10px;" type="text"></input>
                  <?php
                    echo '<input name="userID" value="'.$_SESSION['id'].'" type="hidden"></input>';
                  ?>
                  <div id="submit">
                    <input class="btn btn-flat waves-effect blue accent-1" type="submit" value="Join"></input>
                  </div>
                </form>

              </div>

            </div>

          </div>
        </div>

    </div>




        <!-- This is here to create empty space for the fixed footer beneath -->
        <div class="transparent-fill-div"></div>

        <footer class="wrapper">
            <h3>SplitABill @ Aaron Baw 2017</h3>
        </footer>
      <!-- </div> -->
      <!-- <div class="bg-image"></div> -->

    </body>
</html>
