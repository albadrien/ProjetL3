<?php
    session_start();
    require_once 'database.php';
    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['age']) &&
    isset($_POST['pays']) && isset($_POST['ville']) && isset($_POST['mail']) && isset($_POST['psw']) &&
    isset($_POST['psw2']))
    {
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=inscription;charset=utf8','root','root');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $age = htmlspecialchars($_POST['age']);
            $pays = htmlspecialchars($_POST['pays']);
            $ville = htmlspecialchars($_POST['ville']);
            $mail = htmlspecialchars($_POST['mail']);
            $psw = htmlspecialchars($_POST['psw']);
            $psw2 = htmlspecialchars($_POST['psw2']);
            $token = bin2hex(openssl_random_pseudo_bytes(64));

            $check = $bdd->prepare('SELECT id, nom, prenom, age, pays, ville, mail, psw FROM users WHERE mail = ?');
            $check->execute(array($mail));
            $data = $check->fetch();
            $row = $check->rowCount();
            //remplacer toutes les lettres maj et min
            $mail=strtolower($mail);

            /*Faire vérification du prénom, du pays de la ville, de l'age */
            if ($row == 0) {
                if(strlen($nom) <= 100)
                {
                    /* Vérification pour la sécurité mais vraiment pas obligatoire*/
                    if (strlen($mail) <= 100){
                        if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                        {
                            if($psw === $psw2){
                                                        
                                    //$psw = hash('sha256',$psw);
                                $ip = $_SERVER['REMOTE_ADDR'];
                                //insertion dans la bdd
                                $insert = $bdd->prepare('INSERT INTO users (nom, prenom, age, pays, ville, mail, psw, ip, token, biographie) VALUES(:nom, :prenom, :age, :pays, :ville, :mail, :psw, :ip, :token, :biographie)');
                                $insert->execute(array(
                                    ':nom' => $nom,
                                    ':prenom' => $prenom,
                                    ':age' => $age,
                                    ':pays' => $pays,
                                    ':ville'=> $ville,
                                    ':mail' => $mail,
                                    ':psw'=> $psw,
                                    ':ip' => $ip,
                                    ':token' => $token,
                                    ':biographie'=>$biographie,
                                ));

                                $check = $bdd->prepare('SELECT id, nom, prenom, age, pays, ville, mail, psw FROM users WHERE mail = ?');
                                $check->execute(array($mail));
                                $data = $check->fetch();

                                $_SESSION['users']= $data['token'];
                                //echo "inscription en cours";
                                $_SESSION['id'] = $data['id'];
                                $_SESSION['prenom'] = $data['prenom'];
                                $_SESSION['nom'] = $data['nom'];
                                $_SESSION['age'] = $data['age'];
                                $_SESSION['ville'] = $data['ville'];
                                $_SESSION['pays'] = $data['pays'];
                                                   
                                header('Location:centre_interet.php');die();
                            }else {header('Location:inscription.php?reg_err=password');die();}
                        }else {header('Location:inscription.php?reg_err=email');die();}
                    }else{ header('Location:inscription.php?reg_err=email_lenght');die();}
                }else {header('Location:inscription.php?reg_err=nom_lenght');die();}
            }else{ header('Location:inscription.php?reg_err=already');die();}
        }
        catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
        }

    }
   
?>
