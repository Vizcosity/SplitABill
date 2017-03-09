<?php session_start();

  // If the index page is currently loaded, the path references are slightly different as the rest of the pages are located in the 'pages' directory.
  if (!isset($indexPage)) $indexPage = false;

?>

<header>
    <nav>
        <ul>
            <?php

            $loginUrl = isset($_SESSION['id']) ? ($indexPage ? "modules/logout.php" : "../modules/logout.php") : ($indexPage ? "pages/login.php" : "login.php");

            $style = (isset($_SESSION['id']) ? "style='color: #ea8282'" : "");


            echo '
            <li><a href="'.($indexPage ? "index.php" : "../index.php").'">Home</a></li>
            <li><a href="'.($indexPage ? "pages/dashboard.php" : "dashboard.php").'">Dashboard</a></li>
            <li><a href="'.$loginUrl.'"'.$style.'>'.(isset($_SESSION['id']) ? "Logout" : "Login").'</a></li>
            ';

            ?>

        </ul>
    </nav>
</header>
