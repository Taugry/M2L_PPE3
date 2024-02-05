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
      <li><a href="ajouter_ldf.php">Ajouter</a></li>
      <li><a href="modifier_ldf.php">Modifier</a></li>
      <li><a href="supprimer_ldf.php">Supprimer</a></li>
      <li><a href="javascript:history.go(-1)">Retour</a></li>
  </ul>
</nav>
<hr color="black">

<br><br>
<?php $LdfDao = new LdfDao();
      $raws = $LdfDao->get_lib();
?>
<form action="supprimer_ldf.php" method="post">
  <select name="lib_trajet_ldf" id="lib_trajet_ldf" required>
  <?php
    foreach($raws as $raw){
      foreach($raw as $value){
        echo "<option value='" .$value. "'>" .$value. " </option>";
      }
    }
  ?>
  </select><br><br>
  <input type="submit" name="Supprimer" value="&nbsp;Supprimer&nbsp;">
</form>
<br>
<?php
        if(isset($_POST['Supprimer'])){
          $lib = $_POST['lib_trajet_ldf'];
          echo"<hr color='black'>";
          echo"<br><center><bold><a> Voulez-vous vraiment supprimer la ligne de frais ? </a></bold></center> ";
          echo"<br><center><input type='submit' name='Oui' value='&nbsp;Oui&nbsp;'></center>";
          echo"<br><center><input type='submit' name='Non' value='&nbsp;Non&nbsp;'></center>";
          if(isset($_POST['Oui'])){
              $id = $LdfDao->get_id($lib);
              $motifdao = new motifDAO;
              $nb = 0;
              $nb = $LdfDao->delete($id);
              if($nb == 1){
                  echo "<br>La ligne $lib a bien &eacute;t&eacute; supprim&eacute; dans la base FREDI";
              }else{
                  echo "<br>La ligne $lib n'a pas &eacute;t&eacute; supprim&eacute; dans la base FREDI";
              }
              header('Refresh: 5; URL=supprimer_ldf.php');
          } elseif(isset($_POST['Non'])) {
              echo"<br> La ligne n'a pas &eacute;t&eacute; supprim&eacute;e ";
          }


          }



?>
</body>
</html>