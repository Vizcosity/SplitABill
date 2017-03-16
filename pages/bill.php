<?php
  session_start();

  include("../modules/billFetch.php");

  // Check to see if the billID is set and that the user has access to it.
  // If not, redirect to the user's dashboard.

  // Grab the bill Data so that it can be inserted later on in the page.
  $billData = fetchBillDetailsByID($_SESSION['id'], $_GET['id']);
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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Scripts -->
        <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>

        <script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
        crossorigin="anonymous"></script>

          <!-- Materialize -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
        <script src="../js/bill.js"></script>
    </head>
    <body>
        <!-- <div class="header-container"> -->
            <?php include("../modules/navbar.php"); ?>
        <!-- </div> -->

      <div class="body-container-wrap">

        <div
          data-id="<?php echo $billData['id'];  ?>"
          data-userID="<?php echo $_SESSION['id']; ?>"
          data-amtPaid="<?php echo $billData['selfCost']; ?>"
          class="main-container"
        >

          <div class="header-wrap">
            <i class="material-icons">attach_money</i>
            <h2>
              <?php echo $billData['name']; ?>
            </h2>
          </div>

            <div class="main-content-wrap">



              <p>Due:</p>

              <div class="due-wrap">
              <h2 class="due-amount">
                <!-- Echo the bill amount from the details obtained earlier. -->
                <?php echo "£".$billData['selfCost'];?>
              </h2>

              <p class="bill-total">
                <!-- Show what the total bill isout of -->
                <?php echo "/£".$billData['remaining']; ?>
              </p>

              </div>

              <div class="members-wrap">
                <p>Associated Members:</p>
                <!-- <div class="chip">
                  <img src="https://www.rhinonetworks.com/sites/all/themes/twmshop/images/default_profile.jpg" alt="Contact Person">
                  Aaron
                </div> -->
                <?php
                  echo getUsersInBill($_GET['id']);
                ?>
              </div>

              <div class="desc-wrap">
                <h2>Description</h2>
                <p>
                  <?php echo $billData['description']; ?>
                </p>
              </div>

              <div class="buttons-wrap">
                <a id="payNow" href="#payNowModal" class="waves-effect waves-light blue accent-1 btn btn-flat">Pay Now</a>
                <a id="defer" class="waves-effect waves-light btn red lighten-1 btn-flat">Defer</a>
              </div>

            </div>

            <!-- Modal confirmation box on PayNow click -->
            <div id="payNowModal" class="modal">
              <div class="modal-content">
                <h4>Confirm Payment.</h4>
                <p>Are you sure you would like to mark this bill as paid?</p>
                <table>
                  <thead>
                    <tr>
                      <th data-field="id">Bill</th>
                      <th data-field="price">Amount to pay</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td><?php echo $billData['name']; ?></td>
                      <td><?php echo "£".$billData['selfCost']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <a id="confirmPayment" class=" modal-action modal-close waves-effect waves-green btn-flat">Yes</a>
                <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">No</a>
              </div>
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
          <!-- <div class="bg-image"></div> -->
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
