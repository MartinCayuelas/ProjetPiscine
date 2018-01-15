<?php

echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des editeurs</div>
EOF;

if (isset($_SESSION['login']) && Session::is_admin()) {
    echo <<<EOF
            <a class="ajout" href="index.php?action=createEditeur"><i class="fa fa-plus-circle" aria-hidden="true"></i> Editeur</a>
             
EOF;
}


    
echo <<<EOF

<div class="card-body">

                  {$num} Editeur{$s} <i class=" fa fa-user-o"></i>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                <tr>
                  <th >Nom <a href="index.php?action=listEditeurSort"><i class="tri fa fa-sort-alpha-asc" aria-hidden="true"></i></th>
                  
                  <th>Ville <a href="index.php?action=listEditeurSortVille"><i class="tri fa fa-sort-alpha-asc" aria-hidden="true"></i></th>
                  <th>Rue</th>
                   <th>CodePostal</th>
                </tr>
              </thead>
EOF;
//on récupére les données des éditeurs qui sont dans $tab
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
                   <th><a class="nav-link" href="index.php?action=listContact&numEditeur={$num}"><button class="btn btn-warning">Contact</button></a></th>

EOF;
                  
    if (isset($_SESSION['login']) && Session::is_admin()) {

        echo <<< EOF
        
           <th class="text-center"> <a class="nav-link" data-toggle="modal" data-target="#exampleModalS{$num}">
                           <button class="btn btn-danger" type="button"> <i class="fa fa-fw fa-trash"></i>Supprimer</button></a></th>   
       
       <div class="modal fade" id="exampleModalS{$num}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelS{$num}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelS{$num}">Supprimer?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                        <a href="index.php?action=deleteEditeur&num={$num}"><button class="btn btn-danger" type="button">Supprimer</button></a>
                    </div>
                </div>
            </div>
        </div>
                      
                        
                   
                           <form action="index.php?action=updateEditeur" method = "POST">
                                
                                <input type="hidden" name="numEditeur" value="{$num}" />
                                <input type="hidden" name="nom" value="{$nom}" />
                                <input type="hidden" name="ville" value="{$ville}" />
                                <input type="hidden" name="rue" value="{$rue}" />
                                <input type="hidden" name="cp" value="{$cp}" />
                                


                             
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
