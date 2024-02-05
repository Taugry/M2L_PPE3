<?php 

class clubDAO extends DAO {
    
    public function __construct()
    {
        parent::__construct();
    }
  
    public function find($id_club)
    {
        $sql = "select * from club where id_club =:id_club";
        try {
            $params = array(":id_club" => $id_club);
            $sth=$this->executer($sql, $params);
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $club=null;
        if ($row) {
            $club = new Club($row);
        }
        return $club;
    } // function find()

    public function findclub()
    {
        $sql = "select lib_club from club";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;
    } // function findclub()

    public function findtheID($lib)
    {
        $sql = "SELECT id_club FROM club WHERE lib_club=:lib";
        try {
            $params = array(":lib" => $lib);
            $sth=$this->executer($sql, $params);
            $res = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $res;
    } // function findtheID()

    public function findnb($id)
    {
        $sql = "select count(*) from club where id_ligue = :id";
        try {
            $params = array(":id" => $id);
            $sth=$this->executer($sql, $params);
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $row;
    }


    public function findAll()
    {
        $sql = "select * from club";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;        
    } // function findAll()

    
    public function insert($club)
    {
        $sql = "INSERT INTO club(`lib_club`, `adr1_club`, `adr2_club`,`adr3_club`,`id_ligue`) 
        values (:libc, :adr1, :adr2, :adr3, :id)";
        $params = array(
          ":libc" => $club->get_lib_club(),
          ":adr1" => $club->get_adr1(),
          ":adr2" => $club->get_adr2(),
          ":adr3" => $club->get_adr3(),
          ":id"   => $club->get_ligue()
        );
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    } // insert()


public function update($club)
{           
    $sql = "UPDATE  club SET lib_club=:libc, adr1_club=:adr1, adr2_club=:adr2, adr3_club=:adr3 WHERE id_club=:id";
    $params = array(
        ":libc" => $club->get_lib_club(),
        ":adr1" => $club->get_adr1(),
        ":adr2" => $club->get_adr2(),
        ":adr3" => $club->get_adr3(),
        ":id"   => $club->get_id_club()
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
        $sql = "DELETE FROM club WHERE id_club=:id";
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