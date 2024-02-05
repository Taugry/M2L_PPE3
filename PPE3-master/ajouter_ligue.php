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
      <li><a href="ajouter_ligue.php">Ajouter</a></li>
      <li><a href="modifier_ligue.php">Modifier</a></li>
      <li><a href="supprimer_ligue.php">Supprimer</a></li>
      <li><a href="javascript:history.go(-1)">Retour</a></li>
  </ul>
</nav>
<?php
$LigueDAO = new LigueDAO();
$raws = $LigueDAO->findmail();

?>
<hr color="black">
<br><br><br>
<form action="ajouter_ligue.php" method="post">
<label for="lib">Libellé :</label><br>
<input type="text" id="lib" name="lib" required><br><br>
<label for="url">URL :</label><br>
<input type="text" id="url" name="url" required><br><br>
<label for="contact">Contact :</label><br>
<input type="text" id="contact" name="contact" required><br><br>
<label for="tel">Telephone :</label><br>
<input type="number" id="tel" name="tel" required><br><br>
<select name="mail" id="mail" required>
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

  if(isset($_POST['enregistrement'])){  

          $lib = $_POST['lib'];
          $url = $_POST['url'];
          $contact = $_POST['contact'];
          $tel = $_POST['tel'];
          $mail = $_POST['mail'];

          $ligue = new Ligue(array(

            'lib_ligue'       => $lib,
            'URL_ligue'       => $url,
            'contact_ligue'   => $contact,
            'telephone_ligue' => $tel,
            'email_util'      => $mail
          ));
          
          $count = $LigueDAO->insert($ligue);
 
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