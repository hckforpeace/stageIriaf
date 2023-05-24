<?php
    // peut-être plus adéquat de faire les déclarations dans bd_connexion (pour éviter les variables globales) ?
    $bd_file = '/database.sqlite';

    // pour PDO : instance de la classe
    // Ce n'est pas élégant d'avoir une variable globale.
    // Il serait préférable que la fonction de connexion renvoie la variable
    // au script appelant. Cette variable serait alors passée en paramètre aux
    // autres fonctions.
    // Mais cette solution simplifie les scripts et on peut voir cette variable
    // comme locale au fichier
    $bd_obj = null;

    // affichage d'une erreur
    function bd_erreur($msg)
    {
        echo '<h1>Erreur base de données</h1>';
        echo '<p>' . $msg . '</p>';
        exit(1);
    }

    // protection d'une chaîne mise dans une requête SQL
    // note : utiliser les requêtes préparées dispense de cette gestion
    function bd_quote($s)
    {
        global $bd_obj;
        return $bd_obj->quote($s);
    }

    // connexion à la BD, arrêt du script en cas d'erreur
    function bd_connexion()
    {
        global $bd_file, $bd_obj;
        // TODO 3.2 :
        // - on fait ici le try/catch pour affecter $bd_obj
        // - on paramètre l'attribut DO::ATTR_ERRMODE avec la valeur PDO::ERRMODE_WARNING
        // - on exécute la requête : 'PRAGMA foreign_keys = ON;'
        try
        {
            $bd_obj = new PDO('sqlite:' .dirname(__FILE__). $bd_file);
            //$bd_obj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // valeur par défaut
            $bd_obj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);  // ou PDO::ERRMODE_SILENT
            //$bd_obj->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
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

    // déconnexion (code obligeament fourni)
    function bd_deconnexion()
    {
        global $bd_obj;
        $bd_obj = null;
    }

    // fonction envoyant la requête au serveur de base de données
    // En cas d'erreur, la fonction ne s'arrête que si l'appelant l'autorise
    // explicitement via le second paramètre
    // Le premier paramètre est la chaîne de caractères contenant la requête SQL
    function bd_requete($requete, $stopOnError = false)
    {
        global $bd_obj;
        $result = $bd_obj->query($requete);  // TODO 3.2 :  faire ici une requête avec $bd_obj et la méthode query
        
        // On ne peut pas arrêter d'office le programme s'il y a une erreur.
        // L'appelant pourrait vouloir la traiter (par exemple s'il y a une
        // violation d'une contrainte d'intégrité).
        if ($stopOnError)
        {
            if ($result === false)
                bd_erreur('erreur requête "' . $requete . '"');
        }

        return $result;
    }

    // fonction envoyant la requête préparée au serveur de base de données
    // En cas d'erreur, la fonction ne s'arrête que si l'appelant l'autorise
    // explicitement via le troisième paramètre (cf. code de bd_requete
    // pour des remarques supplémentaires).
    // Le premier paramètre est la chaîne de caractères contenant la requête préparée SQL
    // Le second paramètre est le tableau des paramètres à passer à la requête
    function bd_requete_preparee($requete, $params = [], $stopOnError = false)
    {
        global $bd_obj;

        $result = $bd_obj->prepare($requete);  // TODO 3.2 :  faire ici une requête avec $bd_obj et la méthode prepare

        if ($result === false)
        {
            if ($stopOnError)
                bd_erreur('erreur requête préparée"' . $requete . '"');
            return false;  // inutile de continuer
        }

        // TODO 3.2 : appliquer ici la méthode execute
        $ret = $result->execute($params);   // TODO 3.2 :  remplacer par le code d'exécution
        if ($ret === false)
        {
            if ($stopOnError)
                bd_erreur('erreur requête execute"' . $requete . '"');
            return false;
        }

        return $result;
    }

