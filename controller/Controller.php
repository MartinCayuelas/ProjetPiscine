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
require_once File::build_path(array("model", "ModelJeux.php"));
require_once File::build_path(array("model", "ModelCategorie.php"));
/* Lib */
require_once File::build_path(array("lib", "Security.php"));
require_once File::build_path(array("lib", "Session.php"));
class Controller {
// Fonctions pour afficher les différentes pages du site
    public function festivalAccueil() {
        /*
         * Affiche la page d'Accueil
         */
        if (!Session::is_connected()) {
            Controller::festivalConnect();
        } else {
            $tr = ModelReservation:: getTablesReservees(); //nombre de tables reservées
            $nbE = ModelEditeur::getNbEditeur(); //nombre d'éditeur dans la bdd
            $nbJ = ModelJeux::getNbreJeux(); //nombre de jeux presents au festival
            $tD1 = ModelFestival::getTablesDispo();
            $tD2 = $tD1 - $tr; //donne le nombres de tables disponibles 
            $c = ModelJeux::getJeuxConcern(); //affiche les jeux a recevoir 
            
            $p = ModelReservation:: getPrixFacture(); //affiche les paiements a venir 
            if (empty($p) and empty($c) or empty($p) or empty($c)) {
                $controller = 'Accueil';
                $view = 'indexVide';
                $pagetitle = 'Accueil Festival du Jeu';
                require File::build_path(array("view", "view.php"));
            } else {
                $controller = 'Accueil';
               $view = 'index';
            $pagetitle = 'Accueil Festival du Jeu';
            require File::build_path(array("view", "view.php"));
            }
           
        }
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
            $check = isset($_POST['admin']);
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

    public function listEditeurSort() {
        /*
         * Fonction pour afficher la liste des éditeurs
         */
        if (!Session::is_connected()) {
            Controller::FestivalConnect();
        } else {
            $tab = ModelEditeur::getAllEditeursSort();
            $controller = 'Editeur';
            $view = 'list';
            $pagetitle = 'Liste des editeurs';
            require File::build_path(array("view", "view.php"));
        }
    }

        public function listEditeurSortVille() {
        /*
         * Fonction pour afficher la liste des éditeurs
         */
        if (!Session::is_connected()) {
            Controller::FestivalConnect();
        } else {
            $tab = ModelEditeur::getAllEditeursSortVille();
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
            if (empty($tab)) {
                $controller = 'Suivi';
                $view = 'listVide';
                $pagetitle = 'Liste des suivis';
                require File::build_path(array("view", "view.php"));
            } else {
                $controller = 'Suivi';
                $view = 'list';
                $pagetitle = 'Liste des suivis';
                require File::build_path(array("view", "view.php"));
            }
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
    public function updateSuivi() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $action = 'updatedSuivi';
            $titre = 'Modification';
            $premierContact = $_POST['premierContact'];
            $relance = $_POST['relance'];
            $reponse = $_POST['reponse'];
            $numEditeur = $_POST['numEditeur'];
            $ref = $_POST['ref'];
            $controller = 'Suivi';
            $view = 'create';
            $pagetitle = 'Mise à jour Suivi';
            require FILE::build_path(array("view", "view.php"));
        }
    }
    public function updatedSuivi() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            requireFile::build_path(array("view", "view.php"));
        } else {
            $edit = new ModelSuivi(0, $_POST['premierContact'], $_POST['relance'], $_POST['reponse'], $_POST['numEditeur']);
            if ($edit->updated($_POST['refSuivi']) == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Erreur lors de la creation';
                require FILE::build_path(array("view", "view.php"));
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
            if (empty($tab)) {
                $controller = 'Reservation';
                $view = 'listVide';
                $pagetitle = 'Liste des réservations';
                require File::build_path(array("view", "view.php"));
            } else {
               $controller = 'Reservation';
                $view = 'list';
                $pagetitle = 'Liste des réservations';
                require File::build_path(array("view", "view.php"));
            }
            
        }
    }
    
    public static function createReservation() {
        if (!Session::is_connected()) {
            Controller::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $action = 'createdReservation';
            $titre = 'Ajout d\'une';
            $numEditeur=NULL;
            $commentaire = NULL;
            $prixPlaceNego  = NULL;
            $etatFact = NULL;
            $nomJeu = NULL;
            $nomEditeur = NULL;
            $nomZone = NULL;
            $rue = NULL;
            $ville = NULL;
            $nbPlace=NULL;
            $cp=NULL;
            $nbJeux =NULL;
            $coutNuit=NULL;
            $nbChambre=NULL;
            $frais=NULL;
            $place=NULL;
            $controller = 'Reservation';
            $view = 'create';
            $pagetitle = 'Ajouter une reservation';
            require File::build_path(array("view", "view.php"));
        }
    }
    public static function createdReservation() {
       if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $resa = new ModelReservation(0,0, $_POST['commentaire'], $_POST['prix'],0, $_POST['etatFact']);
            if ($resa->save() == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Erreur lors de la creation';
                require FILE::build_path(array("view", "view.php"));
            } else {
                Controller::listResa();
            }
        }
    }

    public function deleteResa() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $numResa = $_GET['num'];
            $d = ModelReservation::delete($numResa);
            if ($d == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Impossible à supprimer';
                require File::build_path(array("view", "view.php"));
            } else {
                Controller::listResa();
            }
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
           
            if (empty($tab)) {
                $controller = 'Festival';
                $view = 'listVide';
                $pagetitle = 'Liste des Festivals';
                require File::build_path(array("view", "view.php"));
            } else {
                $controller = 'Festival';
               $view = 'list';
            $pagetitle = 'Liste des Festivals';
            require File::build_path(array("view", "view.php"));
            }
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
            $action = 'updatedFestival';
            $titre = 'Modification';
            $date = $_POST['date'];
            $nbplaces = $_POST['nbtables'];
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
            $edit = new ModelFestival(0, $_POST['date'], $_POST['nbtables'], $_POST['prixplacestd']);
            if ($edit->updated($_POST['annee']) == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Erreur lors de la creation';
                require FILE::build_path(array("view", "view.php"));
            } else {
                Controller::listFestival();
            }
        }
    }
    ###################Jeux#################""
    public function listJeux() {
        /*
         * Fonction pour afficher la liste des éditeurs
         */
        if (!Session::is_connected()) {
            Controller::FestivalConnect();
        } else {
            $tab = ModelJeux::getAllJeux();
            $cat = ModelCategorie::getAllCategorie();
            $edit = ModelEditeur::getAllEditeurs();
            if (empty($tab)) {
                $controller = 'Jeux';
                $view = 'listVide';
                $pagetitle = 'Liste des jeux';
                require File::build_path(array("view", "view.php"));
            } else {
                $controller = 'Jeux';
                $view = 'list';
                $pagetitle = 'Liste des jeux';
                require File::build_path(array("view", "view.php"));
            }
        }
    }
    public function detailJeu() {
        /*
         * Fonction pour afficher la liste des éditeurs
         */
        if (!Session::is_connected()) {
            Controller::FestivalConnect();
        } else {
            $num = $_GET['num'];
            $tab = ModelJeux::getJeuByNum($num);
            
            $cat = ModelCategorie::getAllCategorie();
            $edit = ModelEditeur::getAllEditeurs();
            
            $controller = 'Jeux';
            $view = 'detail';
            $pagetitle = 'Detail';
            require File::build_path(array("view", "view.php"));
        }
    }
    public static function createJeu() {
        if (!Session::is_connected()) {
            Controller::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $action = 'createdJeu';
            $titre = 'Ajout d\'un';
            $nom = NULL;
            $ville = NULL;
            $rue = NULL;
            $cp = NULL;
            $controller = 'Jeux';
            $view = 'create';
            $pagetitle = 'Ajouter un jeu';
            require File::build_path(array("view", "view.php"));
        }
    }
    public static function createdJeu() {
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
    ###################Catégorie####################
    public function listCategorie() {
        /*
         * Fonction pour afficher la liste des éditeurs
         */
        if (!Session::is_connected()) {
            Controller::FestivalConnect();
        } else {
            $cat = ModelCategorie::getAllCategorie();
            $games = ModelJeux::getAllJeux();
            $controller = 'Categorie';
            $view = 'list';
            $pagetitle = 'Liste des Catégorie';
            require File::build_path(array("view", "view.php"));
        }
    }
    
     public static function createCategorie() {
        if (!Session::is_connected()) {
            Controller::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $action = 'createdCategorie';
            $titre = 'Ajout d\'une';
            $nom = NULL;
            $code = NULL;
            
            $controller = 'Categorie';
            $view = 'create';
            $pagetitle = 'Ajouter une catégorie';
            require File::build_path(array("view", "view.php"));
        }
    }
    public static function createdCategorie() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $cate = new ModelCategorie(0, $_POST['nomCategorie']);
            if ($cate->save() == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Erreur lors de la creation';
                require FILE::build_path(array("view", "view.php"));
            } else {
                Controller::listCategorie();
            }
        }
    }
    
    public function deleteCategorie() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $code = $_GET['code'];
            $d = ModelCategorie::deleteByCode($code);
            if ($d == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Impossible à supprimer';
                require File::build_path(array("view", "view.php"));
            } else {
                Controller::listCategorie();
            }
        }
    }
    
    
    
}
