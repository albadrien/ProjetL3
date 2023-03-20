<?php
    session_start();
    require_once 'database.php';
   
    $req = $bdd->prepare ("SELECT r.id_relation, u.prenom, u.id id_utilisateur
    FROM relation r 
    INNER JOIN users u 
    ON u.id = r.id_demandeur 
    WHERE r.id_receveur = ? AND r.statut = ?");

    //echo $_SESSION['id'];
    $req ->execute(array($_SESSION['id'],1));
    

    $afficher_demande = $req ->fetchAll();
    //var_dump($afficher_demande);
    

    if(!empty($_POST)){
        extract($_POST);
        $valid =(boolean) true;
        // Si accepté
        if(isset($_POST['accepter'])){
            //echo $id_relation;
            $id_relation = (int) $id_relation;
            //echo $id_relation;
            if($id_relation >0){
                echo "lalalla";
                $req =$bdd->prepare("SELECT id_relation 
                FROM relation 
                WHERE id_relation = ? AND statut = 1");
                $req->execute(array($id_relation));
                $verif_relation = $req->fetch();
                //echo "2e step";
                //echo $verif_relation['id_relation'];

                if(!isset($verif_relation['id_relation'])){
                    $valid=false;
                }
                if ($valid){
                    //echo "lalalallalalalalal";
                    $req =$bdd->prepare("UPDATE relation SET statut = 2 WHERE id_relation = ? AND id_receveur= ? ");
                    $req->execute(array($id_relation, $_SESSION['id']));
                    echo "l'id relation : ";
                    echo $id_relation;
                }
            }
            header('Location:demande.php');
            exit;

        }elseif(isset($_POST['refuser'])){

            $id_relation = (int) $id_relation;
            //echo $id_relation;
            if ($id_relation > 0 ){
                $req = $bdd->prepare("DELETE FROM relation WHERE id_relation = ? AND id_receveur = ?");
                $req->execute(array($id_relation,$_SESSION['id']));
            }

            header('Location:demande.php');
            exit;
        }
    }
    $req_p = $bdd->prepare ("SELECT r.id_receveur, r.id_demandeur, u.id
    FROM relation r 
    INNER JOIN users u 
    ON (id = id_demandeur OR id = id_receveur)
    WHERE ((id_receveur = ? OR id_demandeur = ?) AND statut = 2)");
    // OR id = id_receveur)
    //echo $_SESSION['id'];
    $req_p ->execute(array($_SESSION['id'],$_SESSION['id']));
    //echo $req['id_receveur'];
    $afficher_demande_p = $req_p->fetchAll();
    
    //echo $_SESSION['id'];
    //var_dump($afficher_demande_p);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width", initial-scale="1.0">
    <link rel="icon" href="../photos/Logo.ico">
    <link rel="stylesheet" href="../css/demande.css">
    <script src="../js/main.js"></script>
    <title>Mes Amis</title>
</head>
<body>
<img src="../photos/Fond.png" class="background" />
<header>
    <a href = "profil_perso.php"> <button> Mon compte </button> </a>
</header>

<div class="container">
    <div class="profile-header">
        <?php 
        foreach($afficher_demande as $ad){
        ?>
        <div class = "col-sm-3"> </div>
            <div class="membre-corps"> </div>
                <div>
                    <?= $ad['prenom'] ?>
                </div>
                <div class="membre-btn">
                    <a href="profil.php?id=<?= $ad['id_utilisateur'] ?>" class = membre-btn-voir> Voir profil </a>
                </div>
                <div>
                    <form method="post">
                        <input type ="hidden" name="id_relation" value =" <?= $ad['id_relation']?> "/>
                        <input type ="submit" name ="accepter" value="Accepter"/>
                        <input type ="submit" name ="refuser" value="Refuser"/>
                    </form>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
    <div class ="profile-amie">
        <?php echo "Mes Amis :";
        foreach($afficher_demande_p as $adp){
            // Si id du demandeur on affiche l'id du receveur
            if ( $_SESSION['id'] == $adp['id_demandeur'] &&  $_SESSION['id'] == $adp['id'] ){
                
                $id_perso_pp = $adp['id_receveur'];
                
                // select pour prenom etc..
                $req =$bdd->prepare("SELECT nom, prenom, age, ville, pays 
                FROM users
                WHERE id = ? ");
                $req->execute(array($id_perso_pp));
                $requete = $req->fetch();

                ?>
                <div class="membre-btn">
                    <?php 
                        echo $requete['nom'];
                        echo "    ";
                        echo $requete['prenom'];
                        echo "    ";
                        echo $requete['ville'];

                    ?>
                    <!--id_utilisateur à changer-->
                    <a href="profil.php?id=<?= $id_perso_pp ?>" class = membre-btn-voir> Voir profil </a>
                </div>
                <?php
            }elseif($_SESSION['id'] == $adp['id_receveur'] && $_SESSION['id'] == $adp['id'] ) {
                $id_perso_pp = $adp['id_demandeur'];
                
                // select pour prenom etc..
                $req =$bdd->prepare("SELECT nom, prenom, age, ville, pays 
                FROM users
                WHERE id = ? ");
                $req->execute(array($id_perso_pp));
                $requete = $req->fetch();

                ?>
                <div class="membre-btn">
                    <?php 
                        echo $requete['nom'];
                        echo "    ";
                        echo $requete['prenom'];
                        echo "    ";
                        echo $requete['ville'];

                    ?>
                    <!--id_utilisateur à changer-->
                    <a href="profil.php?id=<?= $id_perso_pp ?>" class = membre-btn-voir> Voir profil </a>
                </div>
                <?php

            }
        ?>
        <?php
        }
        ?>
    </div>
</div>
</body>
</html>