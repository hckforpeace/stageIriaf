<?php

session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')
{
    header('Location: '. 'http://127.0.0.1/comments.php');
}
else
{
    include_once("database/bd.php");
    session_start();
    if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')
        header('Location: '. 'http://127.0.0.1/comments.php');
    bd_connexion();
    $sql = 'DELETE FROM users where role != "admin" ;';
    bd_requete($sql);
    bd_deconnexion();
    header('Location: '. 'http://127.0.0.1/index.php');
}
?>