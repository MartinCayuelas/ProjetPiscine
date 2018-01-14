<?php

echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des Suivis</div>
EOF;

if (isset($_SESSION['login']) && Session::is_admin()) {
    echo <<<EOF
            <a class="ajout" href="index.php?action=createSuivi"><i class="fa fa-plus-circle" aria-hidden="true"></i>  suivi</a>
             
EOF;
}
echo <<<EOF
        <div class="card-body">
            {$num} suivi{$s} <i class=" fa fa-folder"></i>
          <div class="table-responsive">
            <table class="table table-bordered"  width="100%" cellspacing="0">
               <thead>
                <tr>
                  <th>Nom Editeur</th>
                  <th>Premier Contact</th>
                  <th>Relance</th>
                  <th>Réponse <a href="index.php?action=listSuiviReponse"><i class="tri fa fa-sort-alpha-asc" aria-hidden="true"></i></th>
                  <th>Facture</>
                  <th>Paiement</>
                  <th>Remarque</> 
                  
                </tr>
              </thead>
EOF;

foreach ($tab as $v) {
        


    $ref = htmlspecialchars($v->getRefSuivi());
    $premier = htmlspecialchars($v->getPremierContact());
    $relance = htmlspecialchars($v->getRelance());
    $reponse = htmlspecialchars($v->getReponse());
    
    $numEditeur = htmlspecialchars($v->getNumEditeur());
    
    foreach ($tabEditeur as $e){
        if ($e->getNumEditeur() == $numEditeur){
            $nomEditeur = htmlspecialchars($e->getNomEditeur());
           
        }
    }
    
    if ($reponse == 0){
        $reponse = 'Non';
    } else {
        $reponse = 'Oui';
    }

    if(empty($premier)){
        echo 'VIDE premier';
    } else {
        echo '';
    }


    echo <<< EOF

             <tbody>
                <tr>
                  
                  <th>{$nomEditeur}</th>
                   <th>{$premier}</th>
                   <th>{$relance}</th>
                   <th>{$reponse}</th>
                   
                   
EOF;
    if (isset($_SESSION['login']) && Session::is_admin()) {

        echo <<< EOF
        
        <th class="text-center"> <a class="nav-link" data-toggle="modal" data-target="#exampleModalS{$ref}">
                           <button class="btn btn-danger" type="button"> <i class="fa fa-fw fa-trash"></i></button></a></th>   
       
       <div class="modal fade" id="exampleModalS{$ref}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelS{$ref}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelS{$ref}">Supprimer?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                        <a href="index.php?action=deleteSuivi&refSuivi={$ref}&numEditeur={$numEditeur}"><button class="btn btn-danger" type="button">Supprimer</button></a>
                    </div>
                </div>
            </div>
        </div>
                   
                            <form action="index.php?action=updateSuivi" method = "POST">
                                
                                <input type="hidden" name="premierContact" value="{$premier}" />
                                <input type="hidden" name="relance" value="{$relance}" />
                                <input type="hidden" name="reponse" value="{$reponse}" />
                                <input type="hidden" name="ref" value="{$ref}" />
                                <input type="hidden" name="numEditeur" value="{$numEditeur}" />
                                


                               <th class="text-center" > <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-pencil"></i></button></th>   
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
