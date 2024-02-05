<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editique</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/compte.css">
</head>
<body>
<?php include 'top.php';?>
<?php include 'menu.php'; ?>

</div>
<?php include 'menu.php';
  $userDAO=new UserDAO;
  $usersPerAct = $userDAO->findUsersAvecLdfActive(); // renvoie les utilisateurs qui ont au moins une ligne de frais sur la periode active
?>
<h2> Liste des utilisateurs avec des lignes de frais sur la période active </h2>
<table><tr><th>Mail</th><th>Nom complet</th><th colspan='2'>Actions</th></tr>

<?php
  foreach ($usersPerAct as $user) {    
    echo "<tr><td>".$user['email_util']."</td>";
    echo "<td>".$user['nom_util']." ".$user['prenom_util']."</td>";
    echo "<td><a href=cerfaPDF.php?id=".$user['email_util'].">CERFA</a></td>";
    echo "<td><a href=noteDeFraisPDF.php?id=".$user['email_util'].">Note de Frais</a></td></tr>";
  }
?>
</table>

<?php 
  $ligueDAO = new LigueDAO;
  $liguesAct = $ligueDAO->getLigueActive();
?>

<h2> Liste des ligues avec des lignes de frais</h2>
<table><tr><th>Ligue</th><th>Période</th><th>Actions</th></tr>
<?php
  foreach ($liguesAct as $ligueAct){
    $periodes = $ligueDAO->getPeriodesByLigue($ligueAct['id_ligue']);
    foreach ($periodes as $periode) {
        echo '<tr><td>'.$ligueAct['lib_ligue'].'</td>';
        echo '<td>'.$periode['annee_per'].'</td>';
        echo "<td><a href=cumulfraisPDF.php?id=".$ligueAct['id_ligue']."&per=".$periode['annee_per'].">Note de Frais</a></td></tr>";

    }

  }
?>

</body>
</html>