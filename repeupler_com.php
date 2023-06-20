<?php
    include_once("database/bd.php");
    bd_connexion();

    $sql = 'SELECT * FROM Comments ;';
    $result = bd_requete($sql,true);
    $cnt = 1 ;
    while (($ligne = $result->fetch(PDO::FETCH_ASSOC)) !== false)
    {
        $req = 'UPDATE Comments SET content =\'' . htmlspecialchars($ligne['content']) . '\' WHERE oid = ' . $cnt . '';
        $res = bd_requete($req,true);
        $res->closeCursor();

        $req = 'UPDATE Comments SET name =\''. htmlspecialchars($ligne['name']) .'\' WHERE oid = ' . $cnt . '';
        $res = bd_requete($req);
        $res->closeCursor();
        $cnt++;
    }

        
    $result->closeCursor();
	header('Location: '. 'comments.php');
?>

