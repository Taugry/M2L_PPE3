<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/compte.css">
</head>
<body>
<?php include 'top.php';?>
<?php include 'menu.php'; ?>
<?php require_once "init.php";?>

<br>
<div class="outer-div">
        <div class="inner-div">
<?php if(isset($_SESSION['session_username'])) {
  echo '<h2>'.$_SESSION['session_libtype'].'</h2>'; 
  }else {
    echo'<center><h3 style="color:red"> Il semblerai qu&apos;il y ai une erreur, veuillez r&eacute;essayer.</h3></center>';
  }?>
  
<br><br><br>

<hr color="black">
<nav>
  <ul>
    <li><a href="ajouter_periodes.php">Ajouter</a></li>
    <li><a href="modifier_periodes.php">Modifier</a></li>
    <li><a href="desactiver_periodes.php">Desactiver ou Activer</a></li>
    <li><a href="javascript:history.go(-1)">Retour</a></li>
  </ul>
</nav>
<hr color="black">  
<?php

  //pour filtrer par utilisateur
  if (isset($_POST['utilisateur'])){ // si $post[utilisateur] existe
    if ($_POST['utilisateur'] != '0') { // si ce n'est pas tous les utilisateurs
        $utilisateur = " AND pseudo='".$_POST['utilisateur']."'"; // complete la requete pour filtrer avec son nom
    }
    else {
      $utilisateur=""; // sinon requete inchangée
  }
  }
  else {
      $utilisateur=""; // sinon requete inchangée
  }

  $PeriodeDAO = new PeriodeDAO();
  $rows = $PeriodeDAO->findAll();

    // Affichage de la liste des colonnes
  echo "<br><br>";
  echo "<table>";  //liens qui envoie le mode de tri pour chaque th
  echo '<tr align="center" ><th>Année</th>';
  echo '<th align="center" >Forfait Kilometrique</th>';
  echo '<th align="center" >Status</th>';
  echo "</tr>";
  foreach ($rows as $row) //affichage en tableau
{ 
  echo "<tr>"; 
  echo "<td>".$row['annee_per']."</td>"; 
  echo "<td>".$row['forfait_km_per']."</td>";
  if($row['statut_per'] == 0) 
    echo "<td>".$row['statut_per']." - Activ&eacute</td>";
  if($row['statut_per'] == 1)
    echo "<td>".$row['statut_per']." - Desactiv&eacute</td>";
  }
  echo "</tr>"; 
echo "</table>";
?>
<?php
$raws = $PeriodeDAO->findperiode();
  ?>
<br>
 <form action="modifier_periodes.php" method="post"> 
  <select name="Année" id="Année" required>
  <?php
    foreach($raws as $raw){
      foreach($raw as $value){
        echo "<option value='" .$value. "'>" .$value. "</option>";
      }
    }    
  ?>
  </select><br><br>
  <label for="forfait">Forfait Kilometrique :</label><br>
  <input type="number" id="forfait" name="forfait" required><br><br>

  <input type="submit" name='enregistrement' value=" &nbsp;Envoyer ">
<?php
        if(isset($_POST['enregistrement'])){
            $date = $_POST['Année'];
            if($_POST['forfait'] < 0){
              echo "<p>Veuillez rentrer un nombre positif</p>";
              exit;
            }else{
              $forfait = $_POST['forfait'];
            }
            

            $Periode = new Periode(array(
              'annee'=>$date,
              'forfait'=>$forfait,
            ));
            $nb = $PeriodeDAO->update($Periode);
            if($nb == 1){ 
              echo "<br>La période $date a bien été modifiée";
            }else{ 
              echo "<br>La période $date n'a pas été modifiée";
            }           
        }
  ?>
</form>
<!-- <button onclick="myFunction()">Reload page</button>
<script>
function myFunction() {
    location.reload();
}
</script> -->
</body>
</html>