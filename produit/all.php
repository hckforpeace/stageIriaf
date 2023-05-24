<?php
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	
	include_once('../database/bd.php');
        bd_connexion(); 
?>

<html>
<head>
    <?php
	include "../header.php"
    ?>
</head>
<body>
<br>
<br>
<br>
<br>
	<div>
	Tout les produits wouhou
	<?php
	$sql = 'select rowid, * from produit';
	#$sql = 'INSERT INTO PRODUIT(nom, prix) values("carotte", 15)';
	$res = bd_requete($sql);
            // - afficher le résultat dans une table  hTML
            echo '<table><thead><tr><th>id</th><th>nom</th><th>prix</th></tr></thead><tbody>';
            while(($ligne = $res->fetch(PDO::FETCH_ASSOC))) {
                echo '<tr><td>' . $ligne["rowid"] . '</td>' . '<td>' . $ligne["nom"] . '</td>' . '<td>' . $ligne["prix"] . '</td>';
            }
	$res->closeCursor();
	
	?>
	</div>

<?php
include "../footer.php"
?>
</body>
</html>
