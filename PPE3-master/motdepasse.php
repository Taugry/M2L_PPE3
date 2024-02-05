<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css\style.css">
    <title>Login</title>
</head>
<body>
    <?php include 'top.php';?>
    <?php include 'menu.php'; ?> 
    <h2>Mot de Passe oublié</h2><br>

    <div class="login">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>", method="post" >
            Adresse mail :<br>
            <input type="email" name="mail" <?php if(isset($_POST['submit'])) { if (isset($_POST['mail'])) { echo ' value='.$_POST['mail']; } } ?> required><br><br>

            <input type="submit" name="submit" value="Envoyer"><br><br><br>
        </form>
        </div>

    <?php
    if(isset($_POST['submit'])) {
        if (isset($_POST['mail'])) {
            $mail = $_POST['mail'];
            try {
                $dbh = new PDO('mysql:host=localhost;dbname=fredi', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $sql = "select password_util,email_util  from utilisateur where email_util = '".$mail."'";
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sth = $dbh->prepare($sql);
                $sth->execute(array());
                $row = $sth->fetch(PDO::FETCH_ASSOC);
                if ($mail == $row['email_util']) {
                        echo '<p>Votre mot de passe vient de vous être renvoyé à l’adresse mail suivante : '.$mail.'</p>';
                        exit();
                } else {
                        echo '<p>Votre identifiant est inconnu</p>';
                    }
                }
            catch (PDOException $ex) {
                die("Erreur lors de la connexion SQL : " . $ex->getMessage());
            }
        }
    } ?>


</body>
</html>
