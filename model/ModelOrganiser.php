<?php

require_once File::build_path(array('model', 'Model.php'));

class ModelOrganiser {

    private $codeCategorie;
    private $numZone;

    function getCodeCategorie() {
        return $this->codeCategorie;
    }

    function getNumZone() {
        return $this->numZone;
    }


    public function __construct($codeCategorie = NULL, $numZone = NULL) {
        if (!is_null($codeCategorie) && !is_null($numZone)){
            $this->codeCategorie = $codeCategorie;
            $this->numZone = $numZone;
    }
}

    public function save() {

        try {
            $sql = "INSERT INTO organiser (codeCategorie,numZone) VALUES (:code, :num)";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'code' => $this->codeCategorie,
                'num' => $this->numZone,
                
            );
            return $req->execute($values);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteByNumZone($num) {
        try {
            $sql = "DELETE FROM organiser WHERE numZone =:read1";
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

     public function deleteByCodeCat($code) {
        try {
            $sql = "DELETE FROM organiser WHERE codeCategorie =:read1";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'read1' => $code,
            );
            $req->execute($values);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

     public function getAllOrga() {
        $sql = "SELECT * FROM organiser";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelOrganiser');
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }
   
}
