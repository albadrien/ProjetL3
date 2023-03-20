<?php
    session_start();
    require_once 'database.php';

    $id = (int) trim($_GET['id']);
    //$voir_user = (int) trim($_GET['id']);
    //echo $id;

    //selection individu avcec ID
    
    $requete = "SELECT * FROM users WHERE id=$id";
    
    $req =$bdd->query($requete);
// code modifié par moi
    //$req // vient du tuto
    $req_ = $bdd->prepare("SELECT * FROM users WHERE id=?");
    $req_->execute(array($id));
    $voir_user =$req_->fetch();

    // pas besoin je pense
    $req_bouton = $bdd->prepare ("SELECT u.*, r.id_demandeur, r.id_receveur, r.statut, r.id_bloqueur FROM users u 
    LEFT JOIN relation r ON ((id_receveur = u.id AND id_demandeur= :id1) OR (id_receveur = :id1 AND id_demandeur = u.id)) WHERE u.id = :id2");
    $req_bouton->execute(array('id2'=> $voir_user['id'], 'id1'=> $_SESSION['id']));

    $voir_utilisateur = $req_bouton->fetch();
    //echo 'lululu';
    $result = $req->fetch(PDO::FETCH_OBJ);
    
    if(!empty($_POST)){
        extract($_POST);
        $valid =(boolean) true;
        if (isset($_POST['user-ajouter'])){
            $req_ =$bdd->prepare("SELECT id FROM relation WHERE (id_receveur = ? AND id_demandeur= ?) OR (id_receveur = ? AND id_demandeur = ?)");
            //voir si c'est bien result
            $req_->execute(array($voir_user['id'], $_SESSION['id'], $_SESSION['id'], $voir_user['id']));

            $verif_relation = $req_->fetch();

            if(isset($verif_relation['id'])){
                $valid =false;
            }

            if ($valid){
                $req_ = $bdd->prepare("INSERT INTO relation (id_demandeur, id_receveur, statut) VALUES( ?, ?, ?)");
                $req_ ->execute(array($_SESSION['id'], $voir_utilisateur['id'],1));
            }
            header('Location: profil.php?id='.$voir_utilisateur['id']);
            exit;

        }elseif(isset($_POST['user-supprimer'])){
            $req_ = $bdd->prepare("DELETE FROM relation WHERE (id_receveur = ? AND id_demandeur= ?) OR (id_receveur = ? AND id_demandeur = ?)");
            $req_->execute(array($voir_utilisateur['id'], $_SESSION['id'], $_SESSION['id'], $voir_utilisateur['id']));

            header('Location: profil.php?id='.$voir_utilisateur['id']);
            exit;
        }elseif(isset($_POST['user-bloquer'])){

            $req_ = $bdd->prepare("DELETE FROM relation WHERE (id_receveur = ? AND id_demandeur= ?) OR (id_receveur = ? AND id_demandeur = ?)");
            $req_->execute(array($voir_utilisateur['id'], $_SESSION['id'], $_SESSION['id'], $voir_utilisateur['id']));

            $req_ = $bdd->prepare("INSERT INTO relation (id_demandeur, id_receveur, statut, id_bloqueur) VALUES( ?, ?, ?, ?)");
            $req_ ->execute(array($_SESSION['id'], $voir_utilisateur['id'],3,$voir_utilisateur['id']));

            header('Location: profil.php?id='.$voir_utilisateur['id']);
            exit;
        }elseif(isset($_POST['user-debloquer'])){
            $req_ = $bdd->prepare("DELETE FROM relation WHERE (id_receveur = ? AND id_demandeur= ?) OR (id_receveur = ? AND id_demandeur = ?)");
            $req_->execute(array($voir_utilisateur['id'], $_SESSION['id'], $_SESSION['id'], $voir_utilisateur['id']));

            header('Location: profil.php?id='.$voir_utilisateur['id']);
            exit;
        }
    }

   
    $id = @mysqli_connect("localhost", "root", "root", "inscription") or die("Erreur de connection 2");
        $id->set_charset("utf8");
        $res = mysqli_query($id, "SELECT * FROM events WHERE ID_client= $result->id ") or die("erreur");
        $num = mysqli_num_rows($res);
        $resultat = $id->query("SELECT * FROM events WHERE ID_client= $result->id");
        $cpt = 0;
        
       
    
        
        while ($ligne = $resultat->fetch_assoc()) { // parcours le tableau en allant à la prochaine ligne, renvoie null si plus de ligne
            $tab[$cpt] = 'titre : ' . $ligne['Description'] ."<br>". 'Adresse : ' . $ligne['Adresse'] . "<br>". 'Type : ' . $ligne['Type'] . "<br>".  'Date'. $ligne['Date'];
            $cpt++;
        }

        $afficher = "oui";

       

        // liste de amis : 

        $id2 = @mysqli_connect("localhost", "root", "root", "inscription") or die("Erreur de connection 2");
        $id2->set_charset("utf8");
        $res2 = mysqli_query($id2, "SELECT * FROM relation , users WHERE  id_demandeur = users.id  and statut=2 and id_receveur= $result->id or id_demandeur =$result->id   and statut=2 and id_receveur= users.id ") or die("erreur");
        $num2 = mysqli_num_rows($res2);
        $resultat2 = $id2->query("SELECT * FROM relation , users WHERE  id_demandeur = users.id  and statut=2 and id_receveur= $result->id or id_demandeur =$result->id   and statut=2 and id_receveur= users.id ");
        $cpt2 = 0;
        

        
        while ($ligne2 = $resultat2->fetch_assoc()) { // parcours le tableau en allant à la prochaine ligne, renvoie null si plus de ligne
            $tab2[$cpt2] = "<a href='profil.php?id={$ligne2['id']}' >{$ligne2['prenom']} {$ligne2['nom']} </a>";
            $cpt2++;
        }

        $afficher2 = "oui";


        // liste de centres d'interets : 

        $id3 = @mysqli_connect("localhost", "root", "root", "inscription") or die("Erreur de connexion 2");
        $id3->set_charset("utf8");
        $res3 = mysqli_query($id3, "SELECT * FROM centre_interet WHERE  id_users = $result->id   ") or die("erreur");
        $num3 = mysqli_num_rows($res3);
        $resultat3 = $id3->query("SELECT * FROM centre_interet WHERE  id_users = $result->id ");
        $cpt3 = 0;
        

        
        while ($ligne3 = $resultat3->fetch_assoc()) { // parcours le tableau en allant à la prochaine ligne, renvoie null si plus de ligne
            $tab3[$cpt3]="";
            if($ligne3['sport']== "on"){
                $tab3[$cpt3]= "sport" . "<br>";
                $cpt3++;
            }
            if($ligne3['musique']== "on"){
                $tab3[$cpt3]= "musique" . "<br>";
                $cpt3++;
            }
            if($ligne3['photo']== "on"){
                $tab3[$cpt3]= "photo" . "<br>";
                $cpt3++;
            }
            if($ligne3['musee']== "on"){
                $tab3[$cpt3]= "musee" . "<br>";
                $cpt3++;
            }
            if($ligne3['sortir']== "on"){
                $tab3[$cpt3]= "sortir" . "<br>";
                $cpt3++;
            }
            if($ligne3['jeux_societe']== "on"){
                $tab3[$cpt3]= "jeux_societe" . "<br>";
                $cpt3++;
            }
            if($ligne3['dessin']== "on"){
                $tab3[$cpt3]= "dessin" . "<br>";
                $cpt3++;
            }
            if($ligne3['cuisine']== "on"){
                $tab3[$cpt3]= "cuisine" . "<br>";
                $cpt3++;
            }
            if($ligne3['danse']== "on"){
                $tab3[$cpt3]= "danse" . "<br>";
                $cpt3++;
            }
            if($ligne3['jeux_video']== "on"){
                $tab3[$cpt3]= "jeux_video" . "<br>";
                $cpt3++;
            }
            
            
        }

        $afficher3 = "oui";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width", initial-scale="1.0">
    <link rel="stylesheet" href="../css/profil.css">
    <script src="../js/main.js"></script>
    <title>Page Profil</title>
</head>

<header>
<a href = "profil_perso.php"><button> My account </button> </a>
</header>

<body>
<img src="../photos/Fond.png" class="background" /> <!-- fond d'écran -->
<div class="container">
    <div class="profile-header">
        <div class="profile-img">
            <img src= "<?php echo $result->prenom;?>.jpg" alt="photo profil">
            <!-- <img src="../photos/pdp.jpeg" width="200" alt="photo profil"> -->
        </div>
        <div class="profile-nav-info">
            <h3 class="user-name">
                <?php echo $result->prenom; ?>      
                <?php echo $result->nom; ?> 
            </h3>
            
            <div class="adresse">
                <p class ="state"> <?php echo $result->ville; ?> ,  <?php echo $result->pays; ?> </p>
            </div>
        </div>
        <h2 id="age"><?php echo  $result->age. " ans"; ?></h2>
    </div>
    <div class="main-bd">
        <div class="left-side">
            <div class="profile-side">
            
                <div class="user-bio">
                    <h3>Bio</h3>
                    <p class="bio">  <?php echo $result->biographie; ?>  </p>
                </div>
                <!--Vérification d'une session-->
                <?php
                    if(isset($_SESSION['id'])){
                ?>
                <div class="profile-btn">
                    <form method="post">
                        <?php
                            if(!isset($voir_utilisateur['statut'])){
                        ?>
                        <input class="createbtn" type ="submit" name ="user-ajouter" value= "➕ Devenir amis">
                        <?php
                            }elseif(isset($voir_utilisateur['statut']) && $voir_utilisateur['id_demandeur'] == $_SESSION['id'] && $voir_utilisateur['statut']<2) {
                        ?>
                        <div>Demande en attente </div>
                        <?php
                            }elseif(isset($voir_utilisateur['statut']) && $voir_utilisateur['id_receveur']== $_SESSION['id'] && $voir_utilisateur['statut']<2 ){
                        ?>
                        <div>Vous avez une demande à accepter</div>
                        <?php
                            }elseif( isset($voir_utilisateur['statut']) && $voir_utilisateur['statut'] ==2 ){
                        ?>
                        <div>Vous êtes amis</div>
                        <?php 
                            }
                            if(isset($voir_utilisateur['statut']) &&  $voir_utilisateur['statut']<3 && ($voir_utilisateur['id_demandeur'] == $_SESSION['id'] || $voir_utilisateur['id_receveur'] == $_SESSION['id'])){
                        ?>
                        <input type ="submit" name ="user-supprimer" value= "Supprimer ">
                        <?php
                            }
                            if((isset($voir_utilisateur['statut']) || $voir_utilisateur['statut'] == NULL) && $voir_utilisateur['statut'] < 3){
                        ?>
                        <input type ="submit" name ="user-bloquer" value= "Bloquer">
                        <?php
                            }elseif($voir_utilisateur['id_bloqueur'] <> $_SESSION['id']){
                        ?>
                        <input type ="submit" name ="user-debloquer" value= "Débloquer">
                        <?php
                            }else{
                        ?>
                        <div>Vous avez été bloqué par l'utilisateur</div>
                        <?php
                            }
                        ?>
                    </form>
                </div>
                <?php
                }
                ?>
                
            </div>
        </div>
        <div class="right-side">
            <div class="nav"> 
                <ul>
                    <li class=" catégorie active" id="catégorie0" onclick="tabs('0')"> Evenements </li>
                    <li class=" catégorie" id="catégorie1" onclick="tabs('1')"> Amis </li>
                    <li class=" catégorie" id="catégorie2" onclick="tabs('2')"> Centres d'interets </li>
                    
                   
                </ul>
            </div>
            <div class="profile-body">
                <div class="profile tab" id="0" style="display: block;">
                    <h1>Les evenements de <?php echo $result->prenom; ?> </h1>
                    <?php if (@$afficher == "oui") { ?>
                        <div id="resultats">
                        <div id="nbr"> <?= $num . " " . ($num > 1 ? "résultats trouvés" : "résultat trouvé") ?></div>
                        <ol>
                        <?php for ($i = 0; $i < $cpt; $i++) { ?>
                        <li><?php 
                        
                            echo $tab[$i] ?></li> 

                                <?php } ?>
                            </ol>
                        </div>

                    <?php
                    }
                    ?> 
                </div>
                <div class="profile tab" id="1" style="display: none;">
                    <h1>Les amis de <?php echo $result->prenom; ?> </h1>

                    <?php if (@$afficher2 == "oui") { ?>
                        <div id="resultats">
                        <div id="nbr"> <?= $num2 . " " . ($num2 > 1 ? "résultats trouvés " : "résultat trouvé") ?></div>
                        <ol>
                        <?php for ($i = 0; $i < $cpt2; $i++) { ?>
                        <li><?php 
                        
                            echo $tab2[$i] ?></li> 

                                <?php } ?>
                            </ol>
                        </div>

                    <?php
                    }
                    ?> 

                </div> 
                <div class="profile tab" id="2" style="display: none;">
                    <h1>Mes centres d'interets </h1>
                   
                    <?php if (@$afficher3 == "oui") { ?>
                        
                        <div id="resultats">
                        <div id="nbr"> <?= $cpt3 . " " . ($cpt3 > 1 ? "résultats trouvés " : "résultat trouvé") ?></div>
                        <ol>
                        <?php for ($i = 0; $i < $cpt3; $i++) { ?>
                        <li><?php 
                        
                            echo $tab3[$i] ?></li> 

                                <?php } ?>
                            </ol>
                        </div>

                    <?php
                    
                    }
                    ?>  

                </div>                 
            </div>
        </div>
    </div>
</div>
</body>
</html>