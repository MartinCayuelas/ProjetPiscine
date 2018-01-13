<?php

echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des Zones</div>
EOF;
if (isset($_SESSION['login']) && Session::is_admin()) {
    echo <<<EOF
            <a class="ajout" href="index.php?action=createZone"><i class="fa fa-plus-circle" aria-hidden="true"></i>Zone</a>
             
EOF;
}


foreach ($tabZ as $k) {
    $num= htmlspecialchars($k->getNumZone());
    $nom = htmlspecialchars($k->getNomZone());

    echo <<<EOF
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered bordertable">
               <thead>
                <tr>
                  <th class="th Zone text-center" ><h2>{$nom}
                      
 
EOF;

                  
                   if (isset($_SESSION['login']) && Session::is_admin()) {
        echo <<< EOF
                   
                  <a href="index.php?action=deleteZone&num={$num}"><button class="btn btn-danger" type="button"> <i class="fa fa-trash" aria-hidden="true"></i></button></a> 
                            
                       
                       
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
    foreach ($tabC as $c) {
        if ($c->getNumZone() == $num) {
            $numC = htmlspecialchars($c->getCodeCategorie());

         foreach ($tabCat as $cat) {
              if ($cat->getCodeCategorie() == $numC){
                  $nomCa=  htmlspecialchars($cat->getNomCategorie());

              echo <<< EOF
                    <tr>
                    <th class="th Zone text-center" ><h3>{$nomCa}</h3></th>
EOF;

            foreach ($tabJ as $j) {
              if ($j->getcodeCategorie() == $numC) {

              $nomJeu = htmlspecialchars($j->getNomJeu());
              $numJeu =  htmlspecialchars($j->getnumJeu());

           
            
              echo <<< EOF
                    <tr>
                   <td class="tdHover text-center"><h5>{$nomJeu}</h5></td>
                   
                   </tr>
EOF;
          }

        }
      }
    }

  }
}

    echo <<< EOF
        
      </tbody>
             
              
                      
EOF;
}
echo '  </table>  ';
echo "</div>";
echo "</div>";


