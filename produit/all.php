<?php
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	
	include_once('../database/bd.php');
        bd_connexion(); 
?>

<html>
<head>
	<link rel="stylesheet" href="../style/inputs.css">
    <?php
	include "../header.php";
    ?>
	
</head>
<body>
<br>
<br>
<br>
<br>
	<div>
	Produits :<br>
	<?php
	$sql = 'select rowid, * from produit';
	$res = bd_requete($sql);
            // - afficher le résultat dans une table  hTML
            while(($ligne = $res->fetch(PDO::FETCH_ASSOC))) {
				echo '<div class="card" style="display:inline-block">';
				echo '<img src="'. $ligne["image"] . '" alt="Avatar"   style="width: 100px; height:100px;">';
				echo '<div class="container">';
				echo '<h4><b> Produit: '. $ligne["nom"] .'</b></h4> ';
				echo '<p> Prix: '. $ligne["prix"].' €</p>'; 
				echo '</div>';
				echo '</div>';
			}
	$res->closeCursor();
	
	?>
	</div>
<br>
<br>
<br>
<br>
	
<div>
<footer>
<?php
include "../footer.php";
?>
</footer>
</body>
<?php 
bd_deconnexion();
?>
</html>
