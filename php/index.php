<?php
    include_once("bd.php");
    bd_connexion();
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php    
    if(!empty($_POST))
    {
        if(!empty($_POST['login']) && !empty($_POST['mdp']))
        {
            echo '<h2>';
            echo "login: ". $_POST['login'] . " mdp: ". $_POST['mdp'];
            echo '</h2>';
        }
    } 
    ?> 

    <form action="index.php" method="post">

        <h1>Home/Login</h1>


        <div> <input name="login" type="text" placeholder="login" required> </div>

        
        
        <div> <input name="mdp" type="password" placeholder="password" required>  </div>

        <input type="submit" value="submit">
    </form>

</body>
</html>
<?php 

    bd_deconnexion();
?>