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
  $UserDAO = new UserDAO();
  $rows = $UserDAO->findDisabled();

 echo"<br><br>";
  // Affichage de la liste des colonnes
  echo "<table>";  //liens qui envoie le mode de tri pour chaque th
  echo "<tr><th>E-mail</th>";
  echo "<th>Mot de passe</th>";
  echo "<th>Nom</th>";
  echo "<th>Prenom</th>";
  echo "<th>Statut</th>";
  echo "<th>Matricule</th>";
  echo "<th>Type utilisateur</th>";
  echo "</tr>";
  foreach ($rows as $row) //affichage en tableau
{ 
  echo "<tr>"; 
  echo "<td>".$row['email_util']."</td>"; 
  echo "<td><p>Confidentiel</p></td>"; 
  echo "<td>".$row['nom_util']."</td>"; 
  echo "<td>".$row['prenom_util']."</td>"; 
  echo "<td>".$row['statut_util']."</td>"; 
  echo "<td>".$row['matricule_cont']."</td>"; 
  echo "<td>".$row['id_type_util']."</td>"; 
  }
  echo "</tr>"; 
echo "</table>";
?><!--From pour modifier l'utilisateur en question -->
<?php
$raws = $UserDAO->finduser();
?>
<br>
 <form action="modifier.php" method="post">
  <select name="email" id="email" required>
    <?php
        foreach($raws as $raw){
        foreach($raw as $value){
            echo "<option value='" .$value. "'>" .$value. "</option>";
        }
        }    
    ?>
    </select><br><br>
  <label for="nom">Nom :</label><br>
  <input type="text" id="nom" name="nom" required><br><br>
  <label for="prenom">Prenom :</label><br>
  <input type="text" id="prenom" name="prenom" required><br><br>
  <label for="statut">Statut :</label><br>
  <input type="text" id="statut" name="statut" ><br><br>
  <label for="matricule">Matricule</label><br>
  <input type="text" id="matricule" name="matricule"><br><br>

<select name="typeutil" id="typeutil" required>
     <option value="1">Adhérent</option>
     <option value="2">Contrôleur</option>
     <option value="3">Administrateur</option>
</select>
  <input type="submit" name='enregistrement' value=" &nbsp;Envoyer "><br><br>
<?php
        if(isset($_POST['enregistrement'])){
          $email = $_POST['email'];
          $nom = $_POST['nom'];
          $prenom = $_POST['prenom'];
          $matricule = $_POST['matricule'];
          $typeutil = $_POST['typeutil'];
          $Statut = $_POST['statut'];

          $UserDAO = new UserDAO();
          $user = new user(array(
            'email'=>$email,
            'nom' => $nom,
            'prenom' => $prenom,
            'matricule' => $matricule,
            'typeutil' => $typeutil,
            'statut' => $Statut
          ));
          $nb = $UserDAO->update($user);
          if($nb == 1){
            echo "<br>L’utilisateur ".$nom." a été modifié dans la base FREDI";
          }else{
            echo "<br>L’utilisateur ".$nom." n'a pas été modifié dans la base FREDI";
          }                    
        }    
  ?>
</form>

</body>
</html>