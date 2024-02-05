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
      <li><a href="ajouter.php">Ajouter</a></li>
      <li><a href="modifier.php">Modifier</a></li>
      <li><a href="desactiver.php">Desactiver</a></li>
      <li><a href="supprimer.php">Supprimer</a></li>
      <li><a href="javascript:history.go(-1)">Retour</a></li>
  </ul>
</nav>
<hr color="black">
<br><br>
<?php $UserDAO = new UserDAO();
      $raws = $UserDAO->finduser();
?>
<form action="desactiver.php" method="post">
<select name="email" id="email" required>
    <?php
        foreach($raws as $raw){
        foreach($raw as $value){
            echo "<option value='" .$value. "'>" .$value. "</option>";
        }
        }    
    ?>
    </select><br><br>
  <input type="submit" name="Desactiver" value="&nbsp;Desactiver&nbsp;">
</form>
<br>
<?php
        if(isset($_POST['Desactiver'])){
          $email = $_POST['email'];
          $nb = $UserDAO->Disabled($email);
          if($nb == 1){
            echo "<br>L’utilisateur a bien été Desactiver dans la base FREDI";
          }else{
            echo "<br>L’utilisateur n'a pas été Desactiver dans la base FREDI";
          }
        }
?>
<!-- UPDATE utilisateur SET is_disabled = 1 WHERE email_util= :email -->
</body>
</html>