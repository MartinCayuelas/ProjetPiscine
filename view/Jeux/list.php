<?php
echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des jeux</div>
EOF;
if (isset($_SESSION['login']) && Session::is_admin()) {
    echo <<<EOF
            <a class="ajout" href="index.php?action=construct">Ajouter un Jeu</a>
             
EOF;
}
echo <<<EOF
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                <tr>
                  <th >Nom du jeu</th>
                  <th>Nombre de joueurs</th>
                  <th>Date de sortie</th>
                  <th>Durée</th>
                  <th>Catégorie</th>
                  <th>Editeur</th>
                </tr>
              </thead>

EOF;
foreach ($tab as $v) {
    $num = htmlspecialchars($v->getNumJeu());
    $nom = htmlspecialchars($v->getNomJeu());
    $nbjoueurs = htmlspecialchars($v->getNbrejoueurs());
    $datesortie = htmlspecialchars($v->getDateSortie());
    $categorie = htmlspecialchars($v->getcodeCategorie());
    $editeur = htmlspecialchars($v->getnumEditeur());

    echo <<< EOF
             <tbody>
                <tr>
                  <th>{$nom}</th>
                  <th>{$nbjoueurs}</th>
                  <th>{$dates}</th>
                  <th>{$duree}</th>
                  <th>{$categorie}</th>
                  <th>{$editeur}</th>

EOF;
    if (isset($_SESSION['login']) && Session::is_admin()) {
        echo <<< EOF
                   
                   <th class="text-center" ><a href="index.php?action=deleteByNum&num={$num}"><button class="btn btn-danger" type="button">Supprimer</button></a></th> 
                             <form action="index.php?action=updated" method = "POST">
                                
                                <input type="hidden" name="numJeux" value="{$num}" />
                                <input type="hidden" name="nomJeu" value="{$nom}" />
                                <input type="hidden" name="NbreJoueurs" value="{$nbjoueurs}" />
                                <input type="hidden" name="dateSortie" value="{$dates}" />
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