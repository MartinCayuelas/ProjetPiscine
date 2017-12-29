<?php

require_once File::build_path(array('model', 'Model.php'));

class ModelContact {

    private $NumContact;
    private $NomContact;
    private $PrenomContact;
    private $NumTelContact;
    private $MailContact;
    private $NumEditeur;

    function getNumContact() {
        return $this->NumContact;
    }

    function getNomContact() {
        return $this->NomContact;
    }

    function getPrenomContact() {
        return $this->PrenomContact;
    }

    function getNumTelContact() {
        return $this->NumTelContact;
    }

    function getMailContact() {
        return $this->MailContact;
    }

    function getNumEditeur() {
        return $this->NumEditeur;
    }

    function __construct($NumContact = NULL, $NomContact = NULL, $PrenomContact = NULL, $NumTelContact = NULL, $MailContact = NULL, $NumEditeur = NULL) {
        if (!is_null($NumContact) && !is_null($NomContact) && !is_null($PrenomContact) && !is_null($NumTelContact) && !is_null($MailContact) && !is_null($NumEditeur)) {

            $this->NumContact = $NumContact;
            $this->NomContact = $NomContact;
            $this->PrenomContact = $PrenomContact;
            $this->NumTelContact = $NumTelContact;
            $this->MailContact = $MailContact;
            $this->NumEditeur = $NumEditeur;
        }
    }

    public static function getAllContactByNum($num) {
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
                'num' => $this->NumContact,
                'nom'=> $this->NomContact,
                'prenom'=> $this->PrenomContact,
                'tel'=> $this->NumTelContact,
                "mail"=> $this->MailContact,
                'numE' => $this->NumEditeur,
                
                
                
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
        $sql = "UPDATE editeur SET  nomContact =:nom, prenomContact =:prenom, numTelContact =:tel, mailContact =:mail, numEditeur =: numE WHERE numContact=:num";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            'num' => $num,
                'nom'=> $this->NomContact,
                'prenom'=> $this->PrenomContact,
                'tel'=> $this->NumTelContact,
                "mail"=> $this->MailContact,
                'numE' => $this->NumEditeur,
        );
        return $req->execute($values);
    }


}
