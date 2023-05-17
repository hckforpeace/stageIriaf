<div>
<form method="get" action="/produit/search.php">
    <input type="search" name="recherche" placeholder="Rechercher" value="<?php echo (isset($_GET) and !empty($_GET['recherche'])) ? $_GET['recherche'] :  '' ?> "/>
    <input type="submit" value="Go" />
</form>
</div>
