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

    function __construct($refSuivi = NULL, $premierContact = NULL, $relance = NULL, $reponse = NULL, $numEditeur =NULL) {
        if (!is_null($refSuivi) && !is_null($premierContact) && !is_null($relance) && !is_null($reponse) && !is_null($numEditeur)){
         $this->refSuivi = $refSuivi;
         $this->premierContact = $premierContact;
         $this->relance = $relance;
         $this->reponse = $reponse;
         $this->numEditeur = $numEditeur;
     }
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
    public static function getSuivis() {
        $sql = "SELECT * FROM suivi";
        $req = Model::$pdo->query($sql);
        $tab = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelSuivi');
        if (empty($tab)) {
            return false;
        }
        return $tab;
        
    }
    public static function getSuivisByReponse() {
        $sql = "SELECT * FROM suivi ORDER BY reponse";
        $req = Model::$pdo->query($sql);
        $tab = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelSuivi');
        if (empty($tab)) {
            return false;
        }
        return $tab;
        
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

    public function updated($ref) {
        $sql = "UPDATE suivi SET  premierContact =:read2, relance =:read3, reponse =:read4, numEditeur =:read6 WHERE refSuivi=:read5";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read2" => $this->premierContact,
            "read3" => $this->relance,
            "read4" => $this->reponse,
            "read6" => $this->numEditeur,
            "read5" => $ref,
        );
        return $req->execute($values);
    }

    public function getNbSuivis() {

        $sql = "SELECT COUNT(*) AS totalSuivis FROM suivi";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCH();


        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }
    
    
}
    