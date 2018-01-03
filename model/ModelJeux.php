<?php

require_once File::build_path(array('model', 'Model.php'));

class ModelJeux {

    private $numJeux;
    private $nomJeu;
    private $nbJoueurs;
    private $dateSortie;
    private $dureePartie;
    private $codeCategorie;
    private $numEditeur;

    function getnumJeu() {
        return $this->numJeux;
    }

    function getNomJeu() {
        return $this->nomJeu;
    }

    function getNbjoueurs() {
        return $this->nbJoueurs;
    }

    
    function getdateSortie() {
        return $this->dateSortie;
    }

    function getdureePartie() {
        return $this->dureePartie;
    }

    function getcodeCategorie() {
        return $this->codeCategorie;
    }

    function getnumEditeur() {
        return $this->numEditeur;
    }

    public function construct($num = NULL, $nom = NULL, $nbjoueurs = NULL, $dates = NULL, $duree = NULL, $categorie = NULL, $editeur = NULL) {
        if (!is_null($num) && !is_null($nom) && !is_null($nbjoueurs) && !is_null($dates) && !is_null($duree) && !is_null($categorie) && !is_null($editeur)) {
            $this->numJeux = $num;
            $this->nomJeu = $nom;
            $this->nbJoueurs= $nbjoueurs;
            $this->dateSortie = $dates;
            $this->dureePartie = $duree;
            $this->codeCategorie = $categorie;
            $this->numEditeur = $editeur;
        }
    }

    public function getAllJeux() {
        $sql = "SELECT * FROM jeux";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelJeux');
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }

    public function getNbJeux() {
        $sql = "SELECT COUNT(*) AS totalJeux FROM jeux";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCH();
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }

    public function getJeuxByEditor($editeur) {
        $sql = "SELECT * FROM jeux WHERE numEditeur=:read1";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read1" => $editeur,
        );
        $req->execute($values);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelJeux');
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }
     public function getJeuByNum($n) {
        $sql = "SELECT * FROM jeux WHERE nomJeu=:read1";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read1" => $n,
        );
        $req->execute($values);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelJeux');
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }
    

    public function save() {
        try {
            $sql = "INSERT INTO jeux (numJeux, nomJeu, NbreJoueurs, dateSortie, dureePartie, codeCategorie, numEditeur) VALUES (:num, :nom, :nbjoueurs, :dates, :duree, :categorie, :editeur) ";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'num' => $this->numJeux,
                'nom' => $this->nomJeu,
                'nbjoueurs' => $this->NbreJoueurs,
                'dates' => $this->dateSortie,
                'duree' => $this->dureePartie,
                'categorie' => $this->codeCategorie,
                'editeur' => $this->numEditeur
            );
            return $req->execute($values);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteByNum($num) {
        try {
            $sql = "DELETE FROM jeux WHERE numEditeur =:read1";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'read1' => $num,
            );
            $req->execute($values);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updated($num) {
        $sql = "UPDATE jeux SET  nomJeu =:read2, nbjoueurs =:read3, dates =:read4, duree =:read6, categorie =:read7, editeur =:read8 WHERE numJeux=:read5";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read2" => $this->nomJeu,
            "read3" => $this->NbreJoueurs,
            "read4" => $this->dateSortie,
            "read6" => $this->dureePartie,
            "read7" => $this->codeCategorie,
            "read8" => $this->numEditeur,
            "read5" => $num,
        );
        return $req->execute($values);
    }

    public static function getNbreJeux() {
        $sql = "SELECT COUNT(numJeux) FROM jeux ";
        $req = Model::$pdo->query($sql);
        $res = $req->fetchColumn();
        return $res;
    }

    /* permet affichage des jeux qui vont être recu sur la page d'accueil */

    public static function getJeuxConcern() {
        $sql = "SELECT numJeux FROM concerner WHERE recu=0 LIMIT 0,5";
        $req = Model::$pdo->query($sql);
        $tab = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelJeux');
        if (empty($tab)) {
            return false;
        }
        return $tab;
    }

    public static function getJeuxARecevoir($numJ) {
        $sq2 = "SELECT nomJeu FROM jeux WHERE numJeux=" . $numJ;
        $req2 = Model::$pdo->query($sq2);
        $res = $req2->fetchColumn();
        return $res;
    }

    public static function getJeuxRecuEd($numJ) {
        $sq2 = "SELECT numEditeur FROM jeux WHERE numJeux=" . $numJ;
        $req2 = Model::$pdo->query($sq2);
        $res = $req2->fetchColumn();
        return $res;
    }

    public static function getEditJeux($numE) {
        $sq2 = "SELECT nomEditeur FROM editeur WHERE numEditeur=" . $numE;
        $req2 = Model::$pdo->query($sq2);
        $res = $req2->fetchColumn();
        return $res;
    }

}
