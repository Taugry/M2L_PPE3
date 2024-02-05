<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <title>Ajouter vos questions !</title>
</head>
<body>
  <?php include 'top.php'; ?>
  <?php include 'menu.php'; ?>

  <?php
  // si l'utilisateur a une session
      if (isset($_SESSION['session_iduser'])) {
          if (isset($_POST['submit']) && isset($_POST['question'])) {
              try {
                  $date = date('Y-m-d H:i:s');
                  $bdd = new PDO('mysql:host=localhost;dbname=m2l', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $question = addslashes($_POST['question']);
                  $sql = "insert into faq (question, dat_question, ID_user) values ('".$question."', '".$date."', '".$_SESSION['session_iduser']."')";
                  $sth = $bdd->prepare($sql);
                  $sth->execute();
                  echo '<p>Insertion réussie !</p>';
                  header('location: faq.php');
              } catch (Exception $e) {
                  die('Erreur :'.$e->getMessage());
                  echo '<p>marche pas</p>';
              }
          } ?>
          <div id='addform'>
          <form class='form' action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
              <input type="submit" name="submit" value="Envoyer"><br><br>
              <textarea class='form' name="question" placeholder="Des recommendations ? Questions ?" rows="10" cols="70" ></textarea><br>
          </form>
          </div>
      <?php
      } else {
          echo '<p>Vous devez être connecté</p>';
      }

    ?>



</body>
</html>