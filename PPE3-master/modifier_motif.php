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

<hr color="orange">
<nav>
  <ul>
      <li><a href="ajouter_motif.php">Ajouter</a></li>
      <li><a href="modifier_motif.php">Modifier</a></li>
      <li><a href="supprimer_motif.php">Supprimer</a></li>
      <li><a href="javascript:history.go(-1)">Retour</a></li>
  </ul>
</nav>
<hr color="orange">  
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

  $MotifDao = new MotifDao();
  $rows = $MotifDao->findAll();

echo"<br><br>";
  // Affichage de la liste des colonnes
  echo "<table>";  //liens qui envoie le mode de tri pour chaque th
  echo "<tr><th>ID</th>";
  echo "<th>Libellé</th>";
  echo "</tr>";
  foreach ($rows as $row) //affichage en tableau
{ 
  echo "<tr>"; 
  echo "<td>".$row['id_mdf']."</td>"; 
  echo "<td>".$row['lib_mdf']."</td>"; 
  }
  echo "</tr>"; 
echo "</table>";
?>
<?php
$raws = $MotifDao->findID();
  ?>
<br>
<form action="modifier_motif.php" method="post"> 
  <select name="idmotif" id="idmotif" required>
  <?php
    foreach($raws as $raw){
      foreach($raw as $value){
        echo "<option value='" .$value. "'>" .$value. "</option>";
      }
    }    
  ?>
  </select><br><br>
  <label for="libmotif">Libellé motif</label><br>
  <input type="libmotif" id="libmotif" name="libmotif" required><br><br>
  <input type="submit" name='enregistrement' value=" &nbsp;Envoyer ">
<?php 
      if(isset($_POST['enregistrement'])){
          $idmotif = $_POST['idmotif']; 
          $libmotif = $_POST['libmotif'];             
          $Motif = new Motif(array(
            'id'=>$idmotif,
            'lib'=>$libmotif
          ));
          $nb = $MotifDao->update($Motif);
          if($nb == 1){ 
            echo "<br>Le Motif $idmotif bien été modifié";
          }else{ 
            echo "<br>Le Motif $idmotif n'a pas été modifié";
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