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
      <li><a href="ajouter_club.php">Ajouter</a></li>
      <li><a href="modifier_club.php">Modifier</a></li>
      <li><a href="supprimer_club.php">Supprimer</a></li>
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

  $ClubDAO = new ClubDAO();
  $rows = $ClubDAO->findAll();

    // Affichage de la liste des colonnes
  echo "<br><br>";
  echo "<table>";  //liens qui envoie le mode de tri pour chaque th
  echo '<tr align="center" ><th>ID</th>';
  echo '<th align="center" >Libellé</th>';
  echo '<th align="center" >Rue</th>';
  echo '<th align="center" >Ville</th>';
  echo '<th align="center" >CP</th>';
  echo "</tr>";
  foreach ($rows as $row) //affichage en tableau
{ 
  echo "<tr>"; 
  echo "<td>".$row['id_club']."</td>"; 
  echo "<td>".$row['lib_club']."</td>";
  echo "<td>".$row['adr1_club']."</td>";
  echo "<td>".$row['adr2_club']."</td>";
  echo "<td>".$row['adr3_club']."</td>";
  }
  echo "</tr>"; 
echo "</table>";
?>
<?php
$raws = $ClubDAO->findclub();
  ?>
<br>
 <form action="modifier_club.php" method="post"> 
  <select name="ID" id="id" required>
  <?php
    foreach($raws as $raw){
      foreach($raw as $value){
        echo "<option value='" .$value. "'>" .$value. "</option>";
      }
    }    
  ?>
  </select><br><br>
  <label for="lib">Libellé :</label><br>
  <input type="text" id="lib" name="lib" required><br><br>
  <label for="adr1">Rue :</label><br>
  <input type="text" id="adr1" name="adr1" required><br><br>
  <label for="adr2">Ville :</label><br>
  <input type="text" id="adr2" name="adr2" required><br><br>
  <label for="adr3">Code Postal :</label><br>
  <input type="text" id="adr3" name="adr3" required><br><br>

  <input type="submit" name='enregistrement' value=" &nbsp;Envoyer ">
<?php
        if(isset($_POST['enregistrement'])){
            $lib = $_POST['lib'];
            $adr1 = $_POST['adr1'];
            $adr2 = $_POST['adr2'];
            $adr3 = $_POST['adr3'];
            $id_club = $ClubDAO->findtheID($lib);
            $club = new Club(array(
              'lib_club'=>$lib,
              'adr1'=>$adr1,
              'adr2'=>$adr2,
              'adr3'=>$adr3,
              'id_club'=>$id_club
            ));
            $nb = $ClubDAO->update($club);
            if($nb == 1){ 
              echo "<br>$lib a bien été modifié(e)";
            }else{ 
              echo "<br>$lib n'a pas été modifié(e)";
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