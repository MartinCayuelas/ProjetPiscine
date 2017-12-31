<?php
echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des catégories</div>
EOF;
if (isset($_SESSION['login']) && Session::is_admin()) {
    echo <<<EOF
            <a class="ajout" href="index.php?action=createCategorie">Ajouter une Catégorie</a>
             
EOF;
}
echo <<<EOF
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                <tr>
                  
                  <th>Code</th>
                  <th>Nom</th>
                </tr>
              </thead>
EOF;
foreach ($tab as $v) {
    $code = htmlspecialchars($v->getCodeCategorie());
    $nom = htmlspecialchars($v->getNomCategorie());
  
    echo <<< EOF
             <tbody>
                <tr>
                  
                  <th>{$code}</th>
                   <th>{$nom}</th>

EOF;
    if (isset($_SESSION['login']) && Session::is_admin()) {
        echo <<< EOF
                   
                   <th class="text-center" ><a href="index.php?action=deleteCategorie={$code}"><button class="btn btn-danger" type="button">Supprimer</button></a></th> 
                             <form action="index.php?action=updateCategorie" method = "POST">
                                
                                <input type="hidden" name="code" value="{$code}" />
                                
                                <input type="hidden" name="nom" value="{$nom}" />
                         
                               
                                
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