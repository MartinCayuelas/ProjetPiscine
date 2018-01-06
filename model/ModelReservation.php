<?php

require_once File::build_path(array('model', 'Model.php'));

class ModelReservation {

    private $numResa;
    private $dateResa;
    private $commentaire;
    private $prixPlaceNego;
    private $statut;
    private $etatFacture;

    function getNumResa() {
        return $this->numResa;
    }

    function getDateResa() {
        return $this->dateResa;
    }

    function getCommentaire() {
        return $this->commentaire;
    }

    function getPrixPlaceNego() {
        return $this->prixPlaceNego;
    }

    function getStatut() {
        return $this->statut;
    }

    function getEtatFacture() {
        return $this->etatFacture;
    }

    function setCommentaire($commentaire) {
        $this->commentaire = $commentaire;
    }

    function setPrixPlaceNego($prixPlaceNego) {
        $this->prixPlaceNego = $prixPlaceNego;
    }

    function setStatut($statut) {
        $this->statut = $statut;
    }

    function setEtatFacture($etatFacture) {
        $this->etatFacture = $etatFacture;
    }

    public function __construct($numResa = NULL, $dateResa = NULL, $commentaire = NULL, $prixPlaceNego = NULL, $statut = NULL, $etatFacture = NULL) {
        if (!is_null($numResa) && !is_null($dateResa) && !is_null($commentaire) && !is_null($prixPlaceNego) && !is_null($statut) && !is_null($etatFacture)) {
            $this->numResa = $numResa;
            $this->dateResa = $dateResa;
            $this->commentaire = $commentaire;
            $this->prixPlaceNego = $prixPlaceNego;
            $this->statut = $statut;
            $this->etatFacture = $etatFacture;
        }
    }

    public function getAllReservations() {

        $sql = "SELECT * FROM reservation";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelReservation');

        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }

    public static function getTablesReservees() {
        $sql = "SELECT COUNT(numResa) FROM reservation ";
        $req = Model::$pdo->query($sql);
        $res=$req->fetchColumn();
        return $res;
    }

    public function save() {

        try {
            $sql = "INSERT INTO reservation (numResa,dateResa,commentaire, prixPlaceNego, statut,etatFacture) VALUES (:numResa, :dateResa, :commentaire, :prix, :statut, :etatFacture)";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'numResa' => $this->numResa,
                'dateResa' => CURRENT_DATE,
                'commentaire' => $this->commentaire,
                'prix' => $this->prixPlaceNego,
                'statut' => $this->statut,
                'etatFacture' => $this->etatFacture,
                
            );
            return $req->execute($values);
        } catch (PDOException $e) {
            return false;
        }
    }

    /* permet affichage des paiment avenir de la page d'accueil*/

    public static function getPrixFacture(){
        $sql=" SELECT prixPlaceNego, numResa FROM reservation WHERE etatFacture= 'editee' LIMIT 0,5";
        $req = Model::$pdo->query($sql);
        $tab= $req->FETCHALL(PDO::FETCH_CLASS, 'ModelReservation');
        if (empty($tab)) {
            return false;
        }
        return $tab;
    }

    public static function getNumJeux($numResa) {
        $sq2="SELECT numJeux FROM concerner WHERE numResa=".$numResa;
        $req2 = Model::$pdo->query($sq2);
        $res=$req2->fetchColumn();
        return $res;
    }

    public static function getEditeur($numJ) {
        $sq2="SELECT numEditeur FROM jeux WHERE numJeux=".$numJ;
        $req2 = Model::$pdo->query($sq2);
        $res=$req2->fetchColumn();
        return $res;
    }

    public static function getNomEdit($numE) {
        $sq2="SELECT nomEditeur FROM editeur WHERE numEditeur=".$numE;
        $req2 = Model::$pdo->query($sq2);
        $res=$req2->fetchColumn();
        return $res;
    }

   
}
