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
        <link rel="stylesheet" href="../css/addBill.css">
        <!-- FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville|Open+Sans:300,400|Roboto:200,300,400" rel="stylesheet">
        <!-- Scripts -->
        <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
        <!-- <script src="../js/login.js"></script> -->
        <!-- <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script> -->
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
          <div class="box-container">
            <form action="../modules/createNewBill.php" method="post">
              <h1>Add a new Bill.</h1>
              <input name="billName" type="text" placeholder="Bill Name"></input>
              <input name="amount" type="number" placeholder="Amount to Pay"></input>
              <input name="people" type="number" placeholder="Amount of People"></input>
              <input type="checkbox" name="recurring" value="true" checked>Recurring bill?</input>
              <input type="submit" value="Add"></input>
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
