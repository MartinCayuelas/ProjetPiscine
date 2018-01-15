<?php
require_once File::build_path(array('model', 'Model.php'));
class ModelLogement {
    private $numLogement;
    private $rueLogement;
    private $villeLogement;
    private $CPLogement;
    private $nbCHambresLogement;
    private $coutNuitLogement;

    function getNumLogement() {
        return $this->numLogement;
    }
    function getRueLogement() {
        return $this->rueLogement;
    }
    function getVilleLogement() {
        return $this->villeLogement;
    }
    function getCPLogement() {
        return $this->CPLogement;
    }

    function getNbrsChambresLogement() {
        return $this->nbCHambresLogement;

    }
    function getCoutParNuitLogement() {
        return $this->coutNuitLogement;

    }


    public function __construct($numl = NULL, $rl = NULL, $vl = NULL, $cpl = NULL ,$nbchambresl = NULL , $cpnl = NULL) {
        if (!is_null($numl) && !is_null($rl) && !is_null($vl) && !is_null($cpl) && !is_null($nbchambresl) && !is_null($cpnl)) {
            $this->numLogement = $numl;
            $this->rueLogement = $rl;
            $this->villeLogement = $vl;
            $this->CPLogement = $cpl;
            $this->nbCHambresLogement = $nbchambresl;
            $this->coutNuitLogement = $cpnl;
             }
            }
    
    public function getAllLogements() {
        $sql = "SELECT * FROM logement";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelLogement');
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }
    public function getNbLogement() {
        $sql = "SELECT COUNT(*) AS totalLogement FROM Logement";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCH();
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }
    
    public function getLogementById($id) {
        $sql = "SELECT * FROM logement WHERE numLogement=:read1";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read1" => $id,
        );
        $req->execute($values);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelLogement');
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }
    public function save() {
        try {
            $sql = "INSERT INTO logement (numLogement,rueLogement, villeLogement, CPLogement,nbchambresLogement,coutNuitLogement) VALUES (:num, :rue, :ville, :cp, :nbchambres ,:cpn)";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'num' => $this->numLogement,
                'rue' => $this->rueLogement,
                'ville' => $this->villeLogement,
                'cp' => $this->CPLogement,
                'nbchambres' => $this->nbCHambresLogement,
                'cpn' => $this->coutNuitLogement,   
            );
            return $req->execute($values);
        } catch (PDOException $e) {
            return false;
        }
    }
    public function deleteByNum($id) {
        try {
            $sql = "DELETE FROM logement WHERE numLogement =:read1";
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
        $sql = "UPDATE logement SET  rueLogement =:read2, villeLogement =:read3, CPLogement =:read4 ,nbchambresLogement =:read5, coutNuitLogement =:read6 WHERE numLogement=:read7";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read2" => $this->rueLogement,
            "read3" => $this->villeLogement,
            "read4" => $this->CPLogement,
            "read5" => $this->nbCHambresLogement,
            "read6" => $this->coutNuitLogement,
            "read7" => $num,
        );
        return $req->execute($values);
    }
    
     public static function getDerLog() {
        $sq2="SELECT numLogement FROM logement ORDER BY numLogement DESC LIMIT 0, 1";
        $req2 = Model::$pdo->query($sq2);
        $res=$req2->fetchColumn();
        return $res;
    }

}
