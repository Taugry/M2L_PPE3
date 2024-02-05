
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <title>Edit</title>
</head>
<body>
  <?php include 'top.php'; ?>
  <?php include 'menu.php'; ?>

  <?php

    if (isset($_POST['submit'])) {
      try {
        $date = date('Y-m-d H:i:s');
        $bdd = new PDO('mysql:host=localhost;dbname=m2l', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $question = addslashes($_POST['question']);
        $sql = "update faq set question = '".$question."', reponse = '".$_POST['reponse']."', dat_reponse = '".$date."' where id_faq = '".$_POST['id_faq']."'";
        $sth = $bdd->prepare($sql);
        $sth->execute();
        echo '<p>Insertion réussie !</p>';
        header('Location: faq.php');
    } catch(Exception $e) {
        die('Erreur :'.$e->getMessage());
        echo '<p>marche pas</p>';
      }
    } else {
?>

<?php
    // Arrivée sur la page depuis 
      if (isset($_SESSION['session_username'])) {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=m2l', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $sql = 'SELECT id_faq, question, reponse FROM faq WHERE id_faq = "'.$_GET['id'].'"';
            $sth = $dbh->prepare($sql);
            $sth->execute(array());
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class='form'>
                <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
                    <input name="id_faq" type="hidden" value="<?php echo $row['id_faq']; ?>">
                    Question : <br>
                    <textarea name="question" style="height:200px"><?php echo $row['question']; ?></textarea><br>
                    Reponse : <br>
                    <textarea name="reponse" style="height:200px"><?php if($row['reponse'] != ' ') { echo $row['reponse']; } ?> </textarea><br>
                    <input type="submit" name="submit" value="Envoyer">
                </form>
            </div>
<?php
        }
        catch(Exception $e) {
            die('Erreur :'.$e->getMessage());
            echo '<p>marche pas</p>';
        }
      } else {
        echo '<p>Vous devez être connecté</p>';
      }
    }
?>
    <p><a href="faq.php">Retour au questions</a></p>

</body>
</html>