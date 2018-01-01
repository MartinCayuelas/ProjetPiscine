<?php
echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des festivals</div>
EOF;
if (isset($_SESSION['login']) && Session::is_admin()) {
    echo <<<EOF
            <a class="ajout" href="index.php?action=createFestival">Ajouter un Festival</a>
             
EOF;
}
echo <<<EOF
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                <tr>
                  
                  
                  <th>Date</th>
                  <th>Nombre de Tables</th>
                   <th>Prix Place Standard</th>
                </tr>
              </thead>
EOF;
foreach ($tab as $v) {
    $annee = htmlspecialchars($v->getAnneeFestival());
    $date = htmlspecialchars($v->getDateFestival());
    $nbtables = htmlspecialchars($v->getNbTablesFestival());
    $prixplacestd = htmlspecialchars($v->getPrixPlaceStdFestival());
    echo <<< EOF
             <tbody>
                <tr>
                  
                  <th>{$annee}</th>
                   <th>{$date}</th>
                   <th>{$nbtables}</th>
                   <th>{$prixplacestd}</th>
EOF;
    if (isset($_SESSION['login']) && Session::is_admin()) {
        echo <<< EOF
                   
                   <th class="text-center" ><a href="index.php?action=deleteFestival&annee={$annee}"><button class="btn btn-danger" type="button">Supprimer</button></a></th> 
                             <form action="index.php?action=updateFestival" method = "POST">
                                
                                <input type="hidden" name="anneeFestival" value="{$annee}" />
                                
                                <input type="hidden" name="date" value="{$date}" />
                                <input type="hidden" name="nbtables" value="{$nbtables}" />
                                <input type="hidden" name="prixplacestd" value="{$prixplacestd}" />
                                
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