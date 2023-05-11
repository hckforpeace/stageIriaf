<?php 
include_once("bd.php");
bd_connexion();
?>
<!DOCTYPE html>
    <head> 

    </head>
    <body>
        <?php $sql = 'SELECT *  FROM  users ;';
          $result = bd_requete($sql,true);

          echo '<table>';
          echo '<th> id </th>';
          echo '<th> username </th>';
          echo '<th> password </th>';
          echo '<th> email </th>';


          while (($ligne = $result->fetch(PDO::FETCH_ASSOC)) !== false)
            {
                echo '<tr>';
                echo '<td>'. $ligne['id'] .'</td>';
                echo '<td>'. $ligne['username'] .'</td>';
                echo '<td>'. $ligne['password'] .'</td>';
                echo '<td>'. $ligne['email'] .'</td>';
                echo '</tr>';
            }
          echo '</table>';
            $result->closeCursor();
        
        ?>
    </body>
</html>
<?php 
bd_deconnexion();
?>