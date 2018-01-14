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
require_once File::build_path(array("model", "ModelZone.php"));
require_once File::build_path(array("model", "ModelLoger.php"));
require_once File::build_path(array("model", "ModelConcerner.php"));
require_once File::build_path(array("model", "ModelLocaliser.php"));
require_once File::build_path(array("model", "ModelOrganiser.php"));
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
            $tr = ModelLocaliser:: getPlaceLocaliser();
            $nbE = ModelEditeur::getNbEditeur(); //nombre d'éditeur dans la bdd
            $nbJ = ModelJeux::getNbreJeux(); //nombre de jeux presents au festival
            $tD1 = ModelFestival::getTablesDispo();
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
            $nb = ModelUtilisateur::getNbUsers();
            $num = $nb['total'];
            if ($num == 1) {
                $s = "";
            } else {
                $s = 's';
            }
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
             $num = ModelEditeur::getNbEditeurs();
             $num = $num['total'];
            if ($num == 1) {
                $s = "";
            } else {
                $s = 's';
            }
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
             $num = ModelEditeur::getNbEditeurs();
             $num = $num['total'];
            if ($num == 1) {
                $s = "";
            } else {
                $s = 's';
            }
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
              $num = ModelEditeur::getNbEditeurs();
             $num = $num['total'];
            if ($num == 1) {
                $s = "";
            } else {
                $s = 's';
            }
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
    public function listSuiviB() {
        /*
         * Fonction pour afficher la liste des suivis
         */
        if (!Session::is_connected()) {
            Controller::FestivalConnect();
        } else {
            $numEditeur = $_GET['numEditeur'];          
            $num = ModelSuivi::getNbSuivis();
            $num = $num['totalSuivis'];
            if ($num == 1) {
                $s = "";
            } else {
                $s = 's';
            }
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
    public function listSuivi() {
        /*
         * Fonction pour afficher la liste des suivis
         */
        if (!Session::is_connected()) {
            Controller::FestivalConnect();
        } else {
            $num = ModelSuivi::getNbSuivis();
            $num = $num['totalSuivis'];
            if ($num == 1) {
                $s = "";
            } else {
                $s = 's';
            }
            $tab = ModelSuivi::getSuivis();
            $tabEditeur = ModelEditeur::getAllEditeurs();
             
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
            $nom = NULL;
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
            $nomE = $_POST['nomE'];
            $num = ModelEditeur::getNumEditByNom($nomE);
            $premier = $_POST['premierContact'];
            $relance = $_POST['relance'];
            $suivi = new ModelSuivi(0, $premier, $relance, $check, $num);
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
            $retour=NULL;
            $don=NULL;
            $recu=NULL;
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
            $catJeu=NULL;
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
            $ex=$resa->save();
            $numR=ModelReservation::getDerResa();
            $numE=ModelEditeur::getNumEditByNom($_POST['nomEditeur']);
            $numF=ModelFestival::getFestEnCours();
            $numCat=ModelCategorie::getNumCatByNom($_POST['catJeu']);
            $jeu=ModelJeux::getAllJeux();
            $zone=ModelZone::getAllZone();
            $cat=ModelCategorie::getAllCategorie();
            $org=ModelOrganiser::getAllOrga();
            
            /*test pour savoir si la catégorie existe*/
            $existCat=0;
            foreach ($cat as $c ) {
                if ($c->getNomCategorie()==$_POST['catJeu']){
                    $existCat=1;
                }
            }
            /*s'elle n'existe pas on enregistre la categorie*/
            if ($existCat==0){
                $cate= new ModelCategorie(0,$_POST['catJeu']);
               // print_r($cate);
                $cate->save();
                $numCat=ModelCategorie::getDerCat();
            }
            
            $exist=0;
            foreach ($jeu as $j ) {
                if ($j->getNomJeu()==$_POST['nomJeu']){
                    $exist=1;
                }
            }
            /*s'il n'existe pas on enregistre ce nouveau jeu*/
            if ($exist==0){

                $jeu = new ModelJeux(0,$_POST['nomJeu'],0,'0000-00-00',0,$numCat,$numE);
               // print_r($jeu);
                $jeu->save();
                $numJ=ModelJeux::getDerJeu();
                $concerner= new ModelConcerner($numR,$numJ, $_POST['nbJeux'],$_POST['recu'],$_POST['retour'],$_POST['don']);
                $concerner->save();
            }
            elseif($exist==1){
                $numJ=ModelJeux::getNumJ($_POST['nomJeu']);
                $concerner = new ModelConcerner($numR,$numJ, $_POST['nbJeux'],$_POST['recu'],$_POST['retour'],$_POST['don']);
                $concerner->save();
            }

            
            /*test pour savoir si la zone existe*/
            $existZ=0;
            foreach ($zone as $z) {
                if ($z->getNomZone()==$_POST['nomZone']){
                    $existZ=1;
                }
            }
            /*la zone n'existe pas alors on l'enregistre*/
            if ($existZ==0){
                $zon= new ModelZone(0, $_POST['nomZone'],$numF);
               //print_r($zon);
                $zon->save();
                $numZ=ModelZone::getDerZone();
                $localis= new ModelLocaliser($numZ,$numR,$_POST['nbPlace']);
                //print_r($localis);
                $localis->save();
            }
            elseif($existZ==1){
                $numZ=ModelZone::getNumZoneByNom($_POST['nomZone']);
                $localis= new ModelLocaliser($numZ,$numR,$_POST['nbPlace']);
                //print_r($localis);
                $localis->save();
            }

            /*on enregistre la table organiser : lien entre zoe et catégorie si besoin*/
            if ($existCat==0 or $existZ==0){
                $orga =new ModelOrganiser($numCat,$numZ);
                $orga->save();
            }
            elseif ($existCat==0 and $existZ==0){
                 $orga =new ModelOrganiser($numCat,$numZ);
                 $orga->save();
            }
            else{
                $existO=0;
                foreach ($org as $o) {
                    $c=ModelCategorie::getNumCatByNom($_POST['catJeu']);
                    $z=ModelZone::getNumZoneByNom($_POST['nomZone']);
                    if($o->getCodeCategorie()==$c and $o->getNumZone()==$z){
                        $existO=0;
                    }
                    else{
                        $existO=1;
                    }
                }
                if ($existO==0){
                    $orga=new ModelOrganiser($numCat,$numZ);
                    $orga->save();
                }
            }


            if ($_POST['log']==1){  //si il faut un logement a l'éditeur 
                $logem= new ModelLogement(0,$_POST['rue'],$_POST['ville'], $_POST['cp'], $_POST['nbChambre'],$_POST['coutNuit']);
                $logem->save();
                $numL=ModelLogement::getDerLog();
                $loger= new ModelLoger($numR,$numL,$_POST['place'],$_POST['frais']);
                //print_r($loger);
                $loger->save();
            }
            
            if ( $ex== false or $concerner==false) {
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

            $d2=ModelConcerner::deleteByNumResa($numResa);
            $d3=ModelLoger::deleteByNumResa($numResa);
            $d4=ModelLocaliser::deleteByNumResa($numResa);
            $d = ModelReservation::delete($numResa);
            if ($d == false or $d2== false or $d3== false or $d4== false) {
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
            $nbJ = ModelJeux::getNbJeux();
            $num = $nbJ['totalJeux'];
            if ($num == 1) {
                $s = "";
            } else {
                $s = 'x';
            }
            
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
            $num=NULL;
            $nom = NULL;
            $nbjoueurs = NULL;
            $dates = NULL;
            $duree = NULL;
            $editeur = NULL;
            $categorie = NULL;
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
             $cat=ModelCategorie::getAllCategorie();
            
            /*test pour savoir si la catégorie existe*/
            $existCat=0;
            foreach ($cat as $c ) {
                if ($c->getNomCategorie()==$_POST['categorie']){
                    $existCat=1;
                }
            }
            /*s'elle n'existe pas on enregistre la categorie*/
            if ($existCat==0){
                $cate= new ModelCategorie(0,$_POST['categorie']);
                $cate->save();
                $numCat=ModelCategorie::getDerCat();
            }
            elseif($existCat==1){
                $numCat=ModelCategorie::getNumCatByNom($_POST['categorie']);
            }
            
            $numE=ModelEditeur::getNumEditByNom( $_POST['editeur']);
            $jeux = new ModelJeux(0, $_POST['nom'], $_POST['nbjoueurs'], $_POST['dates'], $_POST['duree'], $numCat, $numE);
            if ($jeux->save() == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Erreur lors de la creation';
                require FILE::build_path(array("view", "view.php"));
            } else {
                Controller::listJeux();
            }
        }
    }

     public function deleteJeux() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $num = $_GET['num'];
            $d = ModelJeux::deleteByNum($num);
            if ($d == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Impossible à supprimer';
                require File::build_path(array("view", "view.php"));
            } else {
                Controller::listJeux();
            }
        }
    }

     public function updateJeux() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $action = 'updatedJeux';
            $titre = 'Modification';
            $num=$_POST['numJeux'];
            $nom = $_POST['nomJeu'];
            $dates = $_POST['dateSortie'];
            $duree = $_POST['dureePartie'];
            $categorie = ModelCategorie::getNomCatByNum($_POST['codeCategorie']);
            $editeur =ModelEditeur::getNomEditByNum($_POST['numEditeur']);
            $nbjoueurs = $_POST['NbreJoueurs'];
            $controller = 'Jeux';
            $view = 'create';
            $pagetitle = 'Mise à jour Jeux';
            require FILE::build_path(array("view", "view.php"));
        }
    }
   public function updatedJeux() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            requireFile::build_path(array("view", "view.php"));
        } else {
            $numCat=ModelCategorie::getNumCatByNom($_POST['categorie']);
            $numE=ModelEditeur::getNumEditByNom( $_POST['editeur']);
            $edit = new ModelJeux(0, $_POST['nom'], $_POST['nbjoueurs'], $_POST['dates'], $_POST['duree'], $numCat, $numE);
            if ($edit->updated($_POST['numJeux']) == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Erreur lors de la creation';
                require FILE::build_path(array("view", "view.php"));
            } else {
                Controller::listJeux();
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
            $num = ModelCategorie::getNbCategorie();
            $num = $num['totalCategorie'];
            if ($num == 1) {
                $s = "";
            } else {
                $s = 's';
            }

            $controller = 'Categorie';
            $view = 'list';
            $pagetitle = 'Liste des Catégories';
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
    
       ###################ZONE####################
    public function listZone() {
        /*
         * Fonction pour afficher la liste des Zones
         */
        if (!Session::is_connected()) {
            Controller::FestivalConnect();
        } else {
            $tabZ = ModelZone::getAllZone();
          
            $tabC=ModelOrganiser::getAllOrga();
               
            $tabJ=ModelJeux::getAllJeux();

            $tabCat=ModelCategorie::getAllCategorie();

            $tabConcern=ModelConcerner::getAllConcerner();

            $tabLoc=ModelLocaliser::getAllLocaliser();
            $controller = 'Zones';
            $view = 'list';
            $pagetitle = 'Liste des zones';
            require File::build_path(array("view", "view.php"));
        }
    }
    
     public static function createZone() {
        if (!Session::is_connected()) {
            Controller::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $action = 'createdZone';
            $titre = 'Ajout d\'une';
            $nom = NULL;
            $numZone = NULL;
            
            $controller = 'Zones';
            $view = 'create';
            $pagetitle = 'Ajouter une zone';
            require File::build_path(array("view", "view.php"));
        }
    }
    public static function createdZone() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $anF=ModelFestival::getFestEnCours();
            $zone = new ModelZone(0, $_POST['nomZone'],$anF);
            if ($zone->save() == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Erreur lors de la creation';
                require FILE::build_path(array("view", "view.php"));
            } else {
                Controller::listZone();
            }
        }
    }
    
    public function deleteZone() {
        if (!Session::is_connected()) {
            self::festivalConnect();
        } elseif (!Session::is_admin()) {
            $controller = 'Accueil';
            $view = 'listVide';
            $pagetitle = 'Error Accès';
            require File::build_path(array("view", "view.php"));
        } else {
            $numZone = $_GET['num'];
            $d3= ModelLocaliser::deleteByNumZ($numZone);
            $d2 = ModelOrganiser::deleteByNumZone($numZone);
            $d = ModelZone::deleteByNum($numZone);
            if ($d == false) {
                $controller = 'Accueil';
                $view = 'listVide';
                $pagetitle = 'Impossible à supprimer';
                require File::build_path(array("view", "view.php"));
            } else {
                Controller::listZone();
            }
        }
    }
     
    
}
