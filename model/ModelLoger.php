<?php

require_once File::build_path(array('model', 'Model.php'));

class ModelLoger {

    private $numResa;
    private $numLogement;
    private $places;
    private $frais;

    function getNumResa() {
        return $this->numResa;
    }

    function getNumLogement() {
        return $this->numLogement;
    }

    function getPlaces() {
        return $this->places;
    }

    function getFrais() {
        return $this->frais;
    }

    function setPlaces($places) {
        $this->places = $places;
    }

    function setFrais($frais) {
        $this->frais = $frais;
    }

    public function __construct($numResa = NULL, $numLogement = NULL, $places = NULL, $frais = NULL) {
        if (!is_null($numResa) && !is_null($numLogement) && !is_null($places) && !is_null($frais)) {
            $this->numResa = $numResa;
            $this->numLogement = $numLogement;
            $this->places = $places;
            $this->frais = $frais;
        }
    }


   
}
