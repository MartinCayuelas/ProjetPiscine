<?php

echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des réservations</div>
EOF;

if (isset($_SESSION['login']) && Session::is_admin()) {
    echo <<<EOF
            <a class="ajout" href="index.php?action=createReservation">Ajouter une réservation</a>
             
EOF;
}
echo <<<EOF
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                <tr>
                  <th >Date</th>
                  
                  <th>Prix</th>
                  <th>Statut</th>
                   <th>Facture</th>
                    <th>Commentaire</th>
                </tr>
              </thead>
EOF;


    echo <<< EOF

        </tr>
      </tbody>
                         
              
                      
EOF;


echo "</div>";
echo "</div>";
