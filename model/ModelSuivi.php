<?php

require_once File::build_path(array('model', 'Model.php'));


class ModelSuivi {

    private $refSuivi;
    private $premierContact;
    private $relance;
    private $reponse;
    private $numEditeur;

    function getRefSuivi() {
        return $this->refSuivi;
    }

    function getPremierContact() {
        return $this->premierContact;
    }

    function getRelance() {
        return $this->relance;
    }

    function getReponse() {
        return $this->reponse;
    }

    function getNumEditeur() {
        return $this->numEditeur;
    }

    function __construct($refSuivi, $premierContact, $relance, $reponse, $numEditeur) {
        $this->refSuivi = $refSuivi;
        $this->premierContact = $premierContact;
        $this->relance = $relance;
        $this->reponse = $reponse;
        $this->numEditeur = $numEditeur;
    }

    
    public static function getSuivisByEditeur($numE) {
        $sql = "SELECT * FROM suivi WHERE numEditeur =:read1";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read1" => $numE,
        );
        $req->execute($values);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelSuivi');
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
        
    }
    
   public function save() {

        try {
            $sql = "INSERT INTO suivi (refSuivi,premierContact,relance, reponse, numEditeur) VALUES (:ref, :premier, :relance, :reponse, :num)";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'ref' => $this->refSuivi,
                'premier' => $this->premierContact,
                'relance' => $this->relance,
                'reponse' => $this->reponse,
                'num' => $this->numEditeur,
                
            );
            return $req->execute($values);
        } catch (PDOException $e) {
            return false;
        }
    }
    
     public function deleteByRef($ref) {
        try {
            $sql = "DELETE FROM suivi WHERE refSuivi =:read1";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'read1' => $ref,
            );
            $req->execute($values);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    
    
    
}
    