<?php

require_once File::build_path(array('model', 'Model.php'));

class ModelConcerner {

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

    function setRecu($recu) {
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

    public function save() {

        try {
            $sql = "INSERT INTO concerner (numResa,numJeux,nbJeux, recu, retour, don) VALUES (:num, :numJ, :nbJ, :recu, :retour, :don)";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'num' => $this->numResa,
                'numJ' => $this->numJeux,
                'nbJ' => $this->nbJeux,
                'recu' => $this->recu,
                'retour' => $this->retour,
                'don' => $this->don,
                
            );
            return $req->execute($values);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteByNumResa($numResa) {
        try {
            $sql = "DELETE FROM concerner WHERE numResa =:read1";
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

     public function deleteByNumJeux($numJ) {
        try {
            $sql = "DELETE FROM concerner WHERE numJeux =:read1";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'read1' => $numJ,
            );
            $req->execute($values);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updated($num) {
        $sql = "UPDATE concerner SET  numJeux =:read2, nbJeux =:read3, recu =:read4, retour =:read6, don= :read7 WHERE numResa=:read5";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read2" => $this->numJeux,
            "read3" => $this->nbJeux,
            "read4" => $this->recu,
            "read6" => $this->retour,
            "read7" => $this->don,
            "read5" => $num,
        );
        return $req->execute($values);
    }

   
}
