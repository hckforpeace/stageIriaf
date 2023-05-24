<?php 
session_start();
if(!isset($_SESSION['auth']))
{
    header('Location: '. 'http://127.0.0.1/login.php');
}


?>
<!DOCTYPE html>
    <head>
    <link rel="stylesheet" href="style.css">

    </head>
    <body>
        <div class="center" >
            <?php
        echo '<h1> Bonjour  '. $_SESSION['username'] .'</h1>' ;
    ?>
    </div>
    </body>

</html>