<?php

  // If the index page is currently loaded, the path references are slightly different as the rest of the pages are located in the 'pages' directory.
  if (!isset($indexPage)) $indexPage = false;

?>

<header>
    <nav>
        <ul>
            <?php

            echo '
            <li><a href="'.($indexPage ? "index.php" : "../index.php").'">Home</a></li>
            <li><a href="'.($indexPage ? "pages/about.php" : "about.php").'">About</a></li>
            <li><a href="'.($indexPage ? "pages/login.php" : "login.php").'">Login</a></li>
            ';

            ?>

        </ul>
    </nav>
</header>
