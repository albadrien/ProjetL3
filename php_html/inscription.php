<!DOCTYPE html>
<html lang="en">
<!--?php include 'includes/head.php'; ?--> 
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../photos/Logo.ico">
        <link rel="stylesheet" href="../css/inscription.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <title> Inscription </title>
    </head>
    <body>

        <img src="../photos/Fond.png" class="background" /> <!-- fond d'écran -->

        <div id="Description">    <!-- texte de fond -->
            <h1>It's a pleasur for us <br> to finaly meet <br>you !</h1>
        </div>
        

        <?php 

            if (isset($_GET['reg_err']))
            {
                $err = htmlspecialchars($_GET['reg_err']);

                switch($err){
                
                    case 'password':
                        ?>
                        <div class='alert alert-danger'>
                            <strong>Erreur</strong> mot de passe différent
                        </div>
                    <?php
                    break;

                    case 'email':
                        ?>
                        <div class='alert alert-danger'>
                            <strong>Erreur</strong> email non valide
                        </div>
                        <?php
                    break;

                    case 'email_lenght':
                        ?>
                        <div class='alert alert-danger'>
                            <strong>Erreur</strong> email trop long
                        </div>
                        <?php
                    break;

                    case 'nom_lenght':
                        ?>
                        <div class='alert alert-danger'>
                            <strong>Erreur</strong> nom trop long
                        </div>
                    <?php
                    break;

                    case 'already':
                        ?>
                        <div class='alert alert-danger'>
                            <strong>Erreur</strong> compte déjà existant
                        </div>
                        <?php
                    break;
                }
            }
        
            ?>
        <fieldset>
            <form method="post" action="inscription_traitement.php">
                
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" required/>

                    <br />
                    <label for="prenom"> Prénom : </label>
                    <input type="text" name="prenom" id="prenom"required/>

                    <br />
                    <label for="age"> Age :</label>
                    <input type="number" name="age" id="age" min="18" max="115" required />

                    <br />
                    <label for="pays"> Pays :</label>
                    <input type="text" name="pays" id="pays" required/>

                    <br />
                    <label for="ville"> Ville :</label>
                    <input type="text" name="ville" id="ville" required/>

                    <br />
                    <label for="mail">E-mail :</label>
                    <input type="email" name="mail" id="mail" required/>
                    
                    <br />
                    <label for="psw">Mot de passe :</label>
                    <input type="password" name="psw" id="psw" required/>

                    <br />
                    <label for="psw2">Confirmer le mot de passe :</label>
                    <input type="password" name="psw2" id="psw2" required/>

                    <br/>
                    <br/>
                    <input type="submit" value="Envoyer" name="validate" />
             
             
             
                </form>
        </fieldset>
    </body>
</html>