<?php

/* Model */
require_once File::build_path(array("model", "Model.php"));
require_once File::build_path(array("model", "ModelRealisation.php"));
require_once File::build_path(array("model", "ModelPresentation.php"));
require_once File::build_path(array("model", "ModelLien.php"));
require_once File::build_path(array("model", "ModelUtilisateur.php"));

/* Lib */

require_once File::build_path(array("lib", "Security.php"));
require_once File::build_path(array("lib", "Session.php"));

class Controller {

// Fonctions pour afficher les différentes pages du site
    public function festivalAccueil() {
        /*
         * Affiche la page d'Accueil
         */
        //$tab_produit = ModelRealisation::getAllPrincipales(); //On récupère les images principales
        //$tab = ModelPresentation::getPresentation(); // On recupère la présentation pour le petite description
        $controller = 'Accueil';
        $view = 'list';
        $pagetitle = 'Accueil Festival du Jeu';
        require File::build_path(array("view", "view.php"));
    }

    /* Connexion */

    public function festivalConnect() {
        $controller = 'Dashboard';
        $view = 'connexion';
        $pagetitle = 'FestivalDuJeuMontpellier';
        require File::build_path(array("view", "view.php"));
    }

    public static function connectedFestival() {
        $crypt = Security::chiffrer($_POST['password']);

        $login = $_POST['login'];

        $v = ModelUtilisateur::checkPassword($login, $crypt);



        if ($v != false) {


            $_SESSION['admin'] = $v->getAdmin($login);


            $_SESSION['login'] = $login;

            Controller::dashboard();
        } else {

            self::copoConnect();
        }
    }

    public static function deconnect() {

        /*
         * On "libere" la session
         */

        unset($_SESSION['login']);
        unset($_SESSION['admin']);
    }

}
