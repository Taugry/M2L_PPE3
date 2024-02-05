<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FREDI</title>
</head>
<body>
<br><br>
<img class="displayed" alt="FREDI" src="img\bg.png" title="FREDI">
<br><br>
<!-- Code php de verification si l'utilisateur est connecté --> 
<?php 
session_start();

?>
<?php require_once "init.php";?>
<!-- Menu --> 
<hr color="black">
<nav>
  <ul>
    <li><a href="top.php">Accueil &ensp;</a></li>
    <li class="deroulant"><a href="#">Ligue &ensp;</a>
      <ul class="sous">
      <?php 
      $LigueDAO = new LigueDAO();
      $raws = $LigueDAO->findlib();
      foreach($raws as $raw) {
        foreach($raw as $value){
          echo "<li><a href='".$value.".php'>" .$value. "</a></li>";
        }
      }  
      ?>
      </ul>
    </li>
    <?php if(isset($_SESSION['session_username'])) {?>
      <li><a href="logout.php">Déconnexion</a></li>
      <li class="deroulant"><a href="#">Mon compte &ensp;</a>
      <ul class="sous">
     <?php if ($_SESSION['session_libtype']=="Administrateur"||$_SESSION['session_libtype']=="GOD"){
     echo'<li><a href="compte.php">Gestion Utilisateur</a></li>';
     echo'<li><a href="periodes.php">Gestion P&eacute;riodes</a></li>';
     echo'<li><a href="motif_frais.php">Gestion Motifs</a></li>';
    } elseif ($_SESSION['session_libtype']=="Contrôleur"||$_SESSION['session_libtype']=="GOD"){
     echo'<li><a href="club.php">Gestion des Clubs</a></li>';
     echo'<li><a href="ligue.php">Gestion des Ligues</a></li>';
    } elseif ($_SESSION['session_libtype']=="adhérent"||$_SESSION['session_libtype']=="GOD"){
     echo'<li><a href="ligne_de_frais.php">Gestion des Lignes de Frais</a></li>';
     echo'<li><a href="editing.php">Editique</a></li>';
    }?>
      </ul>
    </li>
    <?php } else {?>
    <li><a href="login.php">Se connecter</a></li>
    <?php }?>
    
  </ul>
</nav>
<hr color="black">
<!-- Paragraphe --> 

<br>
<div class="outer-div">
        <div class="inner-div">
<?php if(isset($_SESSION['session_username'])) {
  echo '<h2>Bienvenue '.$_SESSION['session_libtype'].' sur le site de la M2L FREDI </h2>'; 
  }else {
    echo'<h2>BIENVENUE SUR LE SITE DE LA M2L FREDI </h2>';
  }?>
<br>
</div>
</body>
</html>