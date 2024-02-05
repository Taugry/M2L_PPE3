<link rel="stylesheet" href="css/style.css">
<div class="top">
<h1>FAQ de la ligue de football</h1>
<?php 
session_start();
if(isset($_SESSION['session_username'])) {
  echo '<p>Bienvenue, ' . $_SESSION['session_username'] . '</p>';
}
?>
<ul>
<?php if(isset($_SESSION['session_username'])) { ?>
  <li style="float:right"><a class="active" href="logout.php">Déconnexion</a></li>  
  <?php } else { ?>
  <li style="float:right"><a class="active" href="login.php">Connexion</a></li>
  <li style="float:right"><a class="active" href="register.php">Inscription</a></li>
  <?php } ?>
</ul>
</div>
