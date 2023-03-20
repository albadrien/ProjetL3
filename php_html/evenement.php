<?php
session_start();
require_once 'database.php'; //inclut à la base de donnée


//validation et envoie
@$supp = $_GET["supprimer"];
@$valider = $_GET["valider"];
@$description = $_GET["description"];
@$adresse = $_GET["adresse"];
@$type = $_GET["type"];
@$date = $_GET["date"];




// liste de events : 

$id = @mysqli_connect("localhost", "root", "root", "inscription") or die("Erreur de connexion 2");
$id->set_charset("utf8");
$res = mysqli_query($id, "SELECT * FROM events WHERE ID_client=  $_SESSION[id] ") or die("erreur");
$num = mysqli_num_rows($res);
$resultat = $id->query("SELECT * FROM events WHERE ID_client=  $_SESSION[id] ");
$cpt = 0;




while ($ligne = $resultat->fetch_assoc()) { // parcours le tableau en allant à la prochaine ligne, renvoie null si plus de ligne
    $tab[$cpt] = 'titre : ' . $ligne['Description'] ."<br>". 'Adresse : ' . $ligne['Adresse'] . "<br>". 'Type : ' . $ligne['Type'] . "<br>".  'Date : '. $ligne['Date'];
    $tab2[$cpt]=$ligne["ID_event"];
    $cpt++;
}

$afficher = "oui";



// supprimer un évènement
if (isset($supp)) {
   
    // recupération de l'ID de connexion à la table 
    $id = @mysqli_connect("localhost", "root", "root", "inscription") or die("Erreur de connexion 2");
    $id->set_charset("utf8");
    

    $res = mysqli_query($id, "SELECT * FROM events WHERE ID_event= $supp ") or die("erreur");
    $num = mysqli_num_rows($res);


    
    mysqli_query($id, "DELETE FROM events WHERE ID_event= $supp");
    header('Location:evenement.php');
   
}

// ajouter un évènement
if (isset($valider)) {
    
    // recupération de l'ID de connexion à la table 
    $id = @mysqli_connect("localhost", "root", "root", "inscription") or die("Erreur de connexion 2");
    $id->set_charset("utf8");
    
    $sql ="INSERT INTO events ( ID_client, Description, Adresse, Type, Date) VALUES ( '$_SESSION[id]', '$description','$adresse','$type','$date')";
    mysqli_query($id,$sql) or die("Erreur de modification");

    header('Location:evenement.php');
}





?>

<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/Logo.ico">
    <link rel="stylesheet" href="../css/styl2.css">
    <script src="../js/main.js"></script>
    <title>Mes Evenements</title>

</head>

<header>
    <a href = "profil_perso.php"> <button> Mon compte </button> </a>
</header>

<body>
    <img src="../photos/Fond.png" class="background" /> <!-- fond d'écran -->
    <h1>
        <p>Modifier mes évènements </p>
    </h1>

    <div class="profile tab" id="0" style="display: block;">
            <?php if (@$afficher == "oui") { ?>
            <div id="resultats">
                <div id="nbr"> <?= $num . " " . ($num > 1 ? "résultats trouvés" : "résultat trouvé") ?></div>
                <ol>
                    <?php for ($i = 0; $i < $cpt; $i++) { ?>
                        <li><?php 
                            echo $tab[$i] ;
                            ?>
                        </li> 
                        <form class="supp" >
                            <input type="hidden"  name="supprimer" value="<?php echo $tab2[$i]; ?>"  />
                            <input type="submit"  name="btn" value="supprimer"  />
                        </form>
                    <?php } ?>
                </ol>
            </div>
        <?php
        }

        ?>  

    </div>


    <div >
    <form >

        <label for="description"> Description :</label>
        <input type="textarea" name="description" id="description" required />

        <br />
        <label for="adresse"> Adresse :</label>
        <input type="textarea" name="adresse" id="adresse" required/>

        <br />
        <label for="type"> Type :</label>
        <input type="textarea" name="type" id="type" required/>

        <br />
        <label for="date"> Date :</label>
        <input type="date" name="date" id="date" required/>

        <br/>
        <input type="submit"  name="valider" value="Valider "  />
    </form>

    </div>

</body>

</html>