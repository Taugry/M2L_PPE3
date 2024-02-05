<?php

class UserDAO extends DAO
{
  
  /**
  * Constructeur
  */
    public function __construct()
    {
        parent::__construct();
    }
  
    public function find($mail)
    {
        $sql = "select * from utilisateur where email_util= :mail";
        try {
            $params = array(":mail" => $mail);
            $sth=$this->executer($sql, $params);
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $user=null;
        if ($row) {
            $user = new User($row);
        }
        return $user;
    } // function find()

    public function findmdp($mail)
    {
        $sql = "select password_util from utilisateur where email_util= :mail";
        try {
            $params = array(":mail" => $mail);
            $sth=$this->executer($sql, $params);
            $rows = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        foreach($rows as $row)
            $res = $row;
        return $res;
    } // function findmdp()

    public function findDisabled()
    {
        $sql = "select * from utilisateur where is_disabled=0";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;
    } // function findDisabled()

    public function finduser()
    {
        $sql = "select email_util from utilisateur where is_disabled=0";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;
    } // function finduser()
  
    public function findAll()
    {
        $sql = "select * from utilisateur";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $users = array();
        foreach ($rows as $row) {
            $users[] = new user($row);
        }
        return $users;
    } // function findAll()

    public function insert($user)
    {
        $sql = "INSERT INTO utilisateur(`email_util`, `password_util`, `nom_util`, `prenom_util`, `matricule_cont`, `id_type_util`,`is_disabled`) 
        values (:email, :mdp, :nom, :prenom, :matricule, :typeutil, 0)";
        $params = array(
          ":email" => $user->get_email(),
          ":mdp" => $user->get_mdp(),
          ":nom" => $user->get_nom(),
          ":prenom" => $user->get_prenom(),
          ":matricule" => $user->get_matricule(),
          ":typeutil" => $user->get_typeutil()
        );
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    } // insert()

  
    public function update($user)
    {           
        $sql = "UPDATE  utilisateur SET nom_util=:nom, prenom_util=:prenom, matricule_cont=:matricule,statut_util=:statut, id_type_util=:typeutil WHERE email_util=:email";
        $params = array(
          ":email" => $user->get_email(),
          ":nom" => $user->get_nom(),
          ":prenom" => $user->get_prenom(),
          ":matricule" => $user->get_matricule(),
          ":statut" => $user->get_statut(),
          ":typeutil" => $user->get_typeutil()
        );
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    } // update()

    public function Disabled($mail)
    {           
        $sql = "UPDATE utilisateur SET is_disabled = 1 WHERE email_util = :email";
        $params = array(":email" => $mail);
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    } // update()


    public function delete($mail)
    {
        $sql = "DELETE FROM utilisateur WHERE email_util= :mail";
        $params = array(":mail" => $mail);
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    }

    /* @author Luc Dehez*/
    public function findUsersAvecLdfActive()
    { //retourne les utilisateurs avec au moins une ldf sur la période active
        $sql = "SELECT * from utilisateur 
        WHERE email_util IN (SELECT DISTINCT 
                            email_util 
                            from ligne_de_frais 
                            WHERE annee_per = (SELECT annee_per from periode WHERE statut_per = 0))";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $utilisateurs = array();
        foreach ($rows as $row) { //hydrateur
            $utilisateurs[] = $row;
        }
         return $utilisateurs;
        }
} // Class UserDAO
