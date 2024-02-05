<?php

class MotifDao extends DAO
{
  
  /**
  * Constructeur
  */
    public function __construct()
    {
        parent::__construct();
    }
  
    public function find($id)
    {
        $sql = "select * from motif_de_frais where id_mdf= :id";
        try {
            $params = array(":id" => $id);
            $sth=$this->executer($sql, $params);
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $motifs=null;
        if ($row) {
            $motif = new Motif($row);
        }
        return $motif;
    } // function find()

    public function findID()
    {
        $sql = "select id_mdf from motif_de_frais";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;
    } // function findID()

    public function findtheID($lib)
    {
        $sql = "SELECT id_mdf FROM motif_de_frais WHERE lib_mdf=:lib";
        try {
            $params = array(":lib" => $lib);
            $sth=$this->executer($sql, $params);
            $rows = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        return $rows;

    } // function findtheID()

    public function findlib()
    {
        $sql = "select lib_mdf from motif_de_frais";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;
    } // function findlib()
  
    public function findAll()
    {
        $sql = "select * from motif_de_frais";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;
    } // function findAll()

    public function insert($motif)
    {
        $sql = "INSERT INTO motif_de_frais(lib_mdf) 
        values (:lib)";
        $params = array(":lib" => $motif);
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    } // insert()

  
    public function update($motif)
    {           
        $sql = "UPDATE  motif_de_frais SET lib_mdf=:lib WHERE id_mdf=:id";
        $params = array(
          ":id" => $motif->get_id(),
          ":lib" => $motif->get_lib()
        );
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    } // update()

    public function delete($id)
    {
        $sql = "DELETE FROM motif_de_frais WHERE id_mdf=:id";
        $params = array(":id" => $id);
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    }

    public function get_lib($id)
    {
        $sql = "SELECT mdf.lib_mdf FROM motif_de_frais mdf, ligne_de_frais ldf 
        WHERE mdf.id_mdf=ldf.id_mdf AND ldf.id_ldf=:id";
        try {
            $params = array(":id" => $id);
            $sth = $this->executer($sql,$params);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;
    }
} // Class MotifDao
