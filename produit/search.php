<?php
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	
	session_start();
	include_once('../database/bd.php');
        bd_connexion(); 
?>

<html>
<head>
    <?php
	include "../header.php"
    ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="stylesheet" href="../style/inputs.css">
</head>
<body>
<br>
<br>
<br>
<br>
	<div>
	Recherche :
	<?php
	if (isset($_GET) and !empty($_GET['recherche'])){
		$req = 'select * from produit where nom like \'%'.$_GET['recherche'] . '%\'';
		echo $req . '<br>';
		$res = bd_requete($req);
		
		//TODO 2.2 : Modifier $req et utiliser la fonction bd_requete_preparee à la place
		
		//$params = ['recherche' => '%'.$_GET['recherche'].'%'];
		//$res = bd_requete_preparee($sql, $params);
		
		while(($ligne = $res->fetch(PDO::FETCH_ASSOC))) { // Affichage de la requête
			echo '<div class="card" style="display:inline-block">';
			echo '<img src="'. $ligne["image"] . '" alt="Avatar"   style="width: 100px; height:100px;">';
			echo '<div class="container">';
			echo '<h4><b>'. $ligne["nom"] .'</b></h4> ';
			echo '<p>Prix: '. $ligne["prix"].'€</p>'; 
			echo '</div>';
			echo '</div>';
		}
		$res->closeCursor();
	
	}
	else{
	 echo 'pas de recherche';
	}
	
	
	?>
	</div>

<?php
include "../footer.php"
?>
</body>
</html>
