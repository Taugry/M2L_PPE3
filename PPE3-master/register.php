<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Inscription</title>
  
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
<!-- Menu de navigation-->
<?php include('menu.php'); ?>
<!-- Menu de navigation FIN -->
<div class ="boite">   
<!--Formulaire d'inscription-->
<h1>Inscription</h1>
<p><em>Veuillez fournir vos coordonnées</em></p>

    <form method="post"> <!-- Envoie des info en method post-->
    <p><br /><input type="text" name="pseudo" placeholder="Votre pseudo" required/></p> 

    <p><br /><input type="password" name="mdp" placeholder="Votre mot de passe" required/></p>

    <p><br /><input type="email" name="mail" placeholder="Votre mail" required/></p>
    
    <input type="submit" name="enregistrement" id="enregistrer" ></input>

    <?php
         
         $dbh = new PDO('mysql:host=localhost;dbname=fredi', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        if(isset($_POST['enregistrement'])){
            $pseudo = $_POST['pseudo'];
            $mdp = $_POST['mdp'];
            $mail = $_POST['mail'];
            $hashed_password = password_hash($_POST["mdp"],PASSWORD_DEFAULT);          

// $_POST["mdp"] ---> Is The User`s Input
// $hashed_password ---> Is The Hashed Password You Have Fetched From DataBase


            $sql = "insert into utilisateur(nom_util, password_util, email_util, prenom_util, statut_util, matricule_cont, id_type_util) ";  
            $sql .= "values (:pseudo, :mdp, :mail, user, u, 1, 1)"; 
            try { 
                    $sth = $dbh->prepare($sql); 
                    $sth->execute(array( 
                    ':pseudo' => $pseudo, 
                    ':mdp' => $hashed_password, 
                    ':mail' => $mail,
                    
                    )); 
                    } catch (PDOException $ex) { 
                    die("Erreur lors de la requête SQL : ".$ex->getMessage()); 
                    } 

                    echo "<p>".$sth->rowcount()." enregistrement ajouté</p>"; 

            
        }
    
    
    ?>
    </form>
    <!-- Champs d'inscription' FIN -->




</div>
</body>
</html>

<?php /*


echo password_hash('a<*HDycZz2gBws}*', PASSWORD_DEFAULT);

$hash = '$2y$10$aBTIxtSzVPvW42TfnQDequhYIiOmT.LDWcnIH/kGWG8BZEX3nQFm2';

if (password_verify('a<*HDycZz2gBws}*', $hash)) {
    echo ' Password is valid!';
} else {
    echo ' Invalid password.';
}

/*

PHP pour quand on aura lié la database 
--------------------------------------------------------
--- When A User Wants To Sign Up ---
1 ---> Get Input From User Which Is The User`s Password
1 ---> Hash The Password
2 ---> Store The Hashed Password In Your DataBase

<?php

$hashed_password = password_hash($_POST["password"],PASSWORD_DEFAULT);


    if(password_verify($_POST["password"],$hashed_password))
    echo "Welcome";

    else
    echo "Wrong Password";

// $_POST["password"] ---> Is The User`s Input
// $hashed_password ---> Is The Hashed Password You Have Fetched From DataBase
?>
*/


?>