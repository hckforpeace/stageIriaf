<?php
    include_once("bd.php");
    bd_connexion();
    $sql = 'DELETE FROM users ;';
    bd_requete($sql);
    bd_deconnexion();
    header('Location: '. 'http://localhost:8000/createaccount.php');
?>