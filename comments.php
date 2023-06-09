    <?php
    include_once('database/bd.php');
    bd_connexion();
    
    $uname = "";
    session_start();

    if(isset($_SESSION['auth']))
    {
        $uname = $_SESSION['username'];
    }
    include "state.php";

    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
        
    
?>
<!DOCTYPE html>

        <?php 
        if(!empty($_POST))
        {            
            //TODO modifier $sql en encodant les valeurs dans le $_POST
            
            $sql = 'insert into Comments (name,content) values ("'.$_POST['name'].'","'. $_POST['content'] .'");';
            $result = bd_requete($sql,true);
        }
        ?>
        
    <head>
    <?php
	include "header.php"
    ?>
	<link rel="stylesheet" href="style/inputs.css">
    </head>

    <body>
    
        <h1>Commentaires</h1>
        <?php 
                $sql = 'SELECT * FROM Comments ;';
                $result = bd_requete($sql,true);
                while (($ligne = $result->fetch(PDO::FETCH_ASSOC)) !== false)
                {
                    echo '<fieldset>';
                    echo '<div>';
                    echo '<Label> <b> Nom: </b></label>' .'<p>' . $ligne['name'] . '</p>';
                    echo '<label> <b> commentaire: </b> </label>'.'<p>' . $ligne['content'] . '</p>';
                    debug_to_console($ligne['content'] );
                    echo '</div>';
                    echo '</fieldset>';
                }
                $result->closeCursor();

        ?>

        <h2> Post your comment </h2>

        <form action="comments.php" method="post">
            
            <div>
                <label> <b>Nom</b> </label>
            </div>
            <div>
            <input type="text" size="23" name="name" <?php echo 'value=\' '. $uname . '\' '; ?> required>
            </div>
            <div>
                <label> <b>Commentaire</b> </label>
            </div>
            <div>
            <textarea name="content" rows="6" cols="25" required ></textarea>
            </div>
            </br>

            <input type="submit" value="submit">
        </form>
        <a href="delcomments.php" <?php echo $hidhide; ?>>delete comments</a>
            </br>
        <a href="/index.php">Menu Principal</a>

        <footer>
        <?php
        include "footer.php";
        ?>
        </footer>
    </body>


</html>
<?php 

    bd_deconnexion();
?>