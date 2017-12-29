<?php

echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des editeurs</div>
EOF;

if (isset($_SESSION['login']) && Session::is_admin()) {
    echo <<<EOF
            <a class="ajout" href="index.php?action=createEditeur">Ajouter un Editeur</a>
             
EOF;
}
echo <<<EOF
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                <tr>
                  <th >Nom</th>
                  
                  <th>Ville</th>
                  <th>Rue</th>
                   <th>CodePostal</th>
                </tr>
              </thead>
EOF;
foreach ($tab as $v) {

    $num = htmlspecialchars($v->getNumEditeur());
    $nom = htmlspecialchars($v->getNomEditeur());
    $ville = htmlspecialchars($v->getVilleEditeur());
    $rue = htmlspecialchars($v->getRueEditeur());
    $cp = htmlspecialchars($v->getCPediteur());





    echo <<< EOF

             <tbody>
                <tr>
                  <th>{$nom}</th>
                  <th>{$ville}</th>
                   <th>{$rue}</th>
                   <th>{$cp}</th>
EOF;
    if (isset($_SESSION['login']) && Session::is_admin()) {

        echo <<< EOF
                   
                   <th class="text-center" ><a href="index.php?action=deleteEditeur&num={$num}"><button class="btn btn-danger" type="button">Supprimer</button></a></th> 
                             <form action="index.php?action=updateEditeur" method = "POST">
                                
                                <input type="hidden" name="numEditeur" value="{$num}" />
                                <input type="hidden" name="nom" value="{$nom}" />
                                <input type="hidden" name="ville" value="{$ville}" />
                                <input type="hidden" name="rue" value="{$rue}" />
                                <input type="hidden" name="cp" value="{$cp}" />
                                


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
