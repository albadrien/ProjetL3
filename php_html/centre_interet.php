<?php
session_start();
require_once 'database.php'; //inclut à la base de donnée


//validation et envoie
@$valider = $_GET["valider"];

//activité :
@$sport = $_GET["sport"];
@$musique = $_GET["musique"];
@$dessin = $_GET["dessin"];
@$sortir = $_GET["sortir"];
@$photo = $_GET["photo"];
@$musee = $_GET["musee"];
@$jeux_s = $_GET["jeux_societe"];
@$cuisine = $_GET["cuisine"];
@$danse = $_GET["danse"];
@$jeux_v = $_GET["jeux_video"];




if (isset($valider)) {
    
    // recupération de l'ID de connexion à la table 
    $id = @mysqli_connect("localhost", "root", "root", "inscription") or die("Erreur de connexion 2");
    $id->set_charset("utf8");
    

    $res = mysqli_query($id, "SELECT * FROM centre_interet WHERE id_users=  $_SESSION[id] ") or die("erreur");
    $num = mysqli_num_rows($res);


    if($num==0){
        mysqli_query($id, "INSERT INTO centre_interet (sport, musique, photo, musee, sortir, jeux_societe, dessin, cuisine, danse, jeux_video ,id_users ) VALUES ('$sport','$musique','$photo','$musee','$sortir','$jeux_s','$dessin','$cuisine','$danse','$jeux_v',$_SESSION[id])") or die("Erreur d'insertion");
        
    }
    else{
        $sql ="UPDATE centre_interet SET sport='$sport', musique='$musique', photo='$photo', musee='$musee', sortir='$sortir', jeux_societe='$jeux_s', dessin='$dessin', cuisine='$cuisine', danse='$danse', jeux_video='$jeux_v' WHERE id_users=$_SESSION[id]";
        mysqli_query($id,$sql) or die("Erreur de modification" );
    }
    header('Location:recherche.php');
}


?>


<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/Logo.ico">
    <link rel="stylesheet" href="../css/style_centre_interet.css">
    <title>Centre d'interets</title>

</head>

<body>
    <img src="../photos/Fond.png" class="background" /> <!-- fond d'écran -->

    <div id="Description">    <!-- texte de fond -->
            <h1>It's a pleasur for us <br> to finaly meet <br>you !</h1>
        </div>
    
    <form class="interet">
        <h2>Vos centres d'intérêts Choisissez en 3 </h2>
        <p>J'aime pratiquer une activité physique : <input type="checkbox" name="sport" /></p>
        <p>J'aime écouter de la musique : <input type="checkbox" name="musique" /></p>
        <p>J'aime dessiner : <input type="checkbox" name="dessin" /></p>
        <p>J'aime faire la fête et sortir : <input type="checkbox" name="sortir" /></p>
        <p>J'ai une passion pour la photo : <input type="checkbox" name="photo" /></p>
        <p>J'aime faire des sorties culturelles : <input type="checkbox" name="musee" /></p>
        <p>J'aime faire des jeux de sociétés : <input type="checkbox" name="jeux_societe" /></p>
        <p>J'aime faire de la cuisine : <input type="checkbox" name="cuisine" /></p>
        <p>J'aime faire de la danse : <input type="checkbox" name="danse" /></p>
        <p>J'aime jouer au jeux vidéo : <input type="checkbox" name="jeux_video" /></p>
        <button type="submit" name="valider" value="Validez">Valider</button>
    </form>
</body>

</html>