<?php

require_once File::build_path(array('model', 'Model.php'));

class ModelZone {

    private $numZone;
    private $nomZone;
    private $anneeFestival;

    function getNumZone() {
        return $this->numZone;
    }

    function getNomZone() {
        return $this->nomZone;
    }

    function getAnneeFestival() {
        return $this->anneeFestival;
    }

    function setNomZone($nomZone) {
        $this->nomZone = $nomZone;
    }

    public function __construct($numZone = NULL, $nomZone = NULL, $anneeFestival = NULL) {
        if (!is_null($numZone) && !is_null($nomZone) && !is_null($anneeFestival)) {
            $this->numZone = $numZone;
            $this->nomZone = $nomZone;
            $this->anneeFestival = $anneeFestival;
        }
    }


   
}
