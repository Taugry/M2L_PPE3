<div id=conteneur>
<div id="menu">
    <h2>MENU</h2>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="basket.php">Ligue de basket</a></li>
        <li><a href="football.php">Ligue de football</a></li>
        <li><a href="volley.php">Ligue de volley</a></li>
        <li><a href="handball.php">Ligue de handball</a></li>
        <li><a href="faq.php">Liste des questions</a></li>
        <li><a href="add.php">Ajouter une question</a></li>
        <?php if(isset($_SESSION['session_idusertype'])) {
            if ($_SESSION['session_idusertype'] == 2 || $_SESSION['session_idusertype'] == 3) {
                echo '<li><a href="backoffice.php">Back-office</a></li>';
            }
        } ?>
    </ul>
</div>
