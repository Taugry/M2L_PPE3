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
<br><br><br>
<form action="ajouter_motif.php" method="post">
  <label for="libmotif">Libellé motif</label><br>
  <input type="libmotif" id="libmotif" name="libmotif" required><br><br>
  <input type="submit" name='enregistrement' value=" &nbsp;Envoyer ">
<?php
    if(isset($_POST['enregistrement'])){
      $libmotif = $_POST['libmotif'];       
      $MotifDao = new MotifDao();
      $count = $MotifDao->insert($libmotif);
      if($count == 1){
        echo "<br><br>"; 
        echo "<p>Le Motif de frais a bien ete Ajouter dnas la base FREDI</p>";
      }else{
        echo "<br><br>"; 
        echo "<p>Le Motif de frais n'a pas ete Ajouter dnas la base FREDI</p>";
      } 
    }       
?>
</form>
</body>
</html>