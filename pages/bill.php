<?php
  session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SplitABill - Bill</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <!-- CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/bill.css">

        <!-- FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville|Open+Sans:300,400|Roboto:200,300,400" rel="stylesheet">

        <!-- Scripts -->
        <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
          <!-- Materialize -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
        <script src="../js/bill.js"></script>
    </head>
    <body>
        <!-- <div class="header-container"> -->
            <header>
                <nav>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Login</a></li>
                    </ul>
                </nav>
            </header>
        <!-- </div> -->

      <div class="body-container-wrap">

        <div class="main-container">

            <div class="main-content-wrap">

              <p>Due:</p>

              <h2 class="due-amount">£42.11</h2>

              <div class="members-wrap">
                <p>Associated Members:</p>
                <div class="chip">
                  <img src="https://www.rhinonetworks.com/sites/all/themes/twmshop/images/default_profile.jpg" alt="Contact Person">
                  Aaron
                </div>
              </div>

              <div class="desc-wrap">
                <h2>Description</h2>
                <p>
                  This is the description for the Bill you need to pay.
                </p>
              </div>

              <div class="buttons-wrap">
                <a class="waves-effect waves-light btn">Pay Now</a>
                <a class="waves-effect waves-light btn">Deferr</a>
              </div>

            </div>

          </div>
          <div class="bg-image"></div>
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
