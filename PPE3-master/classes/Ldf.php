<?php 

class Ldf {  //ligne de frais

   private $id_ldf;
   private $date_ldf;
   private $lib_trajet_ldf;
   private $cout_peage_ldf;
   private $cout_repas_ldf;
   private $cout_hebergement_ldf;
   private $nb_km_ldf;
   private $total_km_ldf;
   private $total_ldf;
   private $id_mdf; // id motif de frais
   private $annee_per;
   private $email_util;


    
   public function __construct(array $tableau = null)
   {
       if ($tableau != null) {
           $this->fill($tableau);
       }
   }

/////////////getter/////////////////
   function get_id() {
     return $this->id_ldf;
   }

   function get_date() {
    return $this->date_ldf;
  }

    function get_lib() {
     return $this->lib_trajet_ldf;
    }

  function get_coutp() {
    return $this->cout_peage_ldf;
  }

  function get_coutr() {
    return $this->cout_repas_ldf;
  }

  function get_couth() {
    return $this->cout_hebergement_ldf;
  }
  function get_nbkm() {
    return $this->nb_km_ldf;
  }
  function get_tkm() {
    return $this->total_km_ldf;
  }

  function get_tldf() {
    return $this->total_ldf;
  }

  function get_idmdf() {
    return $this->id_mdf;
  }

  function get_anneeper() {
    return $this->annee_per;
  }

  function get_email() {
    return $this->email_util;
  }


/////////////////////setter///////////////

    function set_id($id_ldf) {
        return $this->id_ldf= $id_ldf;
    }

    function set_date($date) {
        return $this->date_ldf = $date;
    }

    function set_lib($lib) {
        return $this->lib_trajet_ldf= $lib;
    }

    function set_coutp($cpeage) {
        return $this->cout_peage_ldf= $cpeage ;
    }

    function set_coutr($crepas) {
        return $this->cout_repas_ldf= $crepas ;
    }

    function set_couth($cheberge) {
        return $this->cout_hebergement_ldf = $cheberge ;
    }
    function set_nbkm($nbkm) {
        return $this->nb_km_ldf = $nbkm ;
    }
    function set_tkm($tnbkm) {
        return $this->total_km_ldf = $tnbkm ;
    }

    function set_tldf($tldf) {
        return $this->total_ldf = $tldf;
    }

    function set_idmdf($motiff) {
        return $this->id_mdf = $motiff;
    }

    function set_anneeper($periode) {
        return $this->annee_per = $periode;
    }

    function set_email($util) {
       $this->email_util = $util;
    }


////////////////Hydrateur///////////////////////
   public function fill(array $tableau)
   {
       foreach ($tableau as $cle => $valeur) {
           $methode = 'set_' . $cle;
           if (method_exists($this, $methode)) {
               $this->$methode($valeur);
           }
       }
   }


   public function dump()
   {
       return get_object_vars($this);
   }


   public function afficher()
   {
       $tableau = $this->dump();
       $html = '<ul>';
       foreach ($tableau as $cle=>$valeur) {
           $html .= '<li>' . $cle . ' = '.$valeur. '</li>';
       }
       $html .= '</ul>';
       return $html;
   }
}

?>