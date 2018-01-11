
<?php
require_once File::build_path(array('model', 'Model.php'));
class ModelCategorie {
    private $codeCategorie;
    private $nomCategorie;
 

    function getCodeCategorie() {
        return $this->codeCategorie;
    }
    function getNomCategorie() {
        return $this->nomCategorie;
    }

    public function __construct($code = NULL, $nom = NULL) {
        if (!is_null($code) && !is_null($nom)) {
            $this->codeCategorie = $code;
            $this->nomCategorie = $nom;
            }
    }
    public function getAllCategorie() {
        $sql = "SELECT * FROM categorie";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelCategorie');
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }
    public function getNbCategorie() {
        $sql = "SELECT COUNT(*) AS totalCategorie FROM categorie";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCH();
        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }
    
    public function save() {
        try {
            $sql = "INSERT INTO categorie (codeCategorie,nomCategorie) VALUES (:code, :nom)";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'code' => $this->codeCategorie,
                'nom' => $this->nomCategorie,
            
            );
            return $req->execute($values);
        } catch (PDOException $e) {
            return false;
        }
    }

   
    public function updated($code) {
        $sql = "UPDATE = categorie SET  codeCategorie =:read1, nomCategorie =:read2";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read1" => $this->codeCategorie,
            "read2" => $this->nomCategorie,
        );
        return $req->execute($values);
    }
    
    public function deleteByCode($code) {
        try {
            $sql = "DELETE FROM categorie WHERE codeCategorie =:read1";
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
    
    public static function getNumCatByNom($nom) {
        $sq2 = "SELECT codeCategorie FROM categorie WHERE nomCategorie='".$nom."'";
        $req2 = Model::$pdo->query($sq2);
        $res = $req2->fetchColumn();
        return $res;
    }
}