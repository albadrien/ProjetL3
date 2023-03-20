<?php
    session_start();
    require_once 'database.php';
    @$keywords = $_GET["keywords"];
    @$valider = $_GET["valider"];
    if (isset($valider) && !empty($keywords)) {
        $id = @mysqli_connect("localhost", "root", "root", "inscription") or die("Erreur de connection 2");
        $id->set_charset("utf8");
        $res = mysqli_query($id, "SELECT nom, prenom FROM users WHERE ville LIKE '%$keywords%' and id != $_SESSION[id]") or die("erreur");
        $num = mysqli_num_rows($res);
        $resultat = $id->query("SELECT * FROM users WHERE ville LIKE '%$keywords%' and id != $_SESSION[id]");
        $cpt = 0;
       
        while ($ligne = $resultat->fetch_assoc()) { // parcours le tableau en allant à la prochaine ligne, renvoie null si plus de ligne
            $lien_profil =  "<a href='profil.php?id={$ligne['id']}' >{$ligne['prenom']} {$ligne['nom']} {$ligne['age']} ans </a>"; 
            $tab[$cpt] =  $lien_profil ;
            $cpt++;
        }

        $afficher = "oui";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../photos/Logo.ico">
    <link rel="stylesheet" href="../css/recherche.css">
    <title>Rechercher</title>
</head>

<body>
    <img src="../photos/fond3.png" class="background" /> <!-- fond d'écran -->

    <div id="logo-2">     <!-- logo segondaire -->
        <a type="Logo-2-part-1" href="deconnexion.php" title="Accueil">A</a>
        <a type="Logo-2-part-2" href="deconnexion.php" title="Accueil">broad</a>
    </div>

    <div id="informations">
        <a type="liens" href="profil_perso.php" title="MY Match">My Profil</a>
        <a type="liens" href="demande.php" title="MY Match">My Match</a>
        <a type="liens" href="parametre.php" title="MY Match">Settings</a>
    </div>

    <form class="recherche " name="fo" method="GET" action="">
        <input type="text" name="keywords" value="<?php echo $keywords ?>" placeholder="Chose a city "/><br>
        <input type="submit" name="valider" value="search" />
    </form>

    <?php if (@$afficher == "oui") { ?>
        <div id="resultats">
            <div id="nbr"> <?= $num . " " . ($num > 1 ? "résultats trouvés" : "résultat trouvé") ?></div>
            <ol>
                <?php for ($i = 0; $i < $cpt; $i++) { ?>
                    <li><?php echo $tab[$i] ?></li>

                <?php } ?>
            </ol>
        </div>

    <?php
    }
    ?>
</body>

</html>