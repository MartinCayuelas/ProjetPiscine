<?php
echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-th"></i> Détail du jeu </div>

<div class="card-header">
   
    <a href="index.php?action=listResa"><button class="btn btn-warning retour" type="button">Retour aux Reservations</button></a>
    </div>

EOF;

echo <<<EOF
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered"  width="100%" cellspacing="0">
               <thead>
                <tr>
                  
                  <th>Jeu</th>
                  <th >Catégorie du jeu</th>
                  <th>Zone réservée</th>
                  <th>Facture</th>
                   <th>Nombre de table réservée</th>
                  <th>Prix réservation</th>
                  <th>Reçu</th>
                  <th>Retour</th>
                </tr>
              </thead>

EOF;

  foreach ($tabE as $v) {
    $numE=$v->getNumEditeur();
    
    foreach ($tabJ as $j) {
      if ($numE== $j->getNumEditeur()){
        $nomJ=htmlspecialchars($j-> getNomJeu());
        $cat=htmlspecialchars($j-> getcodeCategorie());
        $numJ=htmlspecialchars($j-> getNumJeu());
        
        foreach ($tabCat as $tc) {
          if ($cat== $tc->getCodeCategorie()){
            $nomCat=htmlspecialchars($tc-> getNomCategorie());

            foreach ($tabC as $c) {
              if ($numJ== $c-> getNumJeux()){
              $recu=htmlspecialchars($c-> getRecu());
              if ($recu==1){
                $rec="oui";
              }
              else{
                $rec="non";
              }
            $retour=htmlspecialchars($c-> getRetour());
            if ($retour==1){
              $ret="oui";
            }
            else{
              $ret="non";
            }
            $numR=htmlspecialchars($c->getNumResa());

            foreach ($tabL as $l) {
              if($numR== $l->getNumResa()){
                $numZ=htmlspecialchars($l-> getNumZone());
                $nbP=htmlspecialchars($l-> getNbPlace());

                foreach ($tabZ as $z) {
                  if ($numZ== $z->getNumZone()){
                    $nomZ=htmlspecialchars($z-> getNomZone());

                    foreach ($tabR as $r) {
                      if ($numR== $r->getNumResa()){
                        $et=htmlspecialchars($r-> getEtatFacture());
                        $pP=htmlspecialchars($r-> getPrixPlaceNego());
                        $numR=htmlspecialchars($r-> getNumResa());
                     

    echo <<< EOF
             <tbody>
                <tr>
                  <th>{$nomJ}</th>
                  <th>{$nomCat}</th>
                  <th>{$nomZ}</th>
                  <th>{$et} </th>
                  <th>{$nbP}</th>
                  <th>{$pP}</th>
                  <th>{$rec}</th>
                  <th>{$ret}</th>

EOF;
    if (isset($_SESSION['login']) && Session::is_admin()) {
        echo <<< EOF
                   
                   <th class="text-center" ><a href="index.php?action=deleteByNum&num={$num}"><button class="btn btn-danger" type="button">Supprimer</button></a></th> 
                             <form action="index.php?action=updated" method = "POST">
                                
                                <input type="hidden" name="numJeux" value="" />
                                <input type="hidden" name="nomJeu" value="" />
                                <input type="hidden" name="NbreJoueurs" value="" />
                                <input type="hidden" name="dateSortie" value="" />
                                <input type="hidden" name="dureePartie" value="" />
                                <input type="hidden" name="codeCategorie" value="" />
                                <input type="hidden" name="numEditeur" value="" />
                                
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
}}}}}}}}}} }  }
                  

   
echo "</div>";

echo "</div>";
