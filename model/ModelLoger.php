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

     public function save() {

        try {
            $sql = "INSERT INTO loger (numResa,numLogement,places, frais) VALUES (:num, :numL, :places, :frais)";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'num' => $this->numResa,
                'numL' => $this->numLogement,
                'places' => $this->places,
                'frais' => $this->frais,
                
            );
            return $req->execute($values);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteByNumResa($numResa) {
        try {
            $sql = "DELETE FROM loger WHERE numResa =:read1";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'read1' => $numResa,
            );
            $req->execute($values);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

     public function deleteByNumLog($numL) {
        try {
            $sql = "DELETE FROM loger WHERE numLogement =:read1";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'read1' => $numL,
            );
            $req->execute($values);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updated($num) {
        $sql = "UPDATE loger SET  numLogement =:read2, places =:read3, frais =:read4 WHERE numResa=:read5";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read2" => $this->numLogement,
            "read3" => $this->places,
            "read4" => $this->frais,
            "read5" => $num,
        );
        return $req->execute($values);
    }
   
}
