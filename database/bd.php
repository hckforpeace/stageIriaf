<?php

    $bd_pdo = null;

    // affichage d'une erreur
    function bd_erreur($msg)
    {
        echo '<h1>Erreur base de données</h1>';
        echo '<p>' . $msg . '</p>';
        exit(1);
    }
    
    function bd_connexion()
    {
        global $bd_pdo;

        try
        {
  	    
            $bd_file = '/database.sqlite';
            $bd_pdo = new PDO('sqlite:' .dirname(__FILE__) .$bd_file);
            //$bd_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // valeur par défaut
            $bd_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);  // ou PDO::ERRMODE_SILENT
            //$bd_pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            bd_requete('PRAGMA foreign_keys = ON;', true);
        }
        catch (PDOException $e)
        {
            // ne jamais faire ces affichages en prod
            echo "Erreur : " . $e->getMessage() . "\n";
            print_r($e);
            exit();
        }
    }

    
    function bd_deconnexion()
    {
        global $bd_pdo;
        $bd_pdo = null;
    }

    function bd_requete($requete, $stopOnError = false)
    {
        global $bd_pdo;
        try{
	$result = $bd_pdo->query($requete);
        }
	catch(PDOException $e){
		echo $e->getMessage();
	}
        if ($stopOnError)
        {
            if ($result === false)
                bd_erreur('erreur requête "' . $requete . '"');
        }
	
        return $result;
    }


    function bd_requete_preparee($requete, $params = [], $stopOnError = false)
    {
        global $bd_pdo;

        $result = $bd_pdo->prepare($requete);  

        if ($result === false)
        {
            if ($stopOnError)
                bd_erreur('erreur requête préparée"' . $requete . '"');
            return false;
        }

        $ret = $result->execute($params);
        if ($ret === false)
        {
            if ($stopOnError)
                bd_erreur('erreur requête execute"' . $requete . '"');
            return false;
        }

        return $result;
    }

    
    //A compléter pour l'exerice 3.1.2
    //Fonction de salage d'une variable
    $salt = null;
    function bd_salage($var){
    }
    
    function bd_hash($var){
    	return hash('sha256', $var.'toto');
    }

?>

