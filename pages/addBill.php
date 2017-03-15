<?php
  session_start();
  include("../modules/getGroupsForUser.php");

  // error_reporting(E_ALL);
  // ini_set("display_errors", 1);

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
        <!-- Materialize -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/addBill.css">

          <!-- Materialize Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville|Open+Sans:300,400|Roboto:200,300,400" rel="stylesheet">
        <!-- Scripts -->
        <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
        <script src="../js/addBill.js"></script>
        <!-- <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script> -->
    </head>
    <body>
        <!-- <div class="header-container"> -->
        <?php include("../modules/navbar.php"); ?>
        <!-- </div> -->

      <div class="body-container-wrap">

        <div class="main-container">
          <div class="box-container">
            <form action="../modules/createNewBill.php" method="post">
              <h1>Add a new Bill.</h1>
              <div>
                <select class="group-select">
                  <?php

                    // Grab the groups and safe info to a variable.
                    $groups = getGroupsByUser(1);

                    // Render all the groups as list elements.
                    while($row = $groups->fetchArray()){
                      echo '<option value="'.$row['id'].'" data-icon="'.$row['imageURL'].'" class="circle">'.$row['name'].'</option>';
                    }

                  ?>
                  <option value="false" data-icon="https://cdn0.iconfinder.com/data/icons/users-android-l-lollipop-icon-pack/24/user-128.png" class="circle">Seperate Bill (No Group)</option>
                </select>
                <label>Images in select</label>
              </div>
              <div class="chips chips-autocomplete"></div>

              <input name="billName" type="text" placeholder="Bill Name"></input>

              <!-- Extended input for description if needed -->
              <div class="input-field">
                    <textarea id="billDescriptionBox" class="materialize-textarea"></textarea>
                    <label for="billDescriptionBox">Bill Description (Optional)</label>
              </div>

              <div class="input-field">               <!-- <p>£</p> -->
               <input id="icon_prefix" type="text" class="validate">
               <label for="icon_prefix">Bill Amount (£)</label>
             </div>

              <?php
                echo '<input type="hidden" name="userID" value="'.$_SESSION['id'].'">';
              ?>



              <input placeholder="Select due date" id="date" type="date" class="datepicker"></input>
              <p>
                 <input type="checkbox" class="filled-in blue accent-1" id="filled-in-box" checked="checked" />
                 <label for="filled-in-box">Recurring Bill?</label>
              </p>
              <input class="btn waves-effect waves-light blue accent-1" type="submit" value="Add"></input>
            </form>
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
