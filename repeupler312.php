<?php
    include_once("database/bd.php");
    bd_connexion();
    $users = ['pierre' => 'password'];
    foreach($users as  $k => $v){
	$req = 'UPDATE users SET password =\'' . bd_hash($v) . '\' WHERE username = \'' . $k . '\'';
	bd_requete($req);
	echo $req;
    }
	
    //header('Location: '. 'index.php');
?>
