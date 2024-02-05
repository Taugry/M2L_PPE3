<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Back office</title>
</head>
<body>


    <?php 
    include 'top.php';
    include 'menu.php';

    echo '<h1>Back Office</h1>';
    echo '<p>Cette page permet de modifier les utilisateurs, question, et plus...</p>'; 

     ?> <p><a href='?view=users'>Utilisateurs</a></p> <p><a href='?view=questions'>Question</a></p> <?php


    if (isset($_SESSION['session_idusertype']) && ($_SESSION['session_idusertype'] == 3 || $_SESSION['session_idusertype'] == 2)) {

        // Si le formulaire a été utilisé
        
        if (isset($_POST['submit'])) {
            if ($_POST['submit'] == 'user') {
                $dbh = new PDO('mysql:host=localhost;dbname=m2l', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if (isset($_POST['ismdp'])) {
                    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                    $sql = 'update user set pseudo = "'.$_POST['pseudo'].'", mdp = "'.$mdp.'", mail = "'.$_POST['mail'].'", id_ligue = '.$_POST['ligue'].', id_usertype = '.$_POST['id_usertype'].' where id_user = '.$_POST['id_user'];
                } else {
                    $sql = 'update user set pseudo = "'.$_POST['pseudo'].'", mail = "'.$_POST['mail'].'", id_ligue = '.$_POST['ligue'].', id_usertype = '.$_POST['id_usertype'].' where id_user = '.$_POST['id_user'];
                }
                $sth = $dbh->prepare($sql);
                $sth->execute();

            }
            if ($_POST['submit'] == 'question') {
                $dbh = new PDO('mysql:host=localhost;dbname=m2l', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $question = addslashes($_POST['question']);
                $reponse = addslashes($_POST['reponse']);
                $sql = 'Update faq set question = "'.$question.'", reponse = "'.$reponse.'", dat_question = "'.$_POST['dat_question'].'", dat_reponse = "'.$_POST['dat_reponse'].'", ID_user = '.$_POST['id_user'].' WHERE id_faq = '.$_POST['id_faq'].'';
                $sth = $dbh->prepare($sql);
                $sth->execute();
            }    
        }


        if (isset($_GET['edituser'])) {
            
            try {
                // Connexion DB
                $dbh = new PDO('mysql:host=localhost;dbname=m2l', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Récupération des données des utilisateurs
                $sql = 'SELECT * FROM user, ligue, usertype WHERE id_user = ' . $_GET['edituser'] . ' AND user.ID_usertype = usertype.ID_usertype AND user.ID_ligue = ligue.ID_ligue';
                $sth = $dbh->prepare($sql);
                $sth->execute(array());
                $user = $sth->fetch(PDO::FETCH_ASSOC);

                // Récupération des ligues
                $sql = 'SELECT ID_ligue, lib_ligue FROM ligue';
                $sth = $dbh->prepare($sql);
                $sth->execute(array());
                $ligues = $sth->fetchAll(PDO::FETCH_ASSOC);

                // Récupération des usertypes
                $sql = 'SELECT ID_usertype, lib_usertype FROM usertype';
                $sth = $dbh->prepare($sql);
                $sth->execute(array());
                $usertypes = $sth->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $ex) {
                die("Erreur lors de la connexion SQL : " . $ex->getMessage());
            }
            ?>

            <!-- Formulaire -->
                <form method="post">
                    </p>Pseudo :</p>
                    <input type='text' name='pseudo' value='<?php echo $user['pseudo'] ?>' required><br>

                    <fieldset>
                        <legend>Modification du mot de passe ?</legend>
                        <input type='checkbox' id='ismdp' name='ismdp' onclick='affichageMdp()'>

                        <div id='mdpform' style='display:none;'>
                            Mot de passe :
                            <input type='text' name='mdp'>
                        </div>
                        <!-- Script permettant d'afficher l'input du mdp si l'input checkbox est coché -->
                        <script>
                            function affichageMdp() {
                                var ismdp = document.getElementById('ismdp');
                                var mdpform = document.getElementById('mdpform');

                                if (ismdp.checked == true) {
                                    mdpform.style.display = 'block';
                                } else {
                                    mdpform.style.display = 'none';
                                }
                            };
                        </script>
                    </fieldset>

                    </p>Email :</p>
                    <input type='text' name='mail' value='<?php echo $user['mail'] ?>' required>

                    </p>Droit</p>
                    <select name="id_usertype" required>
                    <?php
                    $i = 1;
                    foreach ($usertypes as $usertype) {
                        if ($user['ID_usertype'] == $usertype['ID_usertype']) {
                            echo '<option value=' . $i . ' SELECTED>' . $usertype['lib_usertype'] . '</option>';
                        } else {
                            echo '<option value=' . $i . '>' . $usertype['lib_usertype'] . '</option>';
                        }
                        $i++;
                    }
                    ?>
                    </select>

                    </p>Ligue</p>
                    <select name="ligue" required>
                    <?php
                    $i = 1;
                    foreach ($ligues as $ligue) {
                        if ($user['ID_ligue'] == $ligue['ID_ligue']) {
                            echo '<option value=' . $i . ' SELECTED>' . $ligue['lib_ligue'] . '</option>';
                        } else {
                            echo '<option value=' . $i . '>' . $ligue['lib_ligue'] . '</option>';
                        }
                        $i++;
                    }
                    ?>
                    </select>

                    <input type="text" name='id_user' value ='<?php echo $_GET['edituser'] ?>' hidden>
                    <input type="submit" name="submit" value="user">
                </form>
                <p><a href='backoffice.php'>Retour</a></p>

            <?php

        } else if (isset($_GET['editquestion'])) {

            try {
                // Connexion DB
                $dbh = new PDO('mysql:host=localhost;dbname=m2l', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Récupération des données des utilisateurs
                $sql = 'SELECT * FROM faq, user WHERE user.ID_user = faq.ID_user AND faq.id_faq = '.$_GET['editquestion'].'';
                $sth = $dbh->prepare($sql);
                $sth->execute(array());
                $question = $sth->fetch(PDO::FETCH_ASSOC);

                // Récupération des auteurs
                $sql = 'SELECT * FROM user';
                $sth = $dbh->prepare($sql);
                $sth->execute(array());
                $auteurs = $sth->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $ex) {
                die("Erreur lors de la connexion SQL : " . $ex->getMessage());
            }
            var_dump(date('Y-m-d', strtotime($question['dat_question'])));
            ?>
            
            <form method=post >
                Question : <br>
                <input type="textarea" name="question" value="<?php echo $question['question'] ?>"> <br><br>
                
                Reponse : <br>
                <input type="textarea" name="reponse" value="<?php echo $question['reponse'] ?>"> <br><br>

                Date question : <br>
                <input type="date" name="dat_question" value="<?php echo date('Y-m-d', strtotime($question['dat_question'])) ?>"> <br><br>

                Date réponse : <br>
                <input type="date" name="dat_reponse" value="<?php echo date('Y-m-d', strtotime($question['dat_reponse'])) ?>"> <br><br>

                Auteur : <br>
                <select name="id_user" required>
                <?php
                $i = 1;
                foreach ($auteurs as $auteur) {
                    if ($auteur['ID_user'] == $question['ID_user']) {
                        echo '<option value=' . $auteur['ID_user'] . ' SELECTED>' . $auteur['pseudo'] . '</option>';
                    } else {
                        echo '<option value=' . $auteur['ID_user'] . '>' . $auteur['pseudo'] . '</option>';
                    }
                }
                ?>
                <br>
                <input type="text" name="id_faq" value="<?php echo $_GET['editquestion']; ?>" hidden>
                <input type="submit" name="submit" value="question">
                </select>

            <?php
        }
         
            // Connexion DB
            try {
                $dbh = new PDO('mysql:host=localhost;dbname=m2l', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $ex) {
                die("Erreur lors de la connexion SQL : " . $ex->getMessage());
            }

            if (isset($_GET['view']) && $_GET['view'] == 'users' || isset($_GET['edituser'])) {
               
                try {
                    $sql = 'SELECT * FROM user, ligue, usertype WHERE user.ID_usertype = usertype.ID_usertype AND user.ID_ligue = ligue.ID_ligue';
                    $sth = $dbh->prepare($sql);
                    $sth->execute(array());
                    $users = $sth->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $ex) {
                    die("Erreur lors de la connexion SQL : " . $ex->getMessage());
                }

                echo '<div class="backoffice">';
                echo '<table>';
                echo '<tr><th>ID_user</th><th>Pseudo</th><th>mail</th><th>ID_usertype</th><th>ID_ligue</th><th>&nbsp</th></tr>';

                foreach ($users as $user) {
                    echo '<tr>';
                    echo '<td>' . $user['ID_user'] . '</td>';
                    echo '<td>' . $user['pseudo'] . '</td>';
                    echo '<td>' . $user['mail'] . '</td>';
                    echo '<td>' . $user['lib_usertype'] . '</td>';
                    echo '<td>' . $user['lib_ligue'] . '</td>';
                    echo '<td>';
                    echo '<a href="'.$_SERVER['PHP_SELF'].'?edituser='.$user['ID_user'].'"><img src=\'ico/icons/pencil.png\'><a href=\''.$_SERVER['PHP_SELF'].'?id='.$user['ID_user'].'\'><img src=\'ico/icons/delete.png\'>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '</div>';
            }

            if (isset($_GET['view']) && $_GET['view'] == 'questions' || isset($_GET['editquestion'])) {
                
                 // Connexion DB
                try {
                    $sql = 'SELECT * FROM faq, user WHERE user.ID_user = faq.ID_user';
                    $sth = $dbh->prepare($sql);
                    $sth->execute(array());
                    $questions = $sth->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $ex) {
                    die("Erreur lors de la connexion SQL : " . $ex->getMessage());
                }
                
                echo '<div class="backoffice">';
                echo '<table>';
                echo '<tr><th>ID_faq</th><th>Question</th><th>Reponse</th><th>dat_question</th><th>dat_reponse</th><th>Utilisateur</th><th>&nbsp</th></tr>';

                foreach ($questions as $question) {
                    echo '<tr>';
                    echo '<td>' . $question['id_faq'] . '</td>';
                    echo '<td>' . $question['question'] . '</td>';
                    echo '<td>' . $question['reponse'] . '</td>';
                    echo '<td>' . $question['dat_question'] . '</td>';
                    echo '<td>' . $question['dat_reponse'] . '</td>';
                    echo '<td>' . $question['pseudo'] . '</td>';
                    echo '<td>';
                    echo '<a href="'.$_SERVER['PHP_SELF'].'?editquestion='.$question['id_faq'].'"><img src=\'ico/icons/pencil.png\'><a href=\''.$_SERVER['PHP_SELF'].'?id='.$question['id_faq'].'\'><img src=\'ico/icons/delete.png\'>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '</div>';

            }
        
    } else {
        echo '<p>Bien joué, mais vous n\'avez pas accès</p>';
    }





?>
</body>
</html>