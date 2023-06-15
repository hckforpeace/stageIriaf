<?php 
include_once("database/bd.php");



bd_connexion();
$error_message = "erreur dans le/les Champ(s)";
$errors = false;
include "state.php";


?>
<!DOCTYPE html>
    <head>
    <link rel="stylesheet" href="style/inputs.css">
    <link rel="stylesheet" href="style/silo.css">
    <title> logIn </title>
    <head>
    <body>
        <?php 
        if(!empty($_POST))
        {
            if( preg_match('/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/',$_POST['email']) != 1)
            {
                $error_message = $error_message . "email";
                $errors = true;
                
            }
            if($_POST['pwd'] != $_POST['cpwd'])
            {
                $error_message = $error_message . " mot de passe";
                $errors = true;
            }

            if($errors == false)
            {
                // $pwd = hash('sha256', $_POST['pwd'], false); correction
                $sql = 'INSERT INTO users(username,password,email) VALUES ("'. $_POST['username']. '","' . $_POST['pwd'] . '","'. $_POST['email'] .'") ' ;
                $result = bd_requete($sql,true);
                header('Location: '. 'http://127.0.0.1/login.php');
            }
                
        }
        
        ?>
        <form action="createaccount.php" method="post">
            <h1>S'inscrire</h1>
            </br>
            <?php
            if($errors)
                echo '<h2>' . $error_message .' <h2>';
            ?>
            <div>
                <input type="text" placeholder="email" name="email" value="" required>
            </div>
            
            <div>
                <input type="text" placeholder="username"  name="username" value="" required>
            </div>
            
            <div>
                <input type="password" placeholder="password" name="pwd" value="" required>
            </div>
            
            <div> 
                <input type="password" placeholder="password" name="cpwd" value="" required>
            </div>

            <input type="submit" value="create">
           
        </form>
    <br/>
    <a href="afficheuser.php" <?php echo $hidhide?> > Affiche users </a>
    <br/>
    <a href="clearusers.php" <?php echo $hidhide?>> Delete tout les users <a>
    </br>
    <a href="http://127.0.0.1/index.php">Menu Principal</a>
        
    <footer>
    <?php
    include "footer.php"
    ?>
    </footer>
    </body>
</html>

<?php 
bd_deconnexion();
?>