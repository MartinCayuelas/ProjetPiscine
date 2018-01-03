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

    echo <<< EOF

        </tr>
      </tbody>
                         
              
                      
EOF;



echo "</div>";
echo "</div>";
