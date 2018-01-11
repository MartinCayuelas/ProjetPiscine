
<?php

require_once File::build_path(array('model', 'Model.php'));

class ModelFestival {

    private $anneeFestival;
    private $dateFestival;
    private $nbTablesFest;
    private $prixPlacesStandard;

    function getAnneeFestival() {
        return $this->anneeFestival;
    }

    function getDateFestival() {
        return $this->dateFestival;
    }

    function getNbTablesFest() {
        return $this->nbTablesFest;
    }

    function getPrixPlacesStandard() {
        return $this->prixPlacesStandard;
    }

    
    public function __construct($anneef = NULL, $df = NULL, $nbplacesf = NULL, $prixplacestdf = NULL) {
        if (!is_null($anneef) && !is_null($df) && !is_null($nbplacesf) && !is_null($prixplacestdf)) {
            $this->anneeFestival = $anneef;
            $this->dateFestival = $df;
            $this->nbTablesFest = $nbplacesf;
            $this->prixPlacesStandard = $prixplacestdf;
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
            $sql = "INSERT INTO festival (anneeFestival,dateFestival, nbTablesFest, prixPlacesStandard) VALUES (:annee, :date, :nbplaces, :prixplacestd)";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'annee' => $this->anneeFestival,
                'date' => $this->dateFestival,
                'nbplaces' => $this->nbTablesFest,
                'prixplacestd' => $this->prixPlacesStandard,
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
        $sql = "UPDATE festival SET  dateFestival =:read2, nbTablesFest =:read3, prixPlacesStandard =:read4 WHERE anneeFestival=:read7";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read2" => $this->dateFestival,
            "read3" => $this->nbTablesFest,
            "read4" => $this->prixPlacesStandard,
            "read7"=>$num,
        );
        return $req->execute($values);
    }


    public static function getTablesDispo() {
        $sql = "SELECT nbTablesFest FROM festival ";
        $req = Model::$pdo->query($sql);
        $res=$req->fetchColumn();
        return $res;
    }

    public static function getFestEnCours(){
        $sql="SELECT anneeFestival FROM festival ORDER BY anneeFestival DESC LIMIT 0,1";
         $req = Model::$pdo->query($sql);
        $res=$req->fetchColumn();
        return $res;
    }
}