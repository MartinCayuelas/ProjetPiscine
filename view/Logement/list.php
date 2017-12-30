<?php
echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des logements</div>
EOF;
if (isset($_SESSION['login']) && Session::is_admin()) {
    echo <<<EOF
            <a class="ajout" href="index.php?action=createLogement">Ajouter un Logement</a>
             
EOF;
}
echo <<<EOF
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                <tr>
                  
                  
                  <th>Ville</th>
                  <th>Rue</th>
                   <th>CodePostal</th>
                   <th >NbreChambres</th>
                   <th >CoutParNuit</th>
                </tr>
              </thead>
EOF;
foreach ($tab as $v) {
    $num = htmlspecialchars($v->getNumLogement());
    $ville = htmlspecialchars($v->getVilleLogement());
    $rue = htmlspecialchars($v->getRueLogement());
    $cp = htmlspecialchars($v->getCPLogement());
    echo <<< EOF
             <tbody>
                <tr>
                  
                  <th>{$ville}</th>
                   <th>{$rue}</th>
                   <th>{$cp}</th>
                   <th>{$nbchambre}</th>
                   <th>{$cpn}</th>
EOF;
    if (isset($_SESSION['login']) && Session::is_admin()) {
        echo <<< EOF
                   
                   <th class="text-center" ><a href="index.php?action=deleteLogement&num={$num}"><button class="btn btn-danger" type="button">Supprimer</button></a></th> 
                             <form action="index.php?action=updateLogement" method = "POST">
                                
                                <input type="hidden" name="numLogement" value="{$num}" />
                                
                                <input type="hidden" name="ville" value="{$ville}" />
                                <input type="hidden" name="rue" value="{$rue}" />
                                <input type="hidden" name="cp" value="{$cp}" />
                                <input type="hidden" name="nbchambre" value="{$nbchambre}" />
                                <input type="hidden" name="cpn" value="{$cpn}" />
                                
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