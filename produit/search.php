<?php
	session_start();
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
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="stylesheet" href="../style/inputs.css">
</head>
<body>
<br>
<br>
<br>
<br>
	<div>
	<?php
	if (isset($_GET) and !empty($_GET['recherche'])){
		$req = 'select * from produit where nom like \'%'.$_GET['recherche'] . '%\'';
		echo $req . '<br>';
		$res = bd_requete($req);

		//$params = [];
		//$res = bd_requete_preparee($req, $params);
		//TODO 2.2 : Modifier $req et utiliser la fonction bd_requete_preparee à la place

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
	
	}
	else{
	 echo 'pas de recherche';
	}
	
	
	?>
	</div>
<br><br>
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
