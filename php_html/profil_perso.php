<?php
    session_start();
    require_once 'database.php';

    $id = (int) trim($_GET['id']);

    @$user_ajouter = $_GET["user_ajouter"];


    
    
    
    if (isset($user_ajouter)) {
        // recupération de l'ID de connexion à la table 
        $id = @mysqli_connect("localhost", "root", "root", "inscription") or die("Erreur de connexion 2");
        $id->set_charset("utf8");
        
    
        $res = mysqli_query($id, "SELECT * FROM relation, users WHERE id_receveur=  $_SESSION[id] and id_demandeur=users.id ") or die("erreur");
        $num = mysqli_num_rows($res);
        $resultat = $id->query("SELECT * FROM relation, users WHERE id_receveur=  $_SESSION[id] and id_demandeur=users.id");
    
        while ($ligne = $resultat->fetch_assoc()) {
            echo "eeee".$ligne['users.id'];
        }

        if($num==1){
           
            $sql ="UPDATE relation SET statut='2' WHERE relation.id=users.id";
            mysqli_query($id,$sql) or die("Erreur de modification" );
        }
        else{
            echo "erreur";
            
        }
       

   
    
    header('Location:recherche.php');

    } 


     // liste de events : 

        $id = @mysqli_connect("localhost", "root", "root", "inscription") or die("Erreur de connexion 2");
        $id->set_charset("utf8");
        $res = mysqli_query($id, "SELECT * FROM events WHERE ID_client=  $_SESSION[id] ") or die("erreur");
        $num = mysqli_num_rows($res);
        $resultat = $id->query("SELECT * FROM events WHERE ID_client=  $_SESSION[id] ");
        $cpt = 0;
        
       
    
        
        while ($ligne = $resultat->fetch_assoc()) { // parcours le tableau en allant à la prochaine ligne, renvoie null si plus de ligne
            $tab[$cpt] = 'titre : ' . $ligne['Description'] ."<br>". 'Adresse : ' . $ligne['Adresse'] . "<br>". 'Type : ' . $ligne['Type'] . "<br>".  'Date : '. $ligne['Date'];
            $cpt++;
        }

        $afficher = "oui";

       

        // liste de centres d'interets : 

        $id2 = @mysqli_connect("localhost", "root", "root", "inscription") or die("Erreur de connexion 2");
        $id2->set_charset("utf8");
        $res2 = mysqli_query($id2, "SELECT * FROM centre_interet WHERE  id_users = $_SESSION[id]   ") or die("erreur");
        $num2 = mysqli_num_rows($res2);
        $resultat2 = $id2->query("SELECT * FROM centre_interet WHERE  id_users = $_SESSION[id] ");
        $cpt2 = 0;
        

        
        while ($ligne2 = $resultat2->fetch_assoc()) { // parcours le tableau en allant à la prochaine ligne, renvoie null si plus de ligne
            $tab2[$cpt2]="";
            if($ligne2['sport']== "on"){
                $tab2[$cpt2]= "sport" . "<br>";
                $cpt2++;
            }
            if($ligne2['musique']== "on"){
                $tab2[$cpt2]= "musique" . "<br>";
                $cpt2++;
            }
            if($ligne2['photo']== "on"){
                $tab2[$cpt2]= "photo" . "<br>";
                $cpt2++;
            }
            if($ligne2['musee']== "on"){
                $tab2[$cpt2]= "musee" . "<br>";
                $cpt2++;
            }
            if($ligne2['sortir']== "on"){
                $tab2[$cpt2]= "sortir" . "<br>";
                $cpt2++;
            }
            if($ligne2['jeux_societe']== "on"){
                $tab2[$cpt2]= "jeux_societe" . "<br>";
                $cpt2++;
            }
            if($ligne2['dessin']== "on"){
                $tab2[$cpt2]= "dessin" . "<br>";
                $cpt2++;
            }
            if($ligne2['cuisine']== "on"){
                $tab2[$cpt2]= "cuisine" . "<br>";
                $cpt2++;
            }
            if($ligne2['danse']== "on"){
                $tab2[$cpt2]= "danse" . "<br>";
                $cpt2++;
            }
            if($ligne2['jeux_video']== "on"){
                $tab2[$cpt2]= "jeux_video" . "<br>";
                $cpt2++;
            }
            
            
        }

        $afficher2= "oui";


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width", initial-scale="1.0">
    <link rel="stylesheet" href="../css/profil.css">
    <script src="../js/main.js"></script>
    <title> Mon Profil </title>
</head>
<body>
<header>
    <a href = "recherche.php"><button> Find Friends </button> </a>
    
</header>



<div class="container">
    <div class="profile-header">
        <div class="profile-img">
            <img src= "<?php echo  $_SESSION['prenom'];?>.jpg" alt="photo profil">
            
        </div>
        <div class="profile-nav-info">
            <h3 class="user-name">
                <?php echo  $_SESSION['prenom']; ?>      
                <?php echo  $_SESSION['nom']; ?> 
            </h3>
            
            <div class="adresse">
                <p class ="state"> <?php echo  $_SESSION['ville']; ?> ,  <?php echo  $_SESSION['pays']; ?> </p>
            </div>
        </div>
        <div class="profile-option">
            <div class="notification">
                <a href="parametre.php"><span class="alert-message"> ⚙️ </span> </a>
            </div>
        </div>
        <h2 id="age"><?php echo  $_SESSION['age']. " ans"; ?></h2>

    </div>
    <div class="main-bd">
        <div class="left-side">
            <div class="profile-side">
            
                <div class="user-bio">
                    <h3>Bio</h3>
                    <p class="bio">  <?php echo  $_SESSION['biographie']; ?>  </p>

                    <a href="demande.php"><button>Voir mes amis</button></a>
                </div>
                
                
            </div>
        </div>
        <div class="right-side">
            <div class="nav"> 
                <ul>
                    <li class=" catégorie active" id="catégorie0" onclick="tabs('0')"> Evenements </li>

                    <li class=" catégorie" id="catégorie2" onclick="tabs('1')"> Centres d'interets </li>
                    
                   
                </ul>
            </div>
            <div class="profile-body">
                <div class="profile tab" id="0" style="display: block;">
                    <h1>Mes evenements   </h1>
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

                    <a href="evenement.php"><button>Modifier mes évènements</button></a>       
                </div>
                
                 
                <div class="profile tab" id="1" style="display: none;">
                    <h1>Mes centres d'interets </h1>
                   
                    <?php if (@$afficher2 == "oui") { ?>
                        
                        <div id="resultats">
                        <div id="nbr"> <?= $cpt2 . " " . ($cpt2 > 1 ? "résultats trouvés " : "résultat trouvé") ?></div>
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
                    
                    <a href="centre_interet.php"><button>Modifier mes centres d'interets</button></a>

                </div>              
            </div>
        </div>
    </div>
</div>
</body>
</html>