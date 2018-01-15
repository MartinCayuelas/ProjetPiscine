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
                  
                  <th>Ville</th>
                  <th>Rue</th>
                  <th>Nombre de chambre</th>
                   <th>Coût de la nuit</th>
                </tr>
              </thead>

EOF;

  foreach ($tabL as $v) {
   $ville=htmlspecialchars($v-> getVilleLogement());;
   $rue=htmlspecialchars($v-> getRueLogement());
   $nbC=htmlspecialchars($v-> getNbrsChambresLogement());
   $C=htmlspecialchars($v-> getCoutParNuitLogement());


    echo <<< EOF
             <tbody>
                <tr>
                  <th>{$ville}</th>
                  <th>{$rue}</th>
                  <th>{$nbC} </th>
                  <th>{$C}</th>
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
                  

   
echo "</div>";

echo "</div>";
