<?php

require_once File::build_path(array('model', 'Model.php'));

class ModelLocaliser {

    private $numZone;
    private $numResa;
    private $nbPlace;

     function getNumZone() {
        return $this->numZone;
    }

    function getNumResa() {
        return $this->numResa;
    }

    function getNbPlace() {
        return $this->nbPlace;
    }

    
    function setNbPlace($places) {
        $this->nbPlace = $places;
    }


    public function __construct( $numZone = NULL,$numResa = NULL, $nbPlace = NULL) {
        if (!is_null($numZone) &&!is_null($numResa) &&  !is_null($nbPlace)) {
           $this->numZone = $numZone;
            $this->numResa = $numResa;
            $this->nbPlace = $nbPlace;
        }
    }

     public function save() {

        try {
            $sql = "INSERT INTO localiser (numZone,numResa,nbPlace) VALUES (:numZ, :numR, :place)";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'numZ' => $this->numZone,
                'numR' => $this->numResa,
                'place' => $this->nbPlace,
                
            );
           
            return $req->execute($values);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteByNumResa($numResa) {
        try {
            $sql = "DELETE FROM localiser WHERE numResa =:read1";
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

     public function deleteByNumZ($numZ) {
        try {
            $sql = "DELETE FROM localiser WHERE numZone =:read1";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'read1' => $numZ,
            );
            $req->execute($values);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updated($num) {
        $sql = "UPDATE localiser SET  numZone =:read2, nbPlace =:read3 WHERE numResa=:read5";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read2" => $this->numZone,
            "read3" => $this->nbPlace,
            "read5" => $num,
        );
        return $req->execute($values);
    }

    public function getAllLocaliser() {
        $sql = "SELECT * FROM localiser";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelLocaliser');
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }

      public function getPlaceLocaliser() {
        $sql = "SELECT nbPlace FROM localiser";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelLocaliser');
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }
   
}
