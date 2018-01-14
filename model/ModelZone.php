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

    public function getAllZone() {
        $sql = "SELECT * FROM zones";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelZone');
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }
    public function getNbZone() {
        $sql = "SELECT COUNT(*) AS totalZone FROM zones";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCH();
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }
    
    public function save() {
        try {
            $sql = "INSERT INTO zones (numZone,nomZone,anneeFestival) VALUES (:num, :nom, :annee)";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'num' => $this->numZone,
                'nom' => $this->nomZone,
                'annee'=> $this->anneeFestival,
            
            );
            return $req->execute($values);
        } catch (PDOException $e) {
            return false;
        }
    }

   
    public function updated($numZone) {
        $sql = "UPDATE zones SET  numZone =:read1, nomZone =:read2, anneeFestival=:read3";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read1" => $this->numZone,
            "read2" => $this->nomZone,
            "read3"=> $this->anneeFestival,
        );
        return $req->execute($values);
    }
    
    public function deleteByNum($numZone) {
        try {
            $sql = "DELETE FROM zones WHERE numZone =:read1";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'read1' => $numZone,
            );
            $req->execute($values);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getZoneByNom() {
        $sql = "SELECT nomZone FROM zones";
        $req = Model::$pdo->query($sql);
        $tab = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelZone');
        if (empty($tab)) {
            return false;
        }
        return $tab;
    }

    public static function getDerZone(){
        $sql="SELECT numZone FROM zones ORDER BY numzone DESC LIMIT 0,1";
         $req = Model::$pdo->query($sql);
        $res=$req->fetchColumn();
        return $res;
    }

     public static function getNumZoneByNom($nom){
        $sql="SELECT numZone FROM zones WHERE nomZone='".$nom."'";
         $req = Model::$pdo->query($sql);
        $res=$req->fetchColumn();
        return $res;
    }



   
}
