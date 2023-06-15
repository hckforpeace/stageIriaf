<?php 
include_once("database/bd.php");
bd_connexion();
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')
    {
        header('Location: '. 'index.php');
    }
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
          echo '<th> role </th>';


          while (($ligne = $result->fetch(PDO::FETCH_ASSOC)) !== false)
            {
                echo '<tr>';
                echo '<td>'. $ligne['id'] .'</td>';
                echo '<td>'. $ligne['username'] .'</td>';
                echo '<td>'. $ligne['password'] .'</td>';
                echo '<td>'. $ligne['email'] .'</td>';
                echo '<td>'. $ligne['role'] .'</td>';
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