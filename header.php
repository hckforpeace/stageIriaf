
<?php
   $isauth = isset($_SESSION['auth']);
   

   $createaccount = '"createaccount.php"';
   $login = '"login.php"';
   $commentaires = '"comments.php"';
   $deconnexion = '"deconnexion.php"';
   $produits = '"/produit/all.php"';
   $afficheusers = '"afficheuser.php"';
   $delusers = '"clearusers.php"';

   if(str_contains($_SERVER['REQUEST_URI'],"produit"))
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
        echo '<input type="button" onclick= \' window.location.href = '. $createaccount .' \' value=\'Creer un compte\'/>';
        echo '<input type="button" onclick= \' window.location.href = '. $login .' \' value=\'Connexion\'/>';
        
    }
    else 
    {
        echo '<input type="button" onclick= \' window.location.href = '. $deconnexion .' \' value=\'Deconnexion\'/>';
        if($isadmin)
        {
            echo '<input type="button" onclick= \' window.location.href = '. $delusers.' \' value=\'Delete\'/>';
            echo '<input type="button" onclick= \' window.location.href = '. $afficheusers.' \' value=\'Affiche\'/>';
        }
    }

    if(!str_contains($_SERVER['REQUEST_URI'],"comments.php"))
        echo '<input type="button" onclick= \' window.location.href = '. $commentaires .' \' value=\'Commentaires\'/>';
    echo '<input type="button" onclick= \' window.location.href = '. $produits .' \' value=\'Produits\'/>';
    ?>
    
    <br><br>
    <input type="submit" value="rechercher" />
    <input type="text" name="recherche" placeholder="Rechercher" style="min-width:600px;width:45%;max-width: 1000px;"
    value="<?php echo (isset($_GET) and !empty($_GET['recherche'])) ? $_GET['recherche'] :'' ?>"/>
   

</form>


</div>



