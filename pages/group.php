<?php
session_start();

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
                <?php
                  echo "<p>Group Page.</p>";
                ?>
              </div>

              <h2>Total Split:</h2>
              <h2>Users In Group</h2>
              <ul class="collection">
                <li class="collection-item avatar">
                  <i class="material-icons circle blue accent-2">face</i>
                  <span class="title">Aaron</span>
                  <p>(That Boi)</p>
                  <p>Joined Since: 12/01/17</p>
                  <a href="#!" class="secondary-content"><i class="material-icons">info_outline</i></a>
                </li>
                <li class="collection-item avatar">
                  <i class="material-icons circle blue accent-2">face</i>
                  <span class="title">Title</span>
                  <p>First Line <br>
                    Second Line
                  </p>
                  <a href="#!" class="secondary-content"><i class="material-icons">info_outline</i></a>
                </li>
                <li class="collection-item avatar">
                  <i class="material-icons circle blue accent-2">face</i>
                  <span class="title">Title</span>
                  <p>First Line <br>
                    Second Line
                  </p>
                  <a href="#!" class="secondary-content"><i class="material-icons">info_outline</i></a>
                </li>
              </ul>

              <?php

              ?>

              <!-- Bills Due -->
              <div class="group-header-wrap">
                <h2>Group Bills</h2>
                <p>These are the bills shared between your squad.</p>
              </div>
              <div class="collection group-bills">
                <a href="#!" class="collection-item">Alvin</a>
                <a href="#!" class="collection-item">Alvin</a>
                <a href="#!" class="collection-item">Alvin</a>
                <a href="#!" class="collection-item">Alvin</a>
              </div>

              <!-- Group Util -->
              <div class="management-header-wrap">
                <h2>Group Management</h2>
              </div>

              <div class="generate-link-wrap">
                <a class="waves-effect blue accent-1 btn-flat">Generate Link</a>
                <input placeholder="Click button to generate join link."></input>
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
