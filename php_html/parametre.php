<?php
session_start();
require_once 'database.php'; //inclut à la base de donnée


//validation et envoie
@$valider = $_GET["valider"];
@$biographie = $_GET["biographie"];
@$age = $_GET["age"];
@$pays = $_GET["pays"];
@$ville = $_GET["ville"];

if (isset($valider)) {
    
    // recupération de l'ID de connexion à la table 
    $id = @mysqli_connect("localhost", "root", "root", "inscription") or die("Erreur de connexion 2");
    $id->set_charset("utf8");
    

    $res = mysqli_query($id, "SELECT * FROM users WHERE id=  $_SESSION[id] ") or die("erreur");
    $num = mysqli_num_rows($res);


    if($num==1){
        $sql ="UPDATE users SET biographie='$biographie', age='$age', pays='$pays', ville='$ville'  WHERE id=$_SESSION[id]";
        mysqli_query($id,$sql) or die("Erreur de modification" );
    }
    header('Location:connexion.php');
}


?>

<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/Logo.ico">
    <link rel="stylesheet" href="../css/styl2.css">
    <title>Paramètre</title>

</head>

<body>
    <img src="../photos/Fond.png" class="background" /> <!-- fond d'écran -->
    <h1>
        <p>Modifier vos paramètres </p>
    </h1>
    <form class="interet" >

        <label for="age"> Age :</label>
        <input type="number" name="age" id="age" min="18" max="115" required />

        <br />
        <label for="pays"> Pays :</label>
        <input type="text" name="pays" id="pays" required/>

        <br />
        <label for="ville"> Ville :</label>
        <input type="text" name="ville" id="ville" required/>

        <br />
        <label for="biographie"> biographie :</label>
        <input type="text" name="biographie" id="biographie" />

        <br />
        <p>Si vous validez vous devrez vous reconnecter</p>
        <input type="submit"  name="valider" value="Validez"  />
    </form>
</body>

</html>