<?php 

class Adherent{

   private $email_util;
   private $lic_adh;
   private $sexe_adh;
   private $date_naissance_adh;
   private $adr1_adh;
   private $adr2_adh;
   private $adr3_adh;
   private $id_club;

    
   public function __construct(array $tableau = null)
   {
       if ($tableau != null) {
           $this->fill($tableau);
       }
   }

/////////////getter/////////////////
   function get_email_util() {
     return $this->email_util;
   }

   function get_lic_adh() {
     return $this->lic_adh;
   }

   function get_sexe_adh() {
     return $this->sexe_adh;
   }

   function get_date() {
     return $this->date_naissance_adh;
   }

   function get_adr1() {
     return $this->adr1_adh;
   }

   function get_adr2() {
     return $this->adr2_adh;
   }

   function get_adr3() {
     return $this->adr3_adh;
   }

   function get_id_club() {
    return $this->id_club;
  }


/////////////////////setter///////////////

   function set_email_util($mail) {
     $this->email_util = $mail;
   }

   function set_lic_adh($lic) {
    $this->lic_adh = $lic;
  }

  function set_sexe_adh($sx) {
    $this->sexe_adh = $sx;
  }

  function set_date_naissance_adh($date) {
    $this->date_naissance_adh = $date;
  }

   function set_adr1_adh($adr1) {
     $this->adr1_adh = $adr1;
   }

   function set_adr2_adh($adr2) {
     $this->adr2_adh = $adr2;
   }

   function set_adr3_adh($adr3) {
     $this->adr3_adh = $adr3;
   }

   function set_id_club($id_l) {
    $this->id_club = $id_l;
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