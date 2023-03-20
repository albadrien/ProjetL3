<!--page de connexion, la première
quand on clique sur connexion/ inscription-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../photos/Logo.ico">
        <link rel="stylesheet" href="../css/connexion.css"> 
        <title> Connexion </title>
    </head>
    <body>
    <body>

        <img src="../photos/Fond.png" class="background" /> <!-- fond d'écran -->

        <div id="Description">    <!-- texte de fond -->
            <h1>A new way to meet friends around the world…</h1>
        </div>

        <div id="logo-1">    <!-- Logo principal -->
            <a type="Logo-1-part-1" href="Singin.html" title="Singin">A</a>
            <a type="Logo-1-part-2" href="Singin.html" title="Singin">broad</a>
        </div>

    <?php 
            if (isset($_GET['login_err']))
            {
                $err = htmlspecialchars($_GET['login_err']);

                switch($err){
                    case 'password':
                        ?>
                        <div class='alert alert-danger'>
                            <strong>Erreur</strong> mot de passe incorrect
                    </div>
                    <?php
                    break;

                    case 'email':
                        ?>
                        <div class='alert alert-danger'>
                            <strong>Erreur</strong> email incorrect
                        </div>
                        <?php
                    break;

                    case 'already':
                        ?>
                        <div class='alert alert-danger'>
                            <strong>Erreur</strong> compte non existant
                        </div>
                    <?php
                    break;
                }
            }
            ?>
        <fieldset style="width:40%">
            <form method="post" action="connexion_traitement.php">
                <div id="singin">     <!-- Section connexion --> 
                    <div class="form-group">
                        <input type="email" attribut placeholder= "User Name : ###@abroad.com" name="mail" id="mail" required/> 
                    </div><br>
                    <div class="form-group">
                        <input type="password" attribut placeholder= "Password : ########" name="psw" id="psw" required/> 
                    </div><br>
                    <button type="submit"> Connexion</button>
                </div>
            </form>
            <div id="registration">   <!-- Section inscription -->
                <p ><a type="liens" href="inscription.php"> Inscription </a></p>
            </div>
            <div id="legal">    <!-- Section condition generales -->
                <a type="liens" href="legal-condition.html" title="legal">Legal condition </a>
            </div>
             
        </fieldset>
    </body>
</html>