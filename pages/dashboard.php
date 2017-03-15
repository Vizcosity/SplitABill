<?php
session_start();
// 
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

include("../modules/dashboardFetch.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SplitABill - Dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <!-- CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/dashboard.css">

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
        <script src="../js/dashboard.js"></script>
    </head>
    <body>
        <!-- <div class="header-container"> -->
        <?php include("../modules/navbar.php"); ?>

        <!-- </div> -->

      <div class="body-container-wrap">

        <div class="main-container">

            <div class="main-content-wrap">

              <div class="header-wrap">
                <i class="material-icons">dashboard</i>
                <?php
                  echo "<p>Hi, ".$_SESSION['name'].". This is your dashboard.</p>";
                ?>
              </div>

              <div class="bills-wrap">
              <h2>Bill Overview</h2>
              <div class="collection bill-groups">
                <?php
                  echo fetchBills($_SESSION['id']);
                ?>
              </div>
              </div>

              <div class="groups-wrap">
              <h2>Here are your bill groups.</h2>
              <div class="collection bill-groups">
                <?php
                  $groups = fetchGroups($_SESSION['id']);
                  echo $groups;
                ?>
              </div>
            </div>


              <div class="fixed-action-btn toolbar">
                  <a class="btn-floating btn-large blue accent-2">
                    <i class="large material-icons">mode_edit</i>
                  </a>
                  <ul>
                    <li class="waves-effect waves-light tooltipped" data-position="top" data-delay="50" data-tooltip="Add Bill"><a href="addBill.php"><i class="material-icons">attach_money</i></a></li>
                    <li class="waves-effect waves-light tooltipped" data-position="top" data-delay="50" data-tooltip="Add Group"><a href="addGroup.php"><i class="material-icons">group_add</i></a></li>
                    <li class="waves-effect waves-light tooltipped" data-position="top" data-delay="50" data-tooltip="Settings"><a href="#!"><i class="material-icons">settings</i></a></li>
                  </ul>
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
