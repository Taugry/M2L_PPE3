<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>FAQ</title>
</head>
<body>
    <?php include 'top.php'; ?>
    <?php include 'menu.php'; ?>
    <table id="question"> 
        <?php 
        if (isset($_SESSION['session_username'])) {
            include 'list.php';
        } else {
            echo '<p>Vous devez être connecté</p>';
        }
        ?>
    </table>
</body>
</html>
