<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css\main.css">
    <title>Accueil</title>
</head>
<body>
    <?php include 'top.php';?>
    <?php include 'menu.php';?>
    <br>
    <?php
    
    if (!isset($_SESSION['session_username'])) {
    ?>     
    <p>Bienvenue dans la FAQ de la ligue de football</p>
    <p>Pour continuer, vous devez vous connecter ou vous inscrire</p>
    <?php
    } else {
        if ($_SESSION['session_libligue'] == 'Toutes les ligues') {
            echo '<p>Bienvenue ' . $_SESSION['session_username'] . ', vous êtes dans '. $_SESSION['session_libligue'].'</p>';
        } else {
            echo '<p>Bienvenue ' . $_SESSION['session_username'] . ', vous êtes dans la ligue '. $_SESSION['session_libligue'].'</p>';
        }
        
    }
    ?>

</body>
</html>
