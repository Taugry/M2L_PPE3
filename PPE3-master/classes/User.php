<?php

class User
{

  // Attributs
    private $email_util;
    private $password_util;
    private $nom_util; 
    private $prenom_util; 
    private $matricule_cont;
    private $statut_util;  
    private $id_type_util; 

    // Constructeur

    public function __construct(array $tableau = null)
    {
        if ($tableau != null) {
            $this->fill($tableau);
        }
    }

/////////////getter/////////////////
    function get_email() {
      return $this->email_util;
    }

    function get_mdp() {
      return $this->password_util;
    }

    function get_nom() {
      return $this->nom_util;
    }

    function get_prenom() {
      return $this->prenom_util;
    }

    function get_matricule() {
      return $this->matricule_cont;
    }

    function get_typeutil() {
      return $this->id_type_util;
    }

    function get_statut() {
      return $this->statut_util;
    }

/////////////////////setter///////////////
    function set_email($mail) {
      $this->email_util = $mail;
    }

    function set_mdp($mdp) {
      $this->password_util = $mdp;
    }

    function set_nom($nom) {
      $this->nom_util = $nom;
    }

    function set_prenom($prenom) {
      $this->prenom_util = $prenom;
    }

    function set_matricule($matricule) {
      $this->matricule_cont = $matricule;
    }

    function set_typeutil($type) {
      $this->id_type_util = $type;
    }

    function set_statut($statut) {
      $this->statut_util = $statut;
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

// Classe User
