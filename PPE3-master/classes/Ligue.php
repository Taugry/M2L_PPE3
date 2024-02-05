<?php 

class Ligue{

   private $id_ligue;
   private $lib_ligue;
   private $URL_ligue;
   private $contact_ligue;
   private $telephone_ligue;
   private $email_util;

    
   public function __construct(array $tableau = null)
   {
       if ($tableau != null) {
           $this->fill($tableau);
       }
   }

////////////////getter////////////////
   function get_id_ligue() {
     return $this->id_ligue;
   }

   function get_lib_ligue() {
    return $this->lib_ligue;
  }

   function get_URL_ligue() {
     return $this->URL_ligue;
   }

   function get_contact_ligue() {
     return $this->contact_ligue;
   }

   function get_telephone_ligue() {
     return $this->telephone_ligue;
   }

   function get_email_util() {
    return $this->email_util;
  }

////////////////setter////////////////
   function set_id_ligue($id) {
     $this->id_ligue = $id;
   }

   function set_lib_ligue($lib) {
     $this->lib_ligue = $lib;
   }

   function set_URL_ligue($URL) {
     $this->URL_ligue = $URL;
   }

   function set_contact_ligue($contact) {
     $this->contact_ligue = $contact;
   }

   function set_telephone_ligue($tel) {
     $this->telephone_ligue = $tel;
   }

   function set_email_util($mail) {
    $this->email_util = $mail;
  }

////////////////Hydrateur////////////////
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