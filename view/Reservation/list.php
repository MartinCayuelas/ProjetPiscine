<?php

echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des réservations</div>
EOF;

foreach ($tab as $c){
    
    $chiffre = $chiffre + htmlspecialchars($c->getPrixPlaceNego());
}

echo <<< EOF
     <div class="card-body">
        Total des recettes : {$chiffre} €
      </div>
        
EOF;


if (isset($_SESSION['login']) && Session::is_admin()) {
    echo <<<EOF
            <a class="ajout" href="index.php?action=createReservation"><i class="fa fa-plus-circle" aria-hidden="true"></i>  réservation</a>
             
EOF;
}
echo <<<EOF
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
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
foreach ($tab as $v) {

    $num = htmlspecialchars($v->getNumResa());
    $date = htmlspecialchars($v->getDateResa());
    $prix = htmlspecialchars($v->getPrixPlaceNego());
    $statut = htmlspecialchars($v->getStatut());
    $facture = htmlspecialchars($v->getEtatFacture());
    $com = htmlspecialchars($v->getCommentaire());





    echo <<< EOF

             <tbody>
                <tr>
                  <th>{$date}</th>
                  <th>{$prix}</th>
                   <th>{$statut}</th>
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
