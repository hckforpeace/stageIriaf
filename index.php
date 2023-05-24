<?php
	session_start();
	

	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	
	include_once('database/bd.php');
?>

<html>
<head>
	<link rel="stylesheet" href="Style/inputs.css">
    <?php
	include "header.php";
    ?>
	
</head>
<body>
<br>
<br>
<br>
<br>
	<div>
	Bonjour index ici
	</div>
<div>
	<footer>
<?php
include "footer.php";
?>
</footer>
</body>
<?php 
?>
</html>
