<?php
    include_once("database/bd.php");
    bd_connexion();
    $users = ['pierre' => 'password','timothe'=>'secret123'];
    foreach($users as $k=>$v){
		$req = 'UPDATE users SET password =\'' . bd_hash($v) . '\' WHERE username = \'' . $k . '\'';
		$res = bd_requete($req);
		$res->closeCursor();
    }
	header('Location: '. 'index.php');
?>

