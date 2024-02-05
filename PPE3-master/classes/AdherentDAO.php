<?php 

class AdherentDAO extends DAO {
    
    public function __construct()
    {
        parent::__construct();
    }
  
    public function find($mail)
    {
        $sql = "select * from adherent where email_util =:email_util";
        try {
            $params = array(":email_util" => $mail);
            $sth=$this->executer($sql, $params);
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $adh=null;
        if ($row) {
            $adh = new adherent($row);
        }
        return $adh;
    } // function find()

    public function findidclub()
    {
        $sql = "select id_club from adherent where email_util =:email_util";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;
    } // function findclub()

    public function findnb($id)
    {
        $sql = "select count(*) from adherent where id_club = :id";
        try {
            $params = array(":id" => $id);
            $sth=$this->executer($sql, $params);
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $nb = $row;
        return $nb;
    } // function find()


    public function findAll()
    {
        $sql = "select * from adherent";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;        
    } // function findAll()

    
    public function insert($adh)
    {
        $sql = "INSERT INTO `adherent`(`email_util`, `lic_adh`, `sexe_adh`, `date_naissance_adh`, `adr1_adh`, `adr2_adh`, `adr3_adh`, `id_club`)
        values (:email, :lic, :sx, :dtx, :adr1, :adr2, :adr3, :id)";
        $params = array(
          ":email"  => $adh->get_email_util(),
          ":lic"    => $adh->get_lic_adh(),
          ":sx"     => $adh->get_sexe_adh(),
          ":dtx"    => $adh->get_date(),
          ":adr1"   => $adh->get_adr1(),
          ":adr2"   => $adh->get_adr2(),
          ":adr3"   => $adh->get_adr3(),
          ":id"     => $adh->get_id_club()
        );
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    } // insert()

public function delete($id)
    {
        $sql = "DELETE FROM adherent WHERE email_util=:id";
        $params = array(":id" => $id);
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    }

}//class

?>