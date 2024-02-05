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
<?php include 'menu.php';?> 
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

<hr color="green">
<nav>
  <ul>
      <li><a href="ajouter.php">Ajouter</a></li>
      <li><a href="modifier.php">Modifier</a></li>
      <li><a href="desactiver.php">Desactiver</a></li>
      <li><a href="supprimer.php">Supprimer</a></li>
      <li><a href="javascript:history.go(-1)">Retour</a></li>
  </ul>
</nav>
<hr color="green">
<br><br><br>
<form action="ajouter.php" method="post">
  <label for="email">E-Mail :</label><br>
  <input type="email" id="email" name="email" required><br><br>
  <label for="mdp">Mot de passe :</label><br>
  <input type="text" id="mdp" name="mdp" required><br><br>
  <label for="nom">Nom :</label><br>
  <input type="text" id="nom" name="nom" required><br><br>
  <label for="prenom">Prenom :</label><br>
  <input type="text" id="prenom" name="prenom" required><br><br>

  <label for="matricule">Matricule</label><br>
  <input type="text" id="matricule" name="matricule"><br><br>

<select name="typeutil" id="typeutil" required>
     <option value="1">Adhérent</option>
     <option value="2">Contrôleur</option>
     <option value="3">Administrateur</option>
</select>

<input type="submit" name='enregistrement' value=" &nbsp;Envoyer ">
<?php
  $UserDAO = new UserDAO();
  if(isset($_POST['enregistrement'])){
          $email = $_POST['email'];
          $mdp = $_POST['mdp'];
          $nom = $_POST['nom'];
          $prenom = $_POST['prenom'];
          $matricule = $_POST['matricule'];
          $typeutil = $_POST['typeutil'];
          $hashed_password = password_hash($_POST["mdp"],PASSWORD_DEFAULT);
          
          $user = new user(array(
            'email'=>$email,
            'mdp'=>$hashed_password,
            'nom'=>$nom,
            'prenom'=>$prenom,
            'matricule'=>$matricule,
            'typeutil'=>$typeutil
          ));  
          // Ajoute l'enregistrement dans la BD
          $count = $UserDAO->insert($user);
          if($count == 1){
            echo "<br><br>"; 
            echo "<p>L'utilisateur $nom a été créé dans la base FREDI</p>";
          }else{
            echo "<br><br>"; 
            echo "<p>Cette adresse mail $email est déjà utilisée</p>";
          }        
  }       
?>
</form>
</body>
</html>