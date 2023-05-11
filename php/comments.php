<?php
    include_once('bd.php');
    bd_connexion();
?>
<!DOCTYPE html>

    <?php 
    if(!empty($_POST))
    {
        #echo '<h1> name: '.$_POST['name'] . 'content: ' . $_POST['content'] .' </h1>';
        $sql = ' INSERT INTO Comments (name,content) VALUES ("'.$_POST['name'].'","'.$_POST['content'].'");';
        echo $sql;
        $result = bd_requete($sql,true);
        #if($result == false)
         #   echo '<h3 style="font-color: red"> Insertion Echoue </h3>';
    }
    ?>
    <head></head>

    <body>
        <h1>Commentaires</h1>
        <?php 
                $sql = 'SELECT * FROM Comments ;';
                $result = bd_requete($sql,true);
                while (($ligne = $result->fetch(PDO::FETCH_ASSOC)) !== false)
                {
                    echo '<div>';
                    echo '<h2>' . $ligne['name'] . '</h2>';
                    echo '<p>' . $ligne['content'] . '</p>';
                    echo '</div>';
                }
                $result->closeCursor();

        ?>

        <h2> Post your comment </h2>

        <form action="comments.php" method="post">

            <div>
            <input type="text" name="name" required>
            </div>
            <div>
            <textarea name="content" rows="6" cols="10" required >
            <div>
            </textarea>
            </br>

            <input type="submit" value="submit">
        </form>

    </body>

</html>
<?php 

    bd_deconnexion();
?>