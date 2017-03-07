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

              <h2>Bill Overview</h2>
              <div class="collection bill-groups">
                <a href="#!" class="collection-item"><span class="badge">£23</span>Gas</a>
                <a href="#!" class="collection-item"><span class="badge">£23</span>Food</a>
                <a href="#!" class="collection-item"><span class="badge">£23</span>Water</a>
                <a href="#!" class="collection-item"><span class="badge">£23</span>Groceries</a>
              </div>

              <h2>Here are your bill groups.</h2>
              <div class="collection bill-groups">
                <a href="#!" class="collection-item"><span class="badge">1</span>Alan</a>
                <a href="#!" class="collection-item"><span class="new badge">4</span>Alan</a>
                <a href="#!" class="collection-item">Alan</a>
                <a href="#!" class="collection-item"><span class="badge">14</span>Alan</a>
              </div>


              <a class="btn-floating btn-large waves-effect waves-light light-blue"><i class="material-icons">add</i></a>
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
