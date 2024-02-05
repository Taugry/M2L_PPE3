    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Delete</title>
</head>
<body>
<?php
    include 'top.php';
    include 'menu.php';

    if (!isset($_GET['id'])) {
        header('location: faq.php');
    }

    if (isset($_SESSION['session_iduser'])) {
        if (isset($_POST['submit'])) {
            $id_faq = $_GET['id'];
            if ($_SESSION['session_idusertype'] == 3 || $_SESSION['session_idusertype'] == 2) {
                $sql = "delete from faq where id_faq=:id_faq";
                try {
                    $dbh = new PDO('mysql:host=localhost;dbname=m2l', 'root', '');
                    $sth = $dbh->prepare($sql);
                    $sth->execute(array(':id_faq' => $id_faq));
                } catch (PDOException $ex) {
                    die("Erreur lors de la requête SQL : ".$ex->getMessage());
                }
                echo "<p>".$sth->rowcount()." enregistrement(s) supprimé(s)</p>";
                header('location: faq.php');
            }
        } ?>
    <?php $idfaq = $_GET['id']?>
      <div class="form">
        <p id="pform">Voulez-vous vraiment supprimer cette question ?</p>
        <form action="delete.php?id=<?php echo $idfaq?>" method="post">
            <input type="submit" name="submit" value="Supprimer">
        </form>
        <form action="faq.php" method="post">
            <input type="submit" name="Asubmit" value="Annuler">
        </form>
      </div>

    <?php
    } else {
        echo '<p>Vous devez être connecté</p>';
    }
      ?>
    <p><a href="faq.php">Retour au questions</a></p>
</body>
</html>