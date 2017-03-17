<?php

// session_save_path("/tmp");

session_start();


  // If the index page is currently loaded, the path references are slightly different as the rest of the pages are located in the 'pages' directory.
  if (!isset($indexPage)) $indexPage = false;

?>

<script>

  $(document).ready(function(){
  // Add on click event to the notifiationIcon.
  $('a.notifyBtn').click(function(e){

    // Prevent the link from taking it away.
    e.preventDefault();

    // Toggle the hidden class to allow it to pop up.
    $('.notificationBox').toggleClass('hidden');

    // Grab the user id from the box element data-user-id attribute.
    var userID = $('.notificationBox').data('user-id');

    // Send a post request for the notifications for a specific user.
    $.post("../modules/notificationFetch.php", {userID: userID}, function(response){

      // console.log(response);

      // Hide the preloader because the information is ready to be displated.
      $('.progress').fadeOut();

      // If the request was successful and the formatted Notifications exist, append the html
      // to the notificationBox.
      if (response) $('div.notification-content').html(response);

    });

  });
});

</script>
<header>
    <nav>
              <i class="material-icons" style="
            color: #5d5d5d;
            margin-left: 20px;
        ">thumbs_up_down</i>
        <ul>
            <?php

            $loginUrl = isset($_SESSION['id']) ? ($indexPage ? "modules/logout.php" : "../modules/logout.php") : ($indexPage ? "pages/login.php" : "login.php");

            $style = (isset($_SESSION['id']) ? "style='color: #ea8282'" : "");


            echo '
            <li><a href="'.($indexPage ? "index.php" : "../index.php").'">Home</a></li>
            <li><a href="'.($indexPage ? "pages/dashboard.php" : "dashboard.php").'">Dashboard</a></li>';

            // Include notifications only if logged in.
            if (isset($_SESSION['id'])) include("notificationBox.php");

            echo '<li><a href="'.$loginUrl.'"'.$style.'>'.(isset($_SESSION['id']) ? "Logout" : "Login").'</a></li>';

            ?>

        </ul>
    </nav>
</header>
