<?php
    include_once("database/bd.php");
    bd_connexion();
    $etat = "";
    include "state.php";
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="style/inputs.css">
    <link rel="stylesheet" href="style/silo.css">
    <title> LogIn </title>
</head>
<body>
    <?php    
    if(!empty($_POST))
    {
        if(!empty($_POST['login']) && !empty($_POST['mdp']))
        {
            
            $pwd = bd_hash($_POST['mdp']);
            $sql = 'SELECT * FROM users WHERE users.username = "' . $_POST['login'] . '" AND users.password = "'. $_POST['mdp']. '";';
            $result = bd_requete($sql,true);
            $ligne = $result->fetch(PDO::FETCH_ASSOC);

            if(empty($ligne)) // Si le login est incorrecte
            {
                $etat = "Login incorrect";
            }
            else
            {
                session_start();
                $_SESSION["auth"] = true;
                $_SESSION['username'] = $_POST['login'];
                $_SESSION['role'] = $ligne['role'];
                header('Location: '. 'index.php');
            }



        }
    } 
    ?> 

    <form action="login.php" method="post">

        <h1>Connexion</h1>
        <?php
        echo '<h3 style: color: red;> '. $etat .'</h3>';
         ?>


        <div> <input name="login" type="text" placeholder="login" required> </div>
        
        <div> <input name="mdp" type="password" placeholder="password" required>  </div>

        <input type="submit" value="submit">

        <br/>
        <a href="afficheuser.php" <?php echo $hidhide; ?>> Affiche users </a>
        <br/>
        <a href="clearusers.php" <?php echo $hidhide; ?> > Delete tout les users <a>
        <br/>
        <a href="createaccount.php"> creer un compte <a>
        </br>
        <a href="index.php">Menu Principal</a>
        

    </form>

</body>
</html>
<?php 

    bd_deconnexion();
?>
