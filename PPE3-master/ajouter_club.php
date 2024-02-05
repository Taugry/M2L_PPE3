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
<br><br><br>
<?php $LigueDao = new LigueDAO();
      $raws = $LigueDao->findlib();
?>
<form action="ajouter_club.php" method="post">
<label for="lib">Libellé :</label><br>
<input type="text" id="lib" name="lib" required><br><br>
<label for="adr1">Rue :</label><br>
<input type="text" id="adr1" name="adr1" required><br><br>
<label for="adr2">Ville :</label><br>
<input type="text" id="adr2" name="adr2" ><br><br>
<label for="adr3">Code Postal:</label><br>
<input type="text" id="adr3" name="adr3" ><br><br>
<select name="libligue" id="libligue" required>
  <?php
    foreach($raws as $raw){
      foreach($raw as $value){
        echo "<option value='" .$value. "'>" .$value. "</option>";
      }
    }    
  ?>
</select><br><br>
<input type="submit" name='enregistrement' value=" &nbsp;Envoyer ">
<?php
  $PeriodeDAO = new PeriodeDAO();
  if(isset($_POST['enregistrement'])){
          $ClubDao = new ClubDAO();
          $lib = $_POST['lib'];
          $adr1 = $_POST['adr1'];
          $adr2 = $_POST['adr2'];
          $adr3 = $_POST['adr3'];
          $ligue = $_POST['libligue'];

          $liguedao = new LigueDAO();
          $id_ligue = $liguedao->findid($ligue);

          $club = new Club(array(
            'lib_club'  => $lib,
            'adr1_club' => $adr1,
            'adr2_club' => $adr2,
            'adr3_club' => $adr3,
            'id_ligue'  => $id_ligue
          ));
          
          $count = $ClubDao->insert($club);
          if(isset($_POST['enregistrement'])){    
            if($count == 1){
              echo "<br><br>"; 
              echo "<p> ".$lib." a bien été ajouté dans la base FREDI</p>";
            }else{
              echo "<br><br>"; 
              echo "<p>".$lib." n'a pas été ajouté dans la base FREDI</p>";
            } 
          }
        }       
?>
</form>
</body>
</html>