<?php

class Periode
{

  // Attributs
    private $annee_per;
    private $forfait_km_per;
    private $statut_per; 

    // Constructeur

    public function __construct(array $tableau = null)
    {
        if ($tableau != null) {
            $this->fill($tableau);
        }
    }

/////////////getter/////////////////
    function get_annee() {
      return $this->annee_per;
    }

    function get_forfait() {
      return $this->forfait_km_per;
    }

    function get_statut() {
      return $this->statut_per;
    }

    public function get_forfait_km_per()
  {
    return $this->forfait_km_per;
  }


/////////////////////setter///////////////
    function set_annee_per($year) {
      $this->annee_per = $year;
    }

    function set_forfait($forfait) {
      $this->forfait_km_per = $forfait;
    }

    function set_statut($stat) {
      $this->statut_per = $stat;
    }

    public function set_forfait_km_per($forfait_km_per)
  {
    $this->forfait_km_per = $forfait_km_per;

    return $this;
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

// Classe Periode
