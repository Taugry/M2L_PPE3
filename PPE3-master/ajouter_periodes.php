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
      <li><a href="ajouter_periodes.php">Ajouter</a></li>
      <li><a href="modifier_periodes.php">Modifier</a></li>
      <li><a href="desactiver_periodes.php">Desactiver ou Activer</a></li>
      <li><a href="javascript:history.go(-1)">Retour</a></li>
  </ul>
</nav>
<hr color="black">
<br><br><br>
<form action="ajouter_periodes.php" method="post">
  <label for="date">Année :</label><br>
  <input type="number" id="date" name="date" required><br><br>
  <label for="forfait">Forfait Kilometrique :</label><br>
  <input type="number" id="forfait" name="forfait" required><br><br>
<input type="submit" name='enregistrement' value=" &nbsp;Envoyer ">
<?php
  $PeriodeDAO = new PeriodeDAO();
  if(isset($_POST['enregistrement'])){
          $date = $_POST['date'];
          if($_POST['forfait'] < 0){
            echo "<p>Veuillez rentrer un nombre positif</p>";
            exit;
          }else{
            $forfait = $_POST['forfait'];
          }
          $statut = 0;

          $raws = $PeriodeDAO->statutest();
          foreach($raws as $raw){
            $nb2=$raw['stat'];
            $annee=$raw['annee_per'];
          }
          if($nb2 == 1){
              echo"<br><p>La periode ".$annee. " est déjà activée veuillez la désactiver pour crée une nouvelle periode</p>";
          }else{
            $rows = $PeriodeDAO->findDisabled();
                foreach($rows as $row){
                  $DByear = $row["annee_per"];
                  $DBstatut = $row["statut_per"];
                } $res = $DByear - $date;
                if($res >= 0){
                  echo "<br><br>"; 
                  echo "<p>Vous ne pouvez pas créer la période $date car l’année n’est pas valide</p>";                
                }elseif($statut == $DBstatut){
                  echo "<br><br>"; 
                  echo "<p>Vous ne pouvez pas créer la période $date car une période active existe déjà</p>";  
                }else{
                  $periode = new Periode(array(
                    'annee'=>$date,
                    'forfait'=>$forfait,
                    'statut'=>$statut
                  ));
                  $count = $PeriodeDAO->insert($periode);
                      if($count == 1){
                        echo "<br><br>"; 
                        echo "<p>La periode de $date a été créé dans l’application FREDI</p>";
                      }else{
                        echo "<br><br>"; 
                        echo "<p>La periode de $date n'a pas été créé dans l’application FREDI</p>";                   
                      }
                }
            }        
        }
?>
</form>
</body>
</html>