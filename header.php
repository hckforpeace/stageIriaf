
<?php
   $isauth = isset($_SESSION['auth']);
   

   $createaccount = '"createaccount.php"';
   $login = '"login.php"';
   $commentaires = '"comments.php"';
   $deconnexion = '"deconnexion.php"';
   $afficheusers = '"afficheuser.php"';
   $delusers = '"clearusers.php"';

   if(str_contains($_SERVER['REQUEST_URI'],"search.php"))
   {
    $createaccount = '"../createaccount.php"';
    $login = '"../login.php"';
    $commentaires = '"../comments.php"';
    $deconnexion = '"../deconnexion.php"';
    $afficheusers = '"../afficheuser.php"';
    $delusers = '"../clearusers.php"';

   }

   if($isauth)
   {
        echo '<h3> Bonjour '. $_SESSION['username'] .' </h3>';
        $isadmin= $_SESSION['role'] == 'admin';
   }
        
   



?>

<div>

<form method="get" action="/produit/search.php">

  
    <?php
    if(!$isauth)
    {
        echo '<input type="button" onclick= \' window.location.href = '. $createaccount .' \' value=\'creer un compte\'/>';
        echo '<input type="button" onclick= \' window.location.href = '. $login .' \' value=\'connexion\'/>';
        
    }
    else 
    {
        echo '<input type="button" onclick= \' window.location.href = '. $deconnexion .' \' value=\'Deconnexion\'/>';
        if($isadmin)
        {
            echo '<input type="button" onclick= \' window.location.href = '. $delusers.' \' value=\'delete\'/>';
            echo '<input type="button" onclick= \' window.location.href = '. $afficheusers.' \' value=\'affiche\'/>';
        }
    }

    if(!str_contains($_SERVER['REQUEST_URI'],"comments.php"))
        echo '<input type="button" onclick= \' window.location.href = '. $commentaires .' \' value=\'Commentaires\'/>';
    
    ?>
    
    
    <input type="submit" value="rechercher" />
    <input type="text" name="recherche" placeholder="Rechercher" 
    value="<?php echo (isset($_GET) and !empty($_GET['recherche'])) ? $_GET['recherche'] :  '' ?> "/>
   

</form>


</div>



