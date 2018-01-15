<?php


echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Suivis</div>
EOF;

if (isset($_SESSION['login']) && Session::is_admin()) {
    echo <<<EOF
           <a class="ajout" href="index.php?action=createSuivi"><i class="fa fa-plus-circle" aria-hidden="true"></i>  Suivi</a>
             
EOF;
}
echo <<<EOF
          <div class="card-body">
                      {$num} suivi{$s} <i class=" fa fa-folder"></i>
          <div class="table-responsive">
            <table class="table table-bordered"  width="100%" cellspacing="0">
               <thead>
                <tr>
                  <th>Premier Contact</th>
                  <th>Relance</th>
                  <th>Réponse</th>   
                </tr>
              </thead>
EOF;


    echo <<< EOF

        </tr>
      </tbody>
                         
              
                      
EOF;

echo "</div>";
echo "</div>";