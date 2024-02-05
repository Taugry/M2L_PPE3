<?php

class Motif
{

  // Attributs
    private $id_mdf;
    private $lib_mdf;

    // Constructeur

    public function __construct(array $tableau = null)
    {
        if ($tableau != null) {
            $this->fill($tableau);
        }
    }

/////////////getter/////////////////
    function get_id() {
      return $this->id_mdf;
    }

    function get_lib() {
      return $this->lib_mdf;
    }

/////////////////////setter///////////////
    function set_id($id) {
      $this->id_mdf = $id;
    }

    function set_lib($lib) {
      $this->lib_mdf = $lib;
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

// Classe Motif
