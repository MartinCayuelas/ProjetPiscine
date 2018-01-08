<?php

require_once File::build_path(array('model', 'Model.php'));

class ModelReservation {

    private $numResa;
    private $numJeux;
    private $nbJeux;
    private $recu;
    private $retour;
    private $don;

    function getNumResa() {
        return $this->numResa;
    }

    function getNumJeux() {
        return $this->numJeux;
    }

    function getnbJeux() {
        return $this->nbJeux;
    }

    function getRecu() {
        return $this->recu;
    }

    function getRetour() {
        return $this->retour;
    }

    function getDon() {
        return $this->don;
    }

    function setNbJeux($nbJeux) {
        $this->nbJeux = $nbJeux;
    }

    function setRecuo($recu) {
        $this->recu = $recu;
    }

    function setRetour($retour) {
        $this->retour = $retour;
    }

    function setDon($don) {
        $this->don = $don;
    }

    public function __construct($numResa = NULL, $numJeux = NULL, $nbJeux = NULL, $recu = NULL, $retour = NULL, $don = NULL) {
        if (!is_null($numResa) && !is_null($numJeux) && !is_null($nbJeux) && !is_null($recu) && !is_null($retour) && !is_null($don)) {
            $this->numResa = $numResa;
            $this->numJeux = $numJeux;
            $this->nbJeux = $nbJeux;
            $this->recu = $recu;
            $this->retour = $retour;
            $this->don = $don;
        }
    }


   
}
