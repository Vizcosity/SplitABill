<?php
// session_save_path("/tmp");
  session_start();
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/9.2.0/nouislider.min.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/addGroupPage.css">

        <!-- FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville|Open+Sans:300,400|Roboto:200,300,400" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Scripts -->
        <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
          <!-- Materialize -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.1.0/wNumb.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/9.2.0/nouislider.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
        <script src="../js/addGroupPage.js"></script>
    </head>
    <body>
        <!-- <div class="header-container"> -->
            <?php include("../modules/navbar.php"); ?>
        <!-- </div> -->

      <div class="body-container-wrap">

        <div class="main-container">

            <div class="main-content-wrap">

              <!-- Heading icon -->
              <div class="group-icon-wrap">
                <?xml version="1.0" ?>
                <!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.0//EN'  'http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd'>
                <svg
                  enable-background="new 0 0 24 24"
                  id="Layer_1"
                  version="1.0"
                  viewBox="0 0 24 24"
                  xml:space="preserve"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink">
                  <g>
                    <path d="M9,9c0-1.7,1.3-3,3-3s3,1.3,3,3c0,1.7-1.3,3-3,3S9,10.7,9,9z M12,14c-4.6,0-6,3.3-6,3.3V19h12v-1.7C18,17.3,16.6,14,12,14z   "/>
                  </g>
                  <g>
                    <g>
                      <circle cx="18.5" cy="8.5" r="2.5"/>
                    </g>
                    <g>
                      <path d="M18.5,13c-1.2,0-2.1,0.3-2.8,0.8c2.3,1.1,3.2,3,3.2,3.2l0,0.1H23v-1.3C23,15.7,21.9,13,18.5,13z"/>
                    </g>
                  </g>
                  <g>
                    <g>
                      <circle cx="18.5" cy="8.5" r="2.5"/>
                    </g>
                    <g>
                      <path d="M18.5,13c-1.2,0-2.1,0.3-2.8,0.8c2.3,1.1,3.2,3,3.2,3.2l0,0.1H23v-1.3C23,15.7,21.9,13,18.5,13z"/>
                    </g>
                  </g>
                  <g>
                    <g>
                      <circle cx="5.5" cy="8.5" r="2.5"/>
                    </g>
                    <g>
                      <path d="M5.5,13c1.2,0,2.1,0.3,2.8,0.8c-2.3,1.1-3.2,3-3.2,3.2l0,0.1H1v-1.3C1,15.7,2.1,13,5.5,13z"/>
                    </g>
                  </g>
                </svg>

              </div>
              <h2>Add a new Billing Group.</h2>
              <p class="page-tagline">Create a group where you can collectively share and manage bills as a single unit.</p>

              <p class="error">
                <?php
                  if (isset($_GET['message'])) echo $_GET['message'];
                ?>
              </p>

              <form action="../modules/createGroup.php" method="post">
                <input name="name" placeholder="Group Name"></input>
                <input name="image" placeholder="Image URL"></input>

                <!-- <div class="people-slider"></div> -->
                <p class="range-field">
                  Group size
                  <input name="size" type="range" class="people-slider tooltipped" data-position="right" data-delay="50" data-tooltip="Slide all the way if you are not sure." min="0" max="20" />
                </p>
                <p class="unknown-notify"></p>

                <input name="desc" placeholder="Description"></input>
                <input class="btn btn-waves-effect waves-light" type="submit"></input>
              </form>

            </div>

            <div class="success-container">
              <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'>
              <svg style="display: none;" enable-background="new 0 0 128 128"
                height="128px" id="Layer_1"
                version="1.1"
                viewBox="0 0 128 128"
                width="128px"
                xml:space="preserve"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <path d="M116.158,29.336l-4.975-4.975c-3.469-3.469-9.088-3.478-12.549-0.019L48.103,74.875L29.364,56.136  c-3.459-3.46-9.078-3.45-12.549,0.021l-4.974,4.974c-3.47,3.47-3.48,9.089-0.02,12.549L41.8,103.657  c1.741,1.741,4.026,2.602,6.31,2.588c2.279,0.011,4.559-0.852,6.297-2.59l61.771-61.771  C119.637,38.424,119.631,32.807,116.158,29.336z" fill="white"/>
              </svg>
              <p style="display: none;">Go to the <a href="dashboard.php" style="color:white; font-weight:500; cursor:pointer;">dashboard</a></p>
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
