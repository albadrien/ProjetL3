<?php
    session_start();
    require_once 'database.php'; //inclut à la base de donnée

    if(isset($_POST['mail']) && isset($_POST['psw']))
    {
        $mail = htmlspecialchars($_POST['mail']);
        $psw = htmlspecialchars($_POST['psw']);

        $mail=strtolower($mail);

        $check = $bdd->prepare('SELECT id, nom, prenom, age, pays, ville, mail, psw, biographie, ref_image FROM users WHERE mail = ?');
        $check->execute(array($mail));
        $data = $check->fetch(); // le $req
        $row=$check->rowCount();

        if($row == 1){
            if(filter_var($mail, FILTER_VALIDATE_EMAIL))
            {
            

                if($data['psw'] === $psw){
                    //Création de le session et on redirige sur la page recherche
                   

                    $_SESSION['users']= $data['token'];
                    $_SESSION['id'] = $data['id'];
                    $_SESSION['prenom'] = $data['prenom'];
                    $_SESSION['nom'] = $data['nom'];
                    $_SESSION['age'] = $data['age'];
                    $_SESSION['ville'] = $data['ville'];
                    $_SESSION['pays'] = $data['pays'];
                    $_SESSION['biographie'] = $data['biographie'];
                    // MODIF
                    header('Location:recherche.php');

                /*Créer la page connexion ou signup*/
                }else header('Location:connexion.php?login_err=password');
            }else header('Location:connexion.php?login_err=email');
        }else header('Location:connexion.php?login_err=already');
    }else header('Location:connexion.php');
