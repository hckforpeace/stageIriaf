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
	Recherche :
	<?php
	if (isset($_GET) and !empty($_GET['recherche'])){
		$sql = 'select rowid, * from produit where nom like \'%'.$_GET['recherche'] . '%\'';
		print_r($sql."<br>");
		#$sql = 'select rowid, * from produit where nom like \'%'.$_POST['recherche'] . '%\' union SELECT username,password,1 FROM user';
		$res = bd_requete($sql);
		#echo '<table><thead><tr><th>id</th><th>nom</th><th>prix</th></tr></thead><tbody>';
		while(($ligne = $res->fetch(PDO::FETCH_ASSOC))) {
			echo '<tr><td>' . $ligne["rowid"] . '</td>' . ' <td>' . $ligne["nom"] . '</td> ' . '<td>' . $ligne["prix"] . '</td><br>';
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
