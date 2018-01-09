
<?php

require_once File::build_path(array('model', 'Model.php'));

class ModelEditeur {

    private $numEditeur;
    private $nomEditeur;
    private $rueEditeur;
    private $villeEditeur;
    private $CPediteur;

    function getNumEditeur() {
        return $this->numEditeur;
    }

    function getNomEditeur() {
        return $this->nomEditeur;
    }

    function getRueEditeur() {
        return $this->rueEditeur;
    }

    function getVilleEditeur() {
        return $this->villeEditeur;
    }

    function getCPediteur() {
        return $this->CPediteur;
    }

    public function __construct($num = NULL, $nom = NULL, $r = NULL, $v = NULL, $cp = NULL) {
        if (!is_null($num) && !is_null($nom) && !is_null($r) && !is_null($v) && !is_null($cp)) {

            $this->numEditeur = $num;
            $this->nomEditeur = $nom;
            $this->rueEditeur = $r;
            $this->villeEditeur = $v;
            $this->CPediteur = $cp;
        }
    }

    public function getAllEditeurs() {

        $sql = "SELECT * FROM editeur";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelEditeur');


        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }

    public function getAllEditeursSort(){
        $sql = "SELECT * 
                FROM editeur
                ORDER BY villeEditeur ASC ";
                $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelEditeur');


        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }

    public function getAllEditeursSortVille(){
        $sql = "SELECT * 
                FROM editeur
                ORDER BY nomEditeur ASC ";
                $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelEditeur');


        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;

    }
    public function getNbEditeurs() {

        $sql = "SELECT COUNT(*) AS totalEditeurs FROM editeur";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCH();


        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }
    
    public function getEditeurById($id) {
        $sql = "SELECT * FROM editeur WHERE numEditeur=:read1";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read1" => $id,
        );
        $req->execute($values);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelEditeur');
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }


    public function save() {

        try {
            $sql = "INSERT INTO editeur (numEditeur,nomEditeur,rueEditeur, villeEditeur, CPediteur) VALUES (:num, :nom, :rue, :ville, :cp)";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'num' => $this->numEditeur,
                'nom' => $this->nomEditeur,
                'rue' => $this->rueEditeur,
                'ville' => $this->villeEditeur,
                'cp' => $this->CPediteur,
                
            );
            return $req->execute($values);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteByNum($id) {
        try {
            $sql = "DELETE FROM editeur WHERE numEditeur =:read1";
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
        $sql = "UPDATE editeur SET  nomEditeur =:read2, rueEditeur =:read3, villeEditeur =:read4, CPediteur =:read6 WHERE numEditeur=:read5";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read2" => $this->nomEditeur,
            "read3" => $this->rueEditeur,
            "read4" => $this->villeEditeur,
            "read6" => $this->CPediteur,
            "read5" => $num,
        );
        return $req->execute($values);
    }

public static function getNbEditeur() {
        $sql = "SELECT COUNT(numEditeur) FROM editeur ";
        $req = Model::$pdo->query($sql);
        $res=$req->fetchColumn();
        return $res;
    }
    

}
