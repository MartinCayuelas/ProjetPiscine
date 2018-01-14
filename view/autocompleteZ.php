<?php

require('../lib/File.php');
require('../config/Conf.php');
require('../model/Model.php');

$bd = Model::Init();


/* veillez bien à vous connecter à votre base de données */

$term = $_GET['term'];

$requete =Model::$pdo->prepare('SELECT * FROM zones WHERE nomZone LIKE :term'); // j'effectue ma requête SQL grâce au mot-clé LIKE

$requete->execute(array('term' => '%'.$_GET['term'].'%'));

$array = array(); // on créé le tableau

while($donnee = $requete->fetch()) // on effectue une boucle pour obtenir les données
{
    array_push($array, $donnee['nomZone']); // et on ajoute celles-ci à notre tableau
}

echo json_encode($array); // il n'y a plus qu'à convertir en JSON