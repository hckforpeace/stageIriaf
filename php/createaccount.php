<?php 
include_once("bd.php");
bd_connexion();
$error_message = "erreur dans le/les Champ(s)";
$errors= false;

function contains(string $mot,array $liste): bool
{
    $rep = false;
    foreach($liste as $val)
    {
        $rep = $rep || str_contains($mot,$val);
    }
}
?>
<!DOCTYPE html>
    <head>
    <link rel="stylesheet" href="style.css">
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
                $sql = 'INSERT INTO users (username,password,email) VALUES ("'. $_POST['username']. '","' . $_POST['pwd']. '","'. $_POST['email'] .'") ' ;
                $result = bd_requete($sql,true);
            }
                
        }
        
        ?>
        <form action="createaccount.php" method="post">
            <h1>Sign In</h1>
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
        <a href="afficheuser.php"> Affiche users </a>
        <br/>
        <a href="clearusers.php"> Delete tout les users <a>

    </body>
</html>

<?php 
bd_deconnexion();
?>