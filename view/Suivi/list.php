<?php

echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Suivi</div>
EOF;

if (isset($_SESSION['login']) && Session::is_admin()) {
    echo <<<EOF
            <a class="ajout" href="index.php?action=createSuivi&numEditeur={$numEditeur}">Ajouter un suivi</a>
             
EOF;
}
echo <<<EOF
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                <tr>
                  <th>Premier Contact</th>
                  <th>Relance</th>
                  <th>Réponse</th>   
                </tr>
              </thead>
EOF;
foreach ($tab as $v) {

    $ref = htmlspecialchars($v->getRefSuivi());
    $premier = htmlspecialchars($v->getPremierContact());
    $relance = htmlspecialchars($v->getRelance());
    $reponse = htmlspecialchars($v->getReponse());
    $numEditeur = htmlspecialchars($v->getNumEditeur());
    
    if ($reponse == 0){
        $reponse = 'Non';
    } else {
        $reponse = 'Oui';
    }

    if(empty($premier)){
        echo 'VIDE prmeier';
    } else {
        echo '';
    }


    echo <<< EOF

             <tbody>
                <tr>
                  
                  
                   <th>{$premier}</th>
                   <th>{$relance}</th>
                   <th>{$reponse}</th>
                   <!--<th>{$ref}</th>
                   <th>{$numEditeur}</th>-->
                   
EOF;
    if (isset($_SESSION['login']) && Session::is_admin()) {

        echo <<< EOF
                   
                   <th class="text-center" ><a href="index.php?action=deleteSuivi&refSuivi={$ref}&numEditeur={$numEditeur}"><button class="btn btn-danger" type="button">Supprimer</button></a></th> 
                             <form action="index.php?action=updateSuivi" method = "POST">
                                
                                <input type="hidden" name="premierContact" value="{$premier}" />
                                <input type="hidden" name="relance" value="{$relance}" />
                                <input type="hidden" name="reponse" value="{$reponse}" />
                                <input type="hidden" name="ref" value="{$ref}" />
                                <input type="hidden" name="numEditeur" value="{$numEditeur}" />
                                


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
