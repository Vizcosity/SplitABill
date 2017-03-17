<?php
// session_save_path("/tmp");

session_start();

// Import security module.
require("../modules/security.php");

if (!hasGroupAccess($_SESSION['id'], $_GET['id']))
  return header("Location: dashboard.php?message=You do not have acccess to this group.");

include("../modules/groupFetch.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SplitABill - Group</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <!-- CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/group.css">

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
        <script src="../js/group.js"></script>
    </head>
    <body>
        <!-- <div class="header-container"> -->
        <?php include("../modules/navbar.php"); ?>

        <!-- </div> -->

      <div class="body-container-wrap">

        <div class="main-container">

            <div class="main-content-wrap">
              <div class="header-wrap">
                <i class="material-icons">group_work</i>
                <div class="text-heading">
                <h2><?php
                    // Save group details to a variable.
                    $groupDetails = getGroupDetails($_GET['id']);
                    echo escape($groupDetails['name']);
                  ?>
                </h2>
                <p>
                  <?php
                    // Echo the remaining description for the desired group.
                    echo escape($groupDetails['description']);
                  ?>
                </p>
              </div>
              </div>

              <h2>Total Split:</h2>
              <h2>Users In Group</h2>
              <ul class="collection">
                <?php echo getUsersInGroup($_GET['id']); ?>
              </ul>

              <?php

              ?>

              <!-- Bills Due -->
              <div class="group-header-wrap">
                <h2>Group Bills</h2>
                <p>These are the bills shared between your squad.</p>
              </div>
              <div class="collection group-bills">
                <!-- <a href="#!" class="collection-item">Alvin</a>
                <a href="#!" class="collection-item">Alvin</a>
                <a href="#!" class="collection-item">Alvin</a>
                <a href="#!" class="collection-item">Alvin</a> -->
                <?php echo getBillsInGroup($_SESSION['id'], $_GET['id']); ?>
              </div>

              <!-- Group Util -->
              <div class="management-header-wrap">
                <h2>Group Management</h2>
              </div>

              <div class="generate-link-wrap">
                <!-- <a class="waves-effect blue accent-1 btn-flat">Copy</a> -->
                <!-- <input placeholder="Click button to generate join link."></input> -->
                <div class="token-item">
                  <p>Join Token: </p>
                  <p id="rawToken" class="joinToken" data-clipboard-target="#rawToken"><?php echo getJoinToken($_GET['id']); ?></p>
                  <p>Send this to a friend and ask them to enter it in the <a href="joinGroup.php">join group</a> page.</p>
                </div>
                <div class="token-item">
                  <p>Join Link: </p>
                  <p id="linkToken" class="joinToken" data-clipboard-target="#linkToken"><?php echo "http://cs139.dcs.warwick.ac.uk/~u1617781/cs139/SplitABill/pages/joinGroup.php?token=".getJoinToken($_GET['id']); ?></p>
                  <p>Users who click this will be added directly to the group.</p>
                </div>
              </div>

              <a id="leave-button" class="btn btn-flat waves-effect red lighten-1">Leave Group</a>

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
