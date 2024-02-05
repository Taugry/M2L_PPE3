<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ligne de frais</title>
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

  $LdfDAO = new LdfDAO();
  $rows = $LdfDAO->findAll();

    // Affichage de la liste des colonnes
  echo "<br><br>";
  echo "<table>";  //liens qui envoie le mode de tri pour chaque th
  echo '<tr align="center" ><th>ID</th>';
  echo '<th align="center" >Date</th>';
  echo '<th align="center" >Libellé</th>';
  echo '<th align="center" >Coût péage</th>';
  echo '<th align="center" >Coût repas</th>';
  echo '<th align="center" >Coût hébergement</th>';
  echo '<th align="center" >Nb KM</th>';
  echo '<th align="center" >Total KM</th>';
  echo '<th align="center" >Total LDF</th>';
  echo '<th align="center" >MDF</th>';
  echo '<th align="center" >Année per</th>';
  echo '<th align="center" >Utilisateur</th>';
  echo "</tr>";
  foreach ($rows as $row) //affichage en tableau
{
  $id = $row['id_ldf'];
  echo "<tr>";
  echo "<td>".$id."</td>";
  echo "<td>".$row['date_ldf']."</td>";
  echo "<td>".$row['lib_trajet_ldf']."</td>";
  echo "<td>".$row['cout_peage_ldf']."</td>";
  echo "<td>".$row['cout_repas_ldf']."</td>";
  echo "<td>".$row['cout_hebergement_ldf']."</td>";
  echo "<td>".$row['nb_km_ldf']."</td>";
  echo "<td>".$row['total_km_ldf']."</td>";
  echo "<td>".$row['total_ldf']."</td>";
  echo "<td>".$row['id_mdf']."</td>";
  echo "<td>".$row['annee_per']."</td>";
  echo "<td>".$row['email_util']."</td>";
  }
  echo "</tr>";
echo "</table>";
?>
<?php
/*
$LdfDAO = new LdfDAO();


if (isset($_GET['id_ldf'])){
  $Liguerempl = new LigueDAO();
  $id_rempl = $_GET['id_ldf'];
  $rempl = $LdfDAO->find($id_rempl);
  $remdat = $rempl['date_ldf'];
  $remlib = $rempl['lib_trajet_ldf'];
  $remcpl = $rempl['cout_peage_ldf'];
  $remcrl = $rempl['cout_repas_ldf'];
  $remchl = $rempl['cout_hebergement_ldf'];
  $remnbkm = $rempl['nb_km_ldf'];
  $remtnbkm = $rempl['total_km_ldf'];
  $remldf = $rempl['total_ldf'];
  $remidmdf = $rempl['id_mdf'];
  $remap = $rempl['annee_per'];
  $remmail = $rempl['email_util'];


}else{
  $Liguerempl = new LigueDAO();
  $id_rempl = 0;
    $remdat = "&nbsp";
    $remlib = "&nbsp";
    $remcpl = "&nbsp";
    $remcrl = "&nbsp";
    $remchl = "&nbsp";
    $remnbkm = "&nbsp";
    $remtnbkm = "&nbsp";
    $remldf = "&nbsp";
    $remidmdf = "&nbsp";
    $remap = "&nbsp";
    $remmail = "&nbsp";
}
*/

?>
<br>
 <form action="modifier_ldf.php" method="post">
 <label for="id_ldf">ID :</label><br>
  <select name="id_ldf" id="id_ldf" required>
  <?php
  $raws = $LdfDAO->find_id();
  foreach($raws as $raww){
      foreach($raww as $value){
        echo "<option value='" .$value. "'>" .$value. "</option>";
      }
    }
  ?>
  </select><br><br>
     <form action="ajouter_ldf.php" method="post">
         <label for="datee">Date :</label><br>
         <input type="date" id="datee" name="datee" required><br><br>
         <label for="lib">Libellé :</label><br>
         <input type="text" id="lib" name="lib" required><br><br>
         <label for="cpeage">Coût péage :</label><br>
         <input type="number" id="cpeage" name="cpeage" required><br><br>
         <label for="crepas">Coût repas :</label><br>
         <input type="number" id="crepas" name="crepas" required><br><br>
         <label for="cheberge">Coût Hébergement:</label><br>
         <input type="number" id="cheberge" name="cheberge" required><br><br>
         <label for="nbkm">Nombre de KM :</label><br>
         <input type="number" id="nbkm" name="nbkm" required><br><br>
         <label for="motiff">Motif de frais :</label><br>
         <select name="motiff" id="motiff" required>
             <?php
             $MotifDao = new MotifDao();
             $rawsss = $MotifDao->findID();
             foreach($rawsss as $raw){
                 foreach($raw as $value){
                     echo "<option value='" .$value. "'>" .$value. "</option>";
                 }
             }
             ?>
         </select><br>
         <br>
         <label for="anneeperr">Année :</label><br>
         <?php $PeriodeDAO = new PeriodeDAO();
         $rawss = $PeriodeDAO->findperiode();
         ?>
         <select name="anneeperr" id="anneeperr" required>
             <?php
             foreach($rawss as $raw){
                 foreach($raw as $value){
                     echo "<option value='" .$value. "'>" .$value. "</option>";
                 }
             }
             ?>
         </select><br>
         <br>
         <label for="emailutil">Email de l'utilisateur :</label><br>
         <?php $UserDAO = new UserDAO();
         $rawz = $UserDAO->finduser();
         ?>
         <select name="emailutil" id="emailutil" required>
             <?php
             foreach($rawz as $raw){
                 foreach($raw as $value){
                     echo "<option value='" .$value. "'>" .$value. "</option>";
                 }
             }
             ?>
         </select><br><br>
<input type="submit" name='enregistrement' value=" &nbsp;Envoyer ">
<?php
        if(isset($_POST['enregistrement'])){
            $idldf = $_POST['id_ldf'];
            $lib = $_POST['lib'];
            $date = $_POST['datee'];
            $cpeage = $_POST['cpeage'];
            $crepas = $_POST['crepas'];
            $cheberge = $_POST['cheberge'];
            $nbkm = $_POST['nbkm'];
            $tnbkm = $nbkm * 50;
            $tldf = $cheberge + $crepas + $cpeage;
            $motiff = $_POST['motiff'];
            $periode = $_POST['anneeperr'];
            $util = $_POST['emailutil'];

            if($cpeage<0) {
                die("La ligne de frais ne peut être modifiée : des informations sont invalides");
            } elseif ($crepas<0) {
                die("La ligne de frais ne peut être modifiée : des informations sont invalides");
            } elseif ($cheberge<0) {
                die("La ligne de frais ne peut être modifiée : des informations sont invalides");
            } elseif ($nbkm<0) {
                die("La ligne de frais ne peut être modifiée : des informations sont invalides");
            } elseif ($date <= date('Y-m-d', strtotime("01/01/".$periode.""))) {
                die("La ligne de frais ne peut être modifiée : la date n'est pas valide");
            }

            $LdfDao = new LdfDao();
            $idldfb=$LdfDAO->get_id_from_id($idldf);
            if($idldf=$idldfb){
                $Ldf = new Ldf();
                $Ldf -> set_date($date);
                $Ldf -> set_lib($lib);
                $Ldf -> set_coutp($cpeage);
                $Ldf -> set_coutr($crepas);
                $Ldf -> set_couth($cheberge);
                $Ldf -> set_nbkm($nbkm);
                $Ldf -> set_tkm($tnbkm);
                $Ldf -> set_tldf($tldf);
                $Ldf -> set_idmdf($motiff);
                $Ldf -> set_anneeper($periode);
                $Ldf -> set_email($util);
            } else {
                die("Une erreur est survenue");
            }
            var_dump($idldfb);

            $nb = $LdfDAO->update($Ldf);
            if($nb == 1){
              echo "<br>$lib a bien été modifié(e)";
            }else{
              echo "<br>$lib n'a pas été modifié(e)";
            }
        }
  ?>
</form>
<button onclick="myFunction()">Reload page</button>
<script>
function myFunction() {
    document.location.reload();
}
</script>
</body>
</html>