<?php
echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-th"></i> Détail du jeu </div>

<div class="card-header">
   
    <a href="index.php?action=listCategorie"><button class="btn btn-warning retour" type="button">Retour aux Catégories</button></a>
    </div>

EOF;

echo <<<EOF
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered"  width="100%" cellspacing="0">
               <thead>
                <tr>
                  <th >Nom du jeu</th>
                  <th>Joueurs</th>
                  <th>Date de sortie</th>
                  <th>Durée</th>
                  <th>Catégorie</th>
                  <th>Editeur</th>
                </tr>
              </thead>

EOF;

   foreach ($tab as $v) {
    $num = htmlspecialchars($v->getnumJeu());
    $nom = htmlspecialchars($v->getNomJeu());
    $nbjoueurs = htmlspecialchars($v->getnbjoueurs());
    $datesortie = htmlspecialchars($v->getdateSortie());
    $duree = htmlspecialchars($v->getDureePartie());
    $categorie = htmlspecialchars($v->getcodeCategorie());
    $editeur = htmlspecialchars($v->getnumEditeur());
    
    foreach ($cat as $c){
        if ($c->getCodeCategorie() == $categorie){
            $categorieNom = htmlspecialchars($c->getNomCategorie());   
        }
    }
    
    foreach ($edit as $c){
        if ($c->getNumEditeur() == $editeur){
            $editeurNom = htmlspecialchars($c->getNomEditeur());   
        }
    }

    

    echo <<< EOF
             <tbody>
                <tr>
                  <th>{$nom}</th>
                  <th>{$nbjoueurs}</th>
                  <th>{$datesortie}</th>
                  <th>{$duree} min</th>
                  <th>{$categorieNom}</th>
                  <th>{$editeurNom}</th>

EOF;
    if (isset($_SESSION['login']) && Session::is_admin()) {
        echo <<< EOF
                   
                   <th class="text-center" ><a href="index.php?action=deleteByNum&num={$num}"><button class="btn btn-danger" type="button">Supprimer</button></a></th> 
                             <form action="index.php?action=updated" method = "POST">
                                
                                <input type="hidden" name="numJeux" value="{$num}" />
                                <input type="hidden" name="nomJeu" value="{$nom}" />
                                <input type="hidden" name="NbreJoueurs" value="{$nbjoueurs}" />
                                <input type="hidden" name="dateSortie" value="{$datesortie}" />
                                <input type="hidden" name="dureePartie" value="{$duree}" />
                                <input type="hidden" name="codeCategorie" value="{$categorie}" />
                                <input type="hidden" name="numEditeur" value="{$editeur}" />
                                
                                <br>
                               <th class="text-center" > <button type="submit" class="btn btn-primary">Modifier</button></th>   
                            </form>
                               
                       
                       
EOF;
    }
    echo <<< EOF
        </tr>
      </tbody>
                    
  
             
                      
EOF;
   }

   
echo "</div>";

echo "</div>";
