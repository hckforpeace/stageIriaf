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
	<?php
	if (isset($_GET) and !empty($_GET['recherche'])){
		$sql = 'select rowid, * from produit where nom like \'%'.$_GET['recherche'] . '%\'';
		// print_r($sql."<br>");
		#$sql = 'select rowid, * from produit where nom like \'%'.$_POST['recherche'] . '%\' union SELECT username,password,1 FROM user';
		$res = bd_requete($sql);
		#echo '<table><thead><tr><th>id</th><th>nom</th><th>prix</th></tr></thead><tbody>';
		
		while(($ligne = $res->fetch(PDO::FETCH_ASSOC))) {
			// echo '<tr><td>' . $ligne["rowid"] . '</td>' . ' <td>' . $ligne["nom"] . '</td> ' . '<td>' . $ligne["prix"] . '</td><br>';
			echo '<div class="card" style="display:inline-block">';
			echo '<img src="'. $ligne["image"] . '" alt="Avatar"   style="width: 100px; height:100px;">';
			echo '<div class="container">';
			echo '<h4><b> Produit: '. $ligne["nom"] .'</b></h4> ';
			echo '<p> Prix: '. $ligne["prix"].'</p>'; 
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
