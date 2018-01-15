<?php

echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des réservations</div>
EOF;

if (isset($_SESSION['login']) && Session::is_admin()) {
    echo <<<EOF
            <a class="ajout" href="index.php?action=createReservation"><i class="fa fa-plus-circle" aria-hidden="true"></i>  réservation</a>
             
EOF;
}
echo <<<EOF
        <div class="card-body">
        <p>Total recette : {$chiffre} €</p>
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
               <thead>
                <tr>

                  <th>Editeur</th>
                  <th>Jeux</th>
                  <th >Date</th>
                  <th>Prix</th>
                   <th>Facture</th>
                    <th>Commentaire</th>
                </tr>
              </thead>
EOF;
foreach ($tab as $v) {

    $num = htmlspecialchars($v->getNumResa());
    $date = htmlspecialchars($v->getDateResa());
    $prix = htmlspecialchars($v->getPrixPlaceNego());
    $statut = htmlspecialchars($v->getStatut());
    $facture = htmlspecialchars($v->getEtatFacture());
    $com = htmlspecialchars($v->getCommentaire());
    
    
    foreach ($tabC as $c) {
      if ($num==$c->getNumResa()){
        $numJ=htmlspecialchars($c->getNumJeux());
      

        foreach ($tabJ as $j) {
          if ($numJ==$j->getnumJeu()){
            $numE=htmlspecialchars($j->getNumEditeur());
            $nomJ=htmlspecialchars($j->getNomJeu());

          foreach ($tabE as $e) {
            if ($numE==$e->getnumEditeur()){
              $nomE=htmlspecialchars($e->getNomEditeur());
              
        
              
        
            

        



    echo <<< EOF

             <tbody>
                <tr>
                  <th><a class="nav-link linkCate" href="index.php?action=detailResa&num={$numE}">{$nomE}</a></th>
                  <th>{$nomJ}</th>
                  <th>{$date}</th>
                  <th>{$prix}</th>
                   <th>{$facture}</th>
                   <th>{$com}</th>


EOF;

    if (isset($_SESSION['login']) && Session::is_admin()) {

        echo <<< EOF
                   
                   <th class="text-center" ><a href="index.php?action=deleteResa&num={$num}"><button class="btn btn-danger" type="button">Supprimer</button></a></th> 
                             <form action="index.php?action=updateResa" method = "POST">
                                
                                <input type="hidden" name="numResa" value="{$num}" />
                                <input type="hidden" name="dateResa" value="{$date}" />
                                <input type="hidden" name="commentaire" value="{$com}" />
                                <input type="hidden" name="prixPlaceNego" value="{$prix}" />
                                <input type="hidden" name="statut" value="{$statut}" />
                                <input type="hidden" name="etatFacture" value="{$facture}" />
                                <input type="hidden" name="nomEditeur" value="{$nomE}" />
                                <input type="hidden" name="nomJeu" value="{$nomJ}" />
                                


                                <br>
                               <th class="text-center" > <button type="submit" class="btn btn-primary">Modifier</button></th>   
                            </form>
                               
                       
                       
EOF;
            }
          }
        }
      }
    }
  }
}




    echo <<< EOF

        </tr>
      </tbody>
                         
              
                      
EOF;
}


echo "</div>";
echo "</div>";
