<?php

/* Model */
require_once File::build_path(array("model", "Model.php"));
require_once File::build_path(array("model", "ModelUtilisateur.php"));
require_once File::build_path(array("model", "ModelEditeur.php"));
require_once File::build_path(array("model", "ModelReservation.php"));
require_once File::build_path(array("model", "ModelContact.php"));
require_once File::build_path(array("model", "ModelSuivi.php"));
require_once File::build_path(array("model", "ModelFestival.php"));
require_once File::build_path(array("model", "ModelLogement.php"));

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
        require File::build_path(array("view", "Dashboard/connexion.php"));
    }

    public static function connectedFestival() {
        $crypt = Security::chiffrer($_POST['password']);

        $login = $_POST['login'];

        $v = ModelUtilisateur::checkPassword($login, $crypt);



        if ($v != false) {


            $_SESSION['admin'] = $v->getAdmin($login);


            $_SESSION['login'] = $login;

            Controller::festivalAccueil();
        } else {

            Controller::festivalConnect();
        }
    }

    public static function deconnectFestival() {
        /*
         * On "libere" la session
         */

        unset($_SESSION['login']);
        unset($_SESSION['admin']);
        Controller::festivalConnect();
    }

    #############USER#########

    public static function createUser() {
        if (!Session::is_connected()) {
            Controller::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $action = 'createdUser';


            $titre = 'Ajout d\'un';
            $vLogin = NULL;
            $nom = NULL;
            $prenom = NULL;


            $controller = 'User';
            $view = 'create';
            $pagetitle = 'Ajouter un utilisateur';
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function createdUser() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {

            $crypt = Security::chiffrer($_POST['password']);
            $check = $_POST['admin'];
            if ($check == NULL) {
                $check = 0;
            } else {
                $check = 1;
            }
            $user = new ModelUtilisateur($_POST['login'], $crypt, $check, $_POST['prenom'], $_POST['nom']);


            if ($user->save() == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Erreur lors de la creation';
                require FILE::build_path(array("view", "view.php"));
            } else {
                Controller::listUser();
            }
        }
    }

    public function listUser() {
        if (!Session::is_connected()) {
            Controller::FestivalConnect();
        } else {

            $tab = ModelUtilisateur::getAllUsers();
            $controller = 'User';
            $view = 'list';
            $pagetitle = 'Liste des utilisateurs';
            require File::build_path(array("view", "view.php"));
        }
    }

    public function updateUser() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {

            $action = 'updatedUser';


            $titre = 'Modification';
            $vLogin = $_POST['login'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];


            $controller = 'User';
            $view = 'create';
            $pagetitle = 'Mise à jour Utilisateur';
            require FILE::build_path(array("view", "view.php"));
        }
    }

    public function updatedUser() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            requireFile::build_path(array("view", "view.php"));
        } else {

            $crypt = Security::chiffrer($_POST['password']);
            $check = $_POST['admin'];
            if ($check == NULL) {
                $check = 0;
            } else {
                $check = 1;
            }
            $user = new ModelUtilisateur($_POST['login'], $crypt, $check, $_POST['prenom'], $_POST['nom']);


            if ($user->updated($_POST['login']) == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Erreur lors de la creation';
                require FILE::build_path(array("view", "view.php"));
            } else {
                Controller::listUser();
            }
        }
    }

    public function deleteUser() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $login = $_GET['login'];

            $d = ModelUtilisateur::deleteByLogin($login);
            if ($d == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Impossible à supprimer';
                require File::build_path(array("view", "view.php"));
            } else {
                Controller::listUser();
            }
        }
    }

    ############Editeur#############

    public function listEditeur() {

        /*
         * Fonction pour afficher la liste des éditeurs
         */

        if (!Session::is_connected()) {
            Controller::FestivalConnect();
        } else {

            $tab = ModelEditeur::getAllEditeurs();
            $controller = 'Editeur';
            $view = 'list';
            $pagetitle = 'Liste des editeurs';
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function createEditeur() {
        if (!Session::is_connected()) {
            Controller::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $action = 'createdEditeur';


            $titre = 'Ajout d\'un';

            $nom = NULL;
            $ville = NULL;
            $rue = NULL;
            $cp = NULL;



            $controller = 'Editeur';
            $view = 'create';
            $pagetitle = 'Ajouter un editeur';
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function createdEditeur() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {


            $edit = new ModelEditeur(0, $_POST['nom'], $_POST['rue'], $_POST['ville'], $_POST['cp']);
            if ($edit->save() == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Erreur lors de la creation';
                require FILE::build_path(array("view", "view.php"));
            } else {
                Controller::listEditeur();
            }
        }
    }

    public function deleteEditeur() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $num = $_GET['num'];

            $d = ModelEditeur::deleteByNum($num);
            if ($d == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Impossible à supprimer';
                require File::build_path(array("view", "view.php"));
            } else {
                Controller::listEditeur();
            }
        }
    }

    public function updateEditeur() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {

            $action = 'updatedEditeur';


            $titre = 'Modification';


            $nom = $_POST['nom'];
            $ville = $_POST['ville'];
            $rue = $_POST['rue'];
            $cp = $_POST['cp'];
            $num = $_POST['numEditeur'];


            $controller = 'Editeur';
            $view = 'create';
            $pagetitle = 'Mise à jour Editeur';
            require FILE::build_path(array("view", "view.php"));
        }
    }

    public function updatedEditeur() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            requireFile::build_path(array("view", "view.php"));
        } else {

            $edit = new ModelEditeur(0, $_POST['nom'], $_POST['rue'], $_POST['ville'], $_POST['cp']);
            if ($edit->updated($_POST['numEditeur']) == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Erreur lors de la creation';
                require FILE::build_path(array("view", "view.php"));
            } else {
                Controller::listEditeur();
            }
        }
    }

    #################Contact################

    public function listContact() {

        /*
         * Fonction pour afficher la liste des contacts
         */

        if (!Session::is_connected()) {
            Controller::FestivalConnect();
        } else {
            $numE = $_GET['numEditeur'];
            $tab = ModelContact::getAllContactsByNum($numE);

            if (empty($tab)) {
                $controller = 'Contact';
                $view = 'listVide';
                $pagetitle = 'Liste des contacts';
                require File::build_path(array("view", "view.php"));
            } else {
                $controller = 'Contact';
                $view = 'list';
                $pagetitle = 'Liste des contacts';
                require File::build_path(array("view", "view.php"));
            }
        }
    }

    public static function createContact() {
        if (!Session::is_connected()) {
            Controller::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $action = 'createdContact';


            $titre = 'Ajout d\'un';

            $nom = NULL;
            $prenom = NULL;
            $num = NULL;
            $mail = NULL;

            $numEditeur = $_GET['numEditeur'];


            $controller = 'Contact';
            $view = 'create';
            $pagetitle = 'Ajouter un contact';
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function createdContact() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {


            $contact = new ModelContact(0, $_POST['nomContact'], $_POST['prenomContact'], $_POST['numTelContact'], $_POST['mailContact'], $_GET['numEditeur']);
            if ($contact->save() == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Erreur lors de la creation';
                require FILE::build_path(array("view", "view.php"));
            } else {
                Controller::listContact();
            }
        }
    }

    public function deleteContact() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $num = $_GET['numContact'];

            $d = ModelContact::deleteByNum($num);
            if ($d == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Impossible à supprimer';
                require File::build_path(array("view", "view.php"));
            } else {
                Controller::listContact();
            }
        }
    }

    public function updateContact() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {

            $action = 'updatedContact';


            $titre = 'Modification';


            $nom = $_POST['nomContact'];
            $prenom = $_POST['prenomContact'];
            $num = $_POST['numTelContact'];
            $mail = $_POST['mailContact'];
            $numContact = $_POST['numContact'];
            $numEditeur = $_GET['numEditeur'];


            $controller = 'Contact';
            $view = 'create';
            $pagetitle = 'Mise à jour Contact';
            require FILE::build_path(array("view", "view.php"));
        }
    }

    public function updatedContact() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            requireFile::build_path(array("view", "view.php"));
        } else {

            $contact = new ModelContact(0, $_POST['nomContact'], $_POST['prenomContact'], $_POST['numTelContact'], $_POST['mailContact'], $_GET['numEditeur']);
            if ($contact->updated($_POST['numContact']) == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Erreur lors de la creation';
                require FILE::build_path(array("view", "view.php"));
            } else {
                Controller::listContact();
            }
        }
    }

    ####################Suivi##############

    public function listSuivi() {
        /*
         * Fonction pour afficher la liste des suivis
         */

        if (!Session::is_connected()) {
            Controller::FestivalConnect();
        } else {
            $numEditeur = $_GET['numEditeur'];
            
            $tab = ModelSuivi::getSuivisByEditeur($numEditeur);
            

            $controller = 'Suivi';
            $view = 'list';
            $pagetitle = 'Liste des suivis';
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function createSuivi() {
        if (!Session::is_connected()) {
            Controller::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $action = 'createdSuivi';


            $titre = 'Ajout d\'un';

            $premierContact = NULL;
            $relance = NULL;
            $reponse = NULL;


            $numEditeur = $_GET['numEditeur'];


            $controller = 'Suivi';
            $view = 'create';
            $pagetitle = 'Ajouter un suivi';
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function createdSuivi() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $check = $_POST['reponse'];

            if ($check == NULL) {
                $check = 0;
            } else {
                $check = 1;
            }


            $premier = $_POST['premierContact'];
            $relance = $_POST['relance'];


            $suivi = new ModelSuivi(0, $premier, $relance, $check, $_GET['numEditeur']);
            if ($suivi->save() == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Erreur lors de la creation';
                require FILE::build_path(array("view", "view.php"));
            } else {

                Controller::listSuivi();
            }
        }
    }

    public function deleteSuivi() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $ref = $_GET['refSuivi'];

            $d = ModelSuivi::deleteByRef($ref);
            if ($d == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Impossible à supprimer';
                require File::build_path(array("view", "view.php"));
            } else {
                Controller::listSuivi();
            }
        }
    }

    ####################Reservations############"

    public function listResa() {

        /*
         * Fonction pour afficher la liste des réservations
         */

        if (!Session::is_connected()) {
            Controller::FestivalConnect();
        } else {

            $tab = ModelReservation::getAllReservations();
            $controller = 'Reservation';
            $view = 'list';
            $pagetitle = 'Liste des réservations';
            require File::build_path(array("view", "view.php"));
        }
    }

    ############Festival#############

    public function listFestival() {

        /*
         * Fonction pour afficher la liste des festivals
         */

        if (!Session::is_connected()) {
            Controller::FestivalConnect();
        } else {

            $tab = ModelFestival::getAllFestival();
            $controller = 'Festival';
            $view = 'list';
            $pagetitle = 'Liste des festivals';
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function createFestival() {
        if (!Session::is_connected()) {
            Controller::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $action = 'createdFestival';


            $titre = 'Ajout d\'un';
            $annee = NULL;
            $date = NULL;
            $nbplaces = NULL;
            $prixplacestd = NULL;


            $controller = 'Festival';
            $view = 'create';
            $pagetitle = 'Ajouter un festival';
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function createdFestival() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {


            $fest = new ModelFestival($_POST['annee'], $_POST['date'], $_POST['nbtables'], $_POST['prixplacestd']);
            if ($fest->save() == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Erreur lors de la creation';
                require FILE::build_path(array("view", "view.php"));
            } else {
                Controller::listFestival();
            }
        }
    }

    public function deleteFestival() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $idLogement = $_GET['idFestival'];

            $d = ModelFestival::deleteByAnnee($annee);
            if ($d == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Impossible à supprimer';
                require File::build_path(array("view", "view.php"));
            } else {
                Controller::listFestival();
            }
        }
    }

    public function updateFestival() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {

            $action = 'updatedLogement';


            $titre = 'Modification';


            $date = $_POST['date'];
            $nbplaces = $_POST['nbplaces'];
            $prixplacestd = $_POST['prixplacestd'];


            $controller = 'Festival';
            $view = 'create';
            $pagetitle = 'Mise à jour Festival';
            require FILE::build_path(array("view", "view.php"));
        }
    }

    public function updatedFestival() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            requireFile::build_path(array("view", "view.php"));
        } else {

            $edit = new ModelFestival(0, $_POST['date'], $_POST['nbplaces'], $_POST['prixplacestd']);
            if ($edit->updated($_POST['anneeFestival']) == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Erreur lors de la creation';
                require FILE::build_path(array("view", "view.php"));
            } else {
                Controller::listFestival();
            }
        }
    }

}