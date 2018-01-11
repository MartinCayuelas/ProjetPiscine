<?php

require_once File::build_path(array('model', 'Model.php'));

class ModelContact {

    private $numContact;
    private $nomContact;
    private $prenomContact;
    private $numTelContact;
    private $mailContact;
    private $numEditeur;

    function getNumContact() {
        return $this->numContact;
    }

    function getNomContact() {
        return $this->nomContact;
    }

    function getPrenomContact() {
        return $this->prenomContact;
    }

    function getNumTelContact() {
        return $this->numTelContact;
    }

    function getMailContact() {
        return $this->mailContact;
    }

    function getNumEditeur() {
        return $this->numEditeur;
    }

    
    function __construct($NumContact = NULL, $NomContact = NULL, $PrenomContact = NULL, $NumTelContact = NULL, $MailContact = NULL, $NumEditeur = NULL) {
        if (!is_null($NumContact) && !is_null($NomContact) && !is_null($PrenomContact) && !is_null($NumTelContact) && !is_null($MailContact) && !is_null($NumEditeur)) {

            $this->numContact = $NumContact;
            $this->nomContact = $NomContact;
            $this->prenomContact = $PrenomContact;
            $this->numTelContact = $NumTelContact;
            $this->mailContact = $MailContact;
            $this->numEditeur = $NumEditeur;
        }
    }

    public static function getAllContactsByNum($num) {
        $sql = "SELECT * FROM contact WHERE numEditeur=:read1";
        $req = Model::$pdo->prepare($sql);
        $value = array(
            "read1" => $num,
        );
        $req->execute($value);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelContact');
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }
     public function save() {

        try {
            $sql = "INSERT INTO contact (numContact, nomContact, prenomContact,numTelContact,mailContact,numEditeur ) VALUES (:num,:nom,:prenom,:tel,:mail,:numE)";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'num' => $this->numContact,
                'nom'=> $this->nomContact,
                'prenom'=> $this->prenomContact,
                'tel'=> $this->numTelContact,
                "mail"=> $this->mailContact,
                'numE' => $this->numEditeur,
                
                
                
            );
            return $req->execute($values);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteByNum($num) {
        try {
            $sql = "DELETE FROM contact WHERE numContact =:read1";
            $req = Model::$pdo->prepare($sql);
            $value = array(
                'read1' => $num,
            );
            $req->execute($value);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function updated($num) {
        $sql = "UPDATE contact SET  nomContact =:read2, prenomContact =:read3, numTelContact =:read4, mailContact =:read6, numEditeur =:read7 WHERE numContact=:read5";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read2" => $this->nomContact,
            "read3" => $this->prenomContact,
            "read4" => $this->numTelContact,
            "read6" => $this->mailContact,
            "read7" => $this->numEditeur,
            "read5" => $num,
        );
        return $req->execute($values);
    }

   
   public function getNbContactsByEditeur($e) {

         $sql = "SELECT COUNT(*) FROM contact WHERE numEditeur=:read1";
        $req = Model::$pdo->prepare($sql);
        $value = array(
            "read1" => $e,
        );
        $req->execute($value);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelContact');
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }

}
