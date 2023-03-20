<!-- Lier notre projet à notre base php-->
<?php 
/* Si on a accès à la bdd*/
try{
    /*nom de la base de donnée*/
    //vérifier le host
    $bdd = new PDO('mysql:host=localhost;dbname=inscription;charset=utf8','root','root');
}catch (PDOException $e){
    die('Une erreur a été trouvée : '.$e->getMessage());
}
