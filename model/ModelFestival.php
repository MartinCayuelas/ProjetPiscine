
<?php
require_once File::build_path(array('model', 'Model.php'));
class ModelFestival {
    private $anneeFestival;
    private $dateFestival;
    private $nbPlacesFestival;
    private $prixPlaceStdFestival;

    function getAnneeFestival() {
        return $this->anneeFestival;
    }
    function getDateFestival() {
        return $this->dateFestival;
    }
    function getnNbPlacesFestival() {
        return $this->nbPlacesFestival;
    }
    function getPrixPlaceStdFestival() {
        return $this->prixPlaceStdFestival;
    }


    public function __construct($anneef = NULL, $df = NULL, $nbplacesf = NULL, $prixplacestdf = NULL {
        if (!is_null($anneef) && !is_null($df) && !is_null($nbplacesf) && !is_null($prixplacestdf) {
            $this->anneeFestival = $anneef;
            $this->dateFestival = $df;
            $this->nbPlacesFestival = $nbplacesf;
            $this->prixPlacesStdFestival = $prixplacestdf;
             }
            }
    }
    public function getAllFestival() {
        $sql = "SELECT * FROM festival";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelFestival');
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }
    public function getNbFestival() {
        $sql = "SELECT COUNT(*) AS totalFestival FROM festival";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCH();
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }
    
    public function getFestivalById($id) {
        $sql = "SELECT * FROM festival WHERE anneeFestival=:read1";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read1" => $id,
        );
        $req->execute($values);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelFestival');
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }
    public function save() {
        try {
            $sql = "INSERT INTO festival (anneeFestival,dateFestival, nbPlacesFestival, PrixPlaceStdFestival) VALUES (:annee, :date, :nbplaces, :prixplacestd)";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'annee' => $this->anneeFestival,
                'date' => $this->dateFestival,
                'nbplaces' => $this->nbPlacesFestival,
                'prixplacestd' => $this->prixPlaceStdFestival,
                
            );
            return $req->execute($values);
        } catch (PDOException $e) {
            return false;
        }
    }
    public function deleteByNum($id) {
        try {
            $sql = "DELETE FROM festival WHERE anneeFestival =:read1";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'read1' => $id,
            );
            $req->execute($values);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
   
    public function updated($num) {
        $sql = "UPDATE = festival SET  dateFestival =:read2, nbPlacesFestival =:read3, prixPlaceStdFestival =:read4 WHERE anneeFestival=:read7";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read2" => $this->dateFestival,
            "read3" => $this->nbPlacesFestival,
            "read4" => $this->PrixPlaceStdFestival,

        );
        return $req->execute($values);
    }
    
}