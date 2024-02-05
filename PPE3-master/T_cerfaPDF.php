<?php

/***************************
  Sample using a PHP array
****************************/
require_once "init.php";
require_once('fpdf/fpdm/fpdm.php');
require_once "fpdf/fpdf.php";

//$id_mdf = isset($_GET['id_mdf']) ? $_GET['id_mdf']: 0;
$id = isset($_GET['id']) ? $_GET['id']: 0;

$userDAO = new UserDAO;
$user = $userDAO->find($id); //renvoie l'utilisateur concerné
$adhDAO = new AdherentDAO;
$adh = $adhDAO->find($id);
$clubDAO = new ClubDAO;
$club = $clubDAO->find($adh->get_id_club());
$ldfDAO = new LdfDAO;
$ldf = $ldfDAO->findMail($id);
$periodeDAO = new PeriodeDAO;
$per = $periodeDAO->findPeriodeActive();
$motifDAO = new MotifDAO;
$ligueDAO = new LigueDAO;
$ligue = $ligueDAO->find($club->get_ligue());



// Crée le tableau d'objets métier 
$ldfs=array();
$dao = new LdfDAO();
$ldfs = $dao->findMail($id); //renvoie les ldf de l'ultilisateur correspondant

$valeurToutesLettres = new nuts($ldfDAO->totalAdhPerActive($id), "EUR"); //nuts est une classe qui convertit des nombres en caractères

preg_match_all('!\d+!', $club->get_adr1(), $chiffres); //met dans un tableau les chifffres contenue dans l'adresse
$numRue = "";
$rue = $club->get_adr1();
if (count($chiffres)>0){ // si il y a des chiffres
  foreach($chiffres[0] as $key => $value){
    $numRue .= $value; // on rajoute les chiffres dans le numéro de rue
    $rue = str_replace($numRue, "",$rue); // on enleve le numéro de rue de l'adresse complete
  }
}

$fields = array(
    'z1'    => $per->get_annee().$club->get_id_club(),
    'z2'    => $club->get_lib_club(), //remplace les champs avec les valeurs
    'Z3'    => $numRue,
    'z4'    => $rue,
    'z5'    => $club->get_adr2(),
    'z5b'    => $club->get_adr3(),
    'z6'    => "Club de ".$ligue->get_lib_ligue(),
    'z29'    => $user->get_nom(),
    'z30'    => $user->get_prenom(),
    'z31'    => $adh->get_adr1(),
    'z32'    => $adh->get_adr2(),
    'z33'    => $adh->get_adr3(),
    'z34'    => $ldfDAO->totalAdhPerActive($id),
    'z35'    => $valeurToutesLettres->convert("fr-FR"),
    'z36'    => date("d"),
    'z37'    => date("m"),
    'z38'    => date("yyyy"),
    'z52'    => date("d"),
    'z53'    => date("m"),
    'z54'    => date("yyyy")
);

$pdf = new FPDM('fpdf/fpdm/src/test2.pdf');
$pdf->mon_fichier="CERFA.pdf";
$pdf->useCheckboxParser = true; //gestion des checkbox
$pdf->Load($fields, true); // second parameter: false if field values are in ISO-8859-1, true if UTF-8
$pdf->Merge();
$pdf->Output('F','outfiles/'.$user->get_nom()."-".$per->get_annee()."-".$pdf->mon_fichier);
header('Location: outfiles/'.$user->get_nom()."-".$per->get_annee()."-".$pdf->mon_fichier);
?>