<?php
    // Nombre de questions par page
    $nbParPages = 5;

    


    if (isset($_SESSION['session_username'])) {

        try {
            $dbh = new PDO('mysql:host=localhost;dbname=m2l', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        }
        catch(Exception $e) {
            die('Erreur :'.$e->getMessage());
            echo '<p>marche pas</p>';
        }

        // Requete pour l'affichage des pseudo dans le formulaire de recherche
        $sql = 'SELECT pseudo, ID_user FROM user';
        $sth = $dbh->prepare($sql);
        $sth->execute(array());
        $listeUtilisateur = $sth->fetchAll(PDO::FETCH_ASSOC);

        ?>
            <!-- Formulaire de recherche -->
            <div id='recherche' style='margin-left: 250px;'>
                <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='get'>
                    Recherche :
                    <input type='text' name='recherche' <?php if (isset($_GET['recherche'])) { echo 'value='.$_GET['recherche']; } ?>>
                    <select name="triutilisateur">
                        <option value='tous'>Tous</option>
                    <?php
                    foreach ($listeUtilisateur as $utilisateur) {
                        echo '<option value="'.$utilisateur['pseudo'].'"';
                        if (isset($_GET['triutilisateur'])) {
                            if ($_GET['triutilisateur'] == $utilisateur['pseudo']) {
                                echo 'SELECTED';
                            }
                        }
                        echo '>'.$utilisateur['pseudo'].'</option>';
                    }
                    ?>
                    </select>
                    <input type='checkbox' name='sansreponse' id='sansreponse' <?php if (isset($_GET['sansreponse'])) { echo 'checked'; } ?> >
                    <label for='sansreponse'>Sans réponse</label>
                    <input type='submit'><br><br>
                </form>
            </div>


        <?php

        // Récupération des parametres dans l'url et suppresion du parametre du numéro de page 
        $parametres = explode("&",$_SERVER['QUERY_STRING']);
        unset($parametres[0]);
        $parametres = implode("&",$parametres);

        // Pagination
        if (isset($_GET['pagenb'])) {
            $pagenb = $_GET['pagenb'];
        } else {
            $pagenb = 1;
        }

        $debut = ($pagenb-1) * $nbParPages;
        
        

        // Si l'utilisateur n'est pas admin
        if ($_SESSION['session_idusertype'] == 3) {
            $sqlNbQuestion = 'SELECT count(*) FROM faq, user WHERE faq.ID_user = user.ID_user ';
        } else {
            $sqlNbQuestion = 'SELECT count(*) FROM faq , user, ligue WHERE faq.ID_user = user.ID_user AND user.ID_ligue = ligue.ID_ligue AND user.id_ligue = '.$_SESSION['session_idligue'].' ';
        }

        // Si une recheche a été effectué
        if (isset($_GET['recherche'])) {
            $sqlNbQuestion .= 'AND question LIKE "%'.$_GET['recherche'].'%" ';
        }
        
        // Si 'Sans réponse' a été coché
        if (isset($_GET['sansreponse'])) {
            $sqlNbQuestion .= "AND reponse = '' ";
        }

        // Si un utilisateur a été choisi
        if (isset($_GET['triutilisateur'])) {
            if (!($_GET['triutilisateur'] == 'tous')) {
                $sqlNbQuestion .= 'AND pseudo = "'.$_GET['triutilisateur'].'" ';
            }
        }


        $sth = $dbh->prepare($sqlNbQuestion);
        $sth->execute(array());
        $nbQuestion = $sth->fetch(PDO::FETCH_ASSOC);
        $nbTotalPagesAfficher = ceil($nbQuestion['count(*)'] / $nbParPages);
        // Fin bloc pagination


        // Redirection si l'on essaye d'acceder à un indice de page vide
        if ($pagenb > $nbTotalPagesAfficher && $pagenb > 1) {
            header('location: faq.php');
        } 

        
        // Connexion + execution de la requête
        try {
            // Si l'utilisateur est un superadmin = affichage de toutes les questions, sinon en fonction de la ligue de l'utilisateur
            if (($_SESSION['session_idusertype'] == 3)) {
                $sql = 'SELECT id_faq, question, reponse, user.id_user, lib_ligue, pseudo, dat_question FROM faq, user, ligue WHERE faq.ID_user = user.ID_user AND user.ID_ligue = ligue.ID_ligue ';
            } else {
                $sql = 'SELECT id_faq, question, reponse, user.id_user, lib_ligue, pseudo, dat_question FROM faq, user, ligue where faq.id_user = user.id_user AND user.ID_ligue = ligue.ID_ligue AND user.id_ligue = '.$_SESSION['session_idligue'].' ';
            }
             
            // Si 'Sans réponse' a été coché
            if (isset($_GET['sansreponse'])) {
                $sql .= "AND reponse = '' ";
            }
            
            // Si une recheche a été effectué
            if (isset($_GET['recherche'])) {
                $sql .= 'AND question LIKE "%'.$_GET['recherche'].'%"';
            }

            // Si un utilisateur a été choisi
            if (isset($_GET['triutilisateur'])) {
                if (!($_GET['triutilisateur'] == 'tous')) {
                    $sql .= 'AND pseudo = "'.$_GET['triutilisateur'].'" ';
                }
            }

            // Si un tri par colonne a été effectué
            if (isset($_GET['tri'])) {
                if ($_GET['tri'] == 'nr') {
                    $sql = $sql." ORDER BY id_faq ASC ";
                } 
                elseif ($_GET['tri'] == 'question') {
                    $sql = $sql." ORDER BY question ASC ";
                } 
                elseif ($_GET['tri'] == 'reponse') {
                    $sql = $sql." ORDER BY reponse ASC ";
                } 
                elseif ($_GET['tri'] == 'ligue') {
                    $sql = $sql." ORDER BY lib_ligue ASC ";
                } 
                elseif ($_GET['tri'] == 'auteur') {
                    $sql = $sql." ORDER BY pseudo ASC ";
                } 
                elseif ($_GET['tri'] == 'date') {
                    $sql = $sql." ORDER BY dat_question ASC ";
                } 
                elseif ($_GET['tri'] == 'nrdesc') {
                    $sql = $sql." ORDER BY id_faq DESC ";
                } 
                elseif ($_GET['tri'] == 'questiondesc') {
                    $sql = $sql." ORDER BY question DESC ";
                } 
                elseif ($_GET['tri'] == 'reponsedesc') {
                    $sql = $sql." ORDER BY reponse DESC ";
                } 
                elseif ($_GET['tri'] == 'liguedesc') {
                    $sql = $sql." ORDER BY lib_ligue DESC ";
                } 
                elseif ($_GET['tri'] == 'auteurdesc') {
                    $sql = $sql." ORDER BY pseudo DESC ";
                } 
                elseif ($_GET['tri'] == 'datedesc') {
                    $sql = $sql." ORDER BY dat_question DESC ";
                }
            }

            // Nombre limité de questions affichées par page
            $sql .= ' LIMIT '.$debut.', '.$nbParPages.'';
            
            $sth = $dbh->prepare($sql);
            $sth->execute(array());
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);

            // Si la requete ne renvoie rien, pas d'affichage du <table>
            if (count($rows) == 0) {
                echo '<p>Aucun résultats</p>';
            } else {

                // Affichage de l'entête du tableau suivant l'utilisateur (admin ou user)

                ?>
                <tr>
                <th><a href='<?php echo '?pagenb=1'; if(isset($_GET['tri'])) { if($_GET['tri'] == 'nr') { echo '&tri=nrdesc'; } } else { echo '&tri=nr'; } if(isset($_GET['recherche'])) { echo '&recherche='.$_GET['recherche']; }?>'>Nr</a></th>
                <th><a href='<?php echo '?pagenb=1'; if(isset($_GET['tri'])) { if($_GET['tri'] == 'question') { echo '&tri=questiondesc'; } } else { echo '&tri=question'; } if(isset($_GET['recherche'])) { echo '&recherche='.$_GET['recherche']; }?>'>Question</a></th>
                <th><a href='<?php echo '?pagenb=1'; if(isset($_GET['tri'])) { if($_GET['tri'] == 'reponse') { echo '&tri=reponsedesc'; } } else { echo '&tri=reponse'; } if(isset($_GET['recherche'])) { echo '&recherche='.$_GET['recherche']; }?>'>Réponse</a></th>
                <th><a href='<?php echo '?pagenb=1'; if(isset($_GET['tri'])) { if($_GET['tri'] == 'ligue') { echo '&tri=liguedesc'; } } else { echo '&tri=ligue'; } if(isset($_GET['recherche'])) { echo '&recherche='.$_GET['recherche']; }?>'>Ligue</a></th>
                <th><a href='<?php echo '?pagenb=1'; if(isset($_GET['tri'])) { if($_GET['tri'] == 'auteur') { echo '&tri=auteurdesc'; } } else { echo '&tri=auteur'; } if(isset($_GET['recherche'])) { echo '&recherche='.$_GET['recherche']; }?>'>Auteur</a></th>
                <th><a href='<?php echo '?pagenb=1'; if(isset($_GET['tri'])) { if($_GET['tri'] == 'date') { echo '&tri=datedesc'; } } else { echo '&tri=date'; } if(isset($_GET['recherche'])) { echo '&recherche='.$_GET['recherche']; }?>'>Date</a></th>
                <?php if ($_SESSION['session_idusertype'] == 2 || $_SESSION['session_idusertype'] == 3) { ?>
                <th>&nbsp</th>
                <?php } ?>
                </tr>
                <?php

                // Affichage des questions
                foreach ($rows as $row) {
                    echo "<tr><td>" . $row["id_faq"] . " </td><td> " . $row["question"] . " </td><td> " . $row["reponse"] . "<td>" . $row['lib_ligue'] . "</td><td>" . $row['pseudo'] . "</td><td>" . $row['dat_question'] . "</td>";

                    // Si l'utilisateur est un admin, affichage des bouton edit et delete
                    if ($_SESSION['session_idusertype'] == 2 || $_SESSION['session_idusertype'] == 3) {
                        echo "</td><td>"."<a href='edit.php?id=".$row['id_faq']."'><img src='ico/icons/pencil.png'><a href='delete.php?id=".$row['id_faq']."'><img src='ico/icons/delete.png'></td>";
                    } else {
                        echo "</td>";
                    }
                    echo '</tr>';
                }
                echo "</table>";
                ?>
                <div class=navigation>
                    <ul>
    
                        <?php if ($pagenb > 3) { ?>
                        <li><a href="<?php echo 'faq.php?pagenb=1&'.$parametres; ?>"><?php echo 1; ?></a></li>
                        <?php } ?>
                        <?php if ($pagenb > 2) { ?>
                        <li><a href="<?php echo 'faq.php?pagenb='.($pagenb-2).'&'.$parametres; ?>"><?php echo $pagenb-2; ?></a></li>
                        <?php } ?>
    
                        <?php if ($pagenb > 1) { ?>
                        <li><a href="<?php echo 'faq.php?pagenb='.($pagenb-1).'&'.$parametres; ?>"><?php echo $pagenb-1; ?></a></li>
                        <?php } ?>
    
                        <li><a href="<?php echo 'faq.php?pagenb='.$pagenb; ?>" style='background-color: #337ab7';><?php echo $pagenb; ?></a></li>
            
    
                        <?php if ($pagenb + 1 <= $nbTotalPagesAfficher) { ?>
                        <li><a href="<?php echo 'faq.php?pagenb='.($pagenb+1).'&'.$parametres; ?>"><?php echo $pagenb+1; ?></a></li>
                        <?php } ?>
    
                        <?php if ($pagenb + 2 <= $nbTotalPagesAfficher) { ?>
                        <li><a href="<?php echo 'faq.php?pagenb='.($pagenb+2).'&'.$parametres ?>"><?php echo $pagenb+2; ?></a></li>
                        <?php } ?>
    
                        <?php if ($pagenb + 3 <= $nbTotalPagesAfficher) { ?>
                        <li><a href="<?php echo 'faq.php?pagenb='.($nbTotalPagesAfficher).'&'.$parametres ?>"><?php echo $nbTotalPagesAfficher; ?></a></li>
                        <?php } ?>
                            
    
                    </ul>
                    <?php echo '<p>Page : '.$pagenb; ?>
                </div>
                    <?php
            }
        } catch(Exception $e) {
            die('Erreur :'.$e->getMessage());
            echo '<p>marche pas</p>';
        }

    }

   ?>         
