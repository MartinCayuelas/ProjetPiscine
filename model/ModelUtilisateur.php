<?php

require_once File::build_path(array('model', 'Model.php'));

class ModelUtilisateur {

    private $login;
    private $password;
    private $admin;
    private $prenom;
    private $nom;

    function getLogin() {
        return $this->login;
    }

    function getPassword() {
        return $this->password;
    }

    function getAdmin() {
        return $this->admin;
    }
    function getPrenom() {
        return $this->prenom;
    }
    function getNom() {
        return $this->nom;
    }


    public function __construct($login = NULL, $pwd = NULL, $ad = NULL, $p = NULL, $n = NULL) {
        if (!is_null($login) && !is_null($pwd) && !is_null($ad) && !is_null($p) && !is_null($n)) {

            $this->login = $login;
            $this->password = $pwd;
            $this->admin = $ad;
            $this->prenom = $p;
            $this->nom = $n;
            
        }
    }

    public function getAllUsers() {

        $sql = "SELECT * FROM utilisateur";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCHALL(PDO::FETCH_CLASS, 'ModelUtilisateur');


        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }

    public function getNbUsers() {

        $sql = "SELECT COUNT(*) AS total FROM utilisateur";
        $req = Model::$pdo->query($sql);
        $tab_prod = $req->FETCH();


        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }

    public function save() {

        try {
            $sql = "INSERT INTO utilisateur (login, password, admin, prenom, nom) VALUES (:login, :pwd, :admin, :p, :n)";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'login' => $this->login,
                'pwd' => $this->password,
                'admin' => $this->admin,
                'p' => $this->prenom,
                'n' => $this->nom,
             
            );
            return $req->execute($values);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function checkPassword($login, $mot_de_passe_chiffre) {

        $sql = "SELECT * FROM utilisateur WHERE  login= :login AND password= :password";
        $req1 = Model::$pdo->prepare($sql);
        $values1 = array(
            "login" => $login,
            "password" => $mot_de_passe_chiffre,
        );
        $req1->execute($values1);
        $tab = $req1->FetchAll(PDO::FETCH_CLASS, 'ModelUtilisateur');
        if (empty($tab)) {
            return false;
        } else {
            return $tab[0];
        }
    }

    public function getUserByLogin($login) {
        $sql = "SELECT * FROM utilisateur WHERE login =:read";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read" => $login,
        );
        $req->execute($values);
        $tab_prod = $req->fetchAll(PDO::FETCH_CLASS, 'ModelUtilisateur');

        if (empty($tab_prod)) {
            return false;
        }
        return $tab_prod;
    }

    public function updated($login) {
        $sql = "UPDATE utilisateur SET  password =:read2, admin =:read3, prenom =:read4, nom =:read6 WHERE login=:read5";
        $req = Model::$pdo->prepare($sql);
        $values = array(
            "read2" => $this->password,
            "read3" => $this->admin,
            "read4" => $this->prenom,
            "read6" => $this->nom,
            "read5" => $login,
        );
        return $req->execute($values);
    }

    public function deleteByLogin($login) {
        try {
            $sql = "DELETE FROM utilisateur WHERE login =:read1";
            $req = Model::$pdo->prepare($sql);
            $values = array(
                'read1' => $login,
            );
            $req->execute($values);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

}
