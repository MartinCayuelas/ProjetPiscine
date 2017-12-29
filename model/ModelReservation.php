<?php

require_once File::build_path(array('model', 'Model.php'));

class ModelReservation {

    private $numResa;
    private $dateResa;
    private $comentaire;
    private $prixPlaceNego;
    private $statut;
    private $etatFacture;

    function getNumResa() {
        return $this->numResa;
    }

    function getDateResa() {
        return $this->dateResa;
    }

    function getComentaire() {
        return $this->comentaire;
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

    function setComentaire($comentaire) {
        $this->comentaire = $comentaire;
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

    public function __construct($numResa = NULL, $dateResa = NULL, $comentaire = NULL, $prixPlaceNego = NULL, $statut = NULL, $etatFacture = NULL) {
        if (!is_null($numResa) && !is_null($dateResa) && !is_null($comentaire) && !is_null($prixPlaceNego) && !is_null($statut) && !is_null($etatFacture)) {
            $this->numResa = $numResa;
            $this->dateResa = $dateResa;
            $this->comentaire = $comentaire;
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

}
