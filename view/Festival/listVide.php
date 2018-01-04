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
            <table class="table table-bordered" width="100%" cellspacing="0">
               <thead>
                <tr>
                  
                  <th>Année</th>
                  <th>Date</th>
                  <th>Nombre de Tables</th>
                   <th>Prix Place Standard</th>
                </tr>
              </thead>
EOF;

    
    echo <<< EOF
        </tr>
      </tbody>
                         
              
                      
EOF;
echo "</div>";
echo "</div>";