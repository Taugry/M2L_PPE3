<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Session</title>
</head>
<body>
<?php

if(!isset($_POST['username']) || !isset($_POST['password'])) {
    echo "<p>champ(s) vide</p>";
}
else {
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=m2l', 'root', '');
        $sql = "select * from users";
        $sth = $dbh->prepare($sql);
        $sth->execute(array());
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $utilisateurs) {
            if ($_POST['username'] == $utilisateurs['username']) {
                if ($_POST['password'] == $utilisateurs['password']) {
                    echo '<p>Connexion réussie !</p>';
                    session_start();
                    break;
                }
                else {
                    echo '<p>Mauvais mot de passe</p>';
                }
            }
            else {
                echo '<p>Cet utilisateur n\'existe pas</p>';
            }
        }
    } 
    catch (PDOException $ex) {
        die("Erreur lors de la connexion SQL : " . $ex->getMessage());
    }
}


?>

</body>
</html>
