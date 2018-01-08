<?php


echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des contacts</div>
EOF;

if (isset($_SESSION['login']) && Session::is_admin()) {
    echo <<<EOF
            <a class="ajout" href="index.php?action=createContact&numEditeur={$numE}">Ajouter un Contact</a>
             
EOF;
}
echo <<<EOF
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered"  width="100%" cellspacing="0">
               <thead>
                <tr>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Téléphone</th>
                   <th>Mail</th>
                </tr>
              </thead>
EOF;


    echo <<< EOF

        </tr>
      </tbody>
                         
              
                      
EOF;



echo "</div>";
echo "</div>";
