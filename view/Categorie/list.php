<?php

echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des jeux par Catégorie</div>
EOF;
if (isset($_SESSION['login']) && Session::is_admin()) {
    echo <<<EOF
            <a class="ajout" href="index.php?action=createCategorie"><i class="fa fa-plus-circle" aria-hidden="true"></i> Catégorie</a>
             
EOF;
}


foreach ($cat as $v) {
    $code = htmlspecialchars($v->getCodeCategorie());
    $nom = htmlspecialchars($v->getNomCategorie());

    echo <<<EOF
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered bordertable">
               <thead>
                <tr>
                  <th class="thCategorie text-center" ><h2>{$nom}
                      
 
EOF;
                  
                   if (isset($_SESSION['login']) && Session::is_admin()) {
        echo <<< EOF
                   
                  <a href="index.php?action=deleteCategorie&code={$code}"><button class="btn btn-danger" type="button"> <i class="fa fa-trash" aria-hidden="true"></i></button></a> 
                            
                       
                       
EOF;
    }
   
    echo <<<EOF
    </h2>
                  </th>
                  
                </tr>
              </thead>
EOF;
    echo <<< EOF
             <tbody>
                

EOF;
    foreach ($games as $v) {
        if ($v->getcodeCategorie() == $code) {
            $nomJeu = htmlspecialchars($v->getNomJeu());
            $num = htmlspecialchars($v->getnumJeu());
            echo <<< EOF
                    <tr>
       
                   <td class="tdHover text-center"><a class="nav-link linkCate" href="index.php?action=detailJeu&num={$nomJeu}"><h5>{$nomJeu}</h5></a></td>
                   
                   </tr>
EOF;
        }
    }

    echo <<< EOF
        
      </tbody>
             
              
                      
EOF;
}
echo '  </table>  ';
echo "</div>";
echo "</div>";
